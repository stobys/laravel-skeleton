<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest ');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function flexbox(Request $request)
    {
        if ( $request -> method() === 'POST' )
        {
            return request()->all();
        }

        return view('flexbox');
    }

    public function qrcode(Request $request, $string = null)
    {
        if ($request->method() === 'POST') {
            return redirect()->route('qrcode', [$request->get('string')]);
        }

        // QrCode::email($to, $subject, $body);
        // QrCode::geo(37.822214, -122.481769);
        // QrCode::phoneNumber('555-555-5555');
        // QrCode::SMS('555-555-5555', 'Body of the message');
        // QrCode::wiFi([
        //     'encryption' => 'WPA/WEP',
        //     'ssid' => 'SSID of the network',
        //     'password' => 'Password of the network',
        //     'hidden' => 'Whether the network is a hidden SSID or not.'
        // ]);
        //Connects to a secured WiFi network.
        // QrCode::wiFi([
        //     'ssid' => 'Network Name',
        //     'encryption' => 'WPA',
        //     'password' => 'myPassword'
        // ]);
        return view('qrcode', compact('string'));

        $qrcode = QrCode::encoding('UTF-8')
            ->merge('../public/img/adient/adient-icon-400.png', 0.3, true)
                ->margin(2)
                ->style('round') // square, dot, round
                ->size(512)
                ->backgroundColor(191, 215, 50)
                ->color(0, 70, 91)
                ->errorCorrection('H')
                ->generate($string);

        return $qrcode;
    }
}
