<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use LdapRecord\Container;
use Illuminate\Http\Request;
use LdapRecord\Auth\Events\Failed;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Actions\Users\UpdateUserDataFromLdap;

use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // -- get login username to be used by the controller.
    public function username()
    {
        return 'username';
    }

    // -- show application's login form.
    public function showLoginForm($lang = 'en')
    {
        $data = [];
        if (app()->environment('local')) {
            $data['users']  = User::select(['id', 'username'])->pluck('username', 'id')->toArray();
        }

        return view('auth.login', $data);
    }

    // -- handle a login request to the application.
    public function login(Request $request)
    {
        $this -> validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if( $request->get('method') == 'domain' )
        {
            if ($this->attemptDomainLogin($request)) {
                return $this->sendLoginResponse($request);
            }

            return $this->sendLoginWithDeletedUserAttemptResponse($request);
        }
        else {
            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    // -- login as any user, only on local environment
    public function developerLogin(Request $request) {
        if ( ! app()->environment(['local'])) {
            flash('Cannot use "Developer Login" in environment other than "local"!')->error();
            return redirect()->back();
        }

        auth()->loginUsingId($request->get('user'));
        return redirect()->intended($this->redirectPath());
    }

    // -- user has been authenticated.
    protected function authenticated(Request $request, User $user)
    {
        $user -> increment('logins');
        $user -> setLastLogin();

        // Mail::to('s.tobys@gmail.com')
        //     // -> cc($reecipient)
        //     // -> bcc($recipient)
        //     -> send(new UserLoggedIn($user)) // -- send immediate
        //     // -> queue(new UserLoggedIn($user)) // -- queue
        //     // -> later(now()->addMinutes(10), new UserLoggedIn($user)) // -- delay delivery
        // ;
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptDomainLogin(Request $request)
    {
        try {
            $ldap = Container::getConnection('default');
            $credentials = $this->credentials($request);
    
            if ($ldap->auth()->attempt($credentials['username'] .'@adient.com', $credentials['password'])) {
                // -- fetch or create user and login
                $dbUser = User::withTrashed()->firstOrCreate([
                    'username'  => $credentials['username'],
                ], [
                    'password'  => $credentials['password'],
                ]);

                if ( $dbUser -> isDeleted() )
                {
                    return false;
                }

                auth()->login($dbUser);
                UpdateUserDataFromLdap::run($dbUser);
    
                return true;
            } else {
                $error = $ldap->getLdapConnection()->getDiagnosticMessage();
    
                if (strpos($error, '532') !== false) {
                    $message = 'Your password has expired.';
                } elseif (strpos($error, '533') !== false) {
                    $message = 'Your account is disabled.';
                } elseif (strpos($error, '701') !== false) {
                    $message = 'Your account has expired.';
                } elseif (strpos($error, '775') !== false) {
                    $message = 'Your account is locked.';
                } else {
                    $message = 'Username or password is incorrect.';
                }
    
                flash()->error($message);
                return false;
            }
        }
        catch(\LdapRecord\Auth\BindException $e)
        {
            $this -> sendFailedLdapBindResponse($request);
        }
    }

    protected function sendFailedLdapBindResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => ['Nie można nawiązać połączenia z ActiveDirectory. Spróbuj za chwilę.'],
        ]);
    }

    protected function sendLoginWithDeletedUserAttemptResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed-by-deleted-user')],
        ]);
    }
}
