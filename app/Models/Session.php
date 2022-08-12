<?php

namespace App\Models;

use App\Models\User;
use App\Traits\ModelUrlTrait;

class Session extends Model
{
    use ModelUrlTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sessions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['last_activity'];

    protected $dates = [
        'last_activity',
    ];

    protected $casts = [
        'id'            => 'string',
        'last_activity' => 'datetime:Y-m-d H:i',
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public static function getSortOptions()
    {
        return [
            'default'   => 'Sortowanie Domyślne',
            'user,desc' => 'Nazwa Użytkownika malejąco',
            'user,asc'  => 'Nazwa Użytkownika rosnąco',
            'ip,desc'   => 'Adres IP rosnąco',
            'ip,asc'    => 'Adres IP malejąco',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query)
    {
        if (request()->isMethod('POST')) {
            // -- check "default_query_string"
            if (request()->has('default_query_string') && trim(request()->get('default_query_string')) !== '') {
                session()->put('filters.sessions.default_query_string', request()->get('default_query_string'));
            } else {
                session()->forget('filters.sessions.default_query_string');
            }

            // -- check "username"
            if (request()->has('username') && trim(request()->get('username')) !== '') {
                session()->put('filters.sessions.username', request()->get('username'));
            } else {
                session()->forget('filters.sessions.username');
            }

            // -- check "ip_address"
            if (request()->has('ip_address') && trim(request()->get('ip_address')) !== '') {
                session()->put('filters.sessions.ip_address', request()->get('ip_address'));
            } else {
                session()->forget('filters.sessions.ip_address');
            }

            // -- check "user_agent"
            if (request()->has('user_agent') && trim(request()->get('user_agent')) !== '') {
                session()->put('filters.sessions.user_agent', request()->get('user_agent'));
            } else {
                session()->forget('filters.sessions.user_agent');
            }
        }

        // -- filtrowanie kolekcji
        $query->when(session()->has('filters.sessions.default_query_string'), function ($q) {
            session()->put('filters.sessions.isFiltered', true);

            $q->where(function ($where) {
                $like = '%' . session()->get('filters.sessions.default_query_string') . '%';

                $where  -> where('user_agent', 'like', $like)
                        -> orWhere('ip_address', 'like', $like)
                        -> when(session()->get('filters.sessions.default_query_string') == 'guest', function($innerQuery) {
                                $innerQuery->orWhereNull('user_id');
                        })
                        -> when(session()->get('filters.sessions.default_query_string') == '-guest', function ($innerQuery) {
                            $innerQuery->orWhereNotNull('user_id');
                        })
                        -> when( !in_array(session()->get('filters.sessions.default_query_string'), ['guest', '-guest']), function ($innerQuery) use ($like) {
                            $innerQuery->orWhereHas('user', function($innerQuery2) use ($like) {
                                $innerQuery2->withTrashed()->where('username', 'like', $like);
                            });
                        });
            });
        })
            -> when(session()->has('filters.sessions.username'), function($innerQuery){
                $like = '%' . session()->get('filters.sessions.username') . '%';
                $innerQuery->where('username', 'LIKE', $like);

                session()->put('filters.sessions.isFiltered', true);
            })
            -> when(session()->has('filters.sessions.ip_address'), function($innerQuery){
                $like = '%' . session()->get('filters.sessions.ip_address') . '%';
                $innerQuery->where('ip_address', 'LIKE', $like);

                session()->put('filters.sessions.isFiltered', true);
            })
            -> when(session()->has('filters.sessions.user_agent'), function($innerQuery){
                $like = '%' . session()->get('filters.sessions.user_agent') . '%';
                $innerQuery->where('user_agent', 'LIKE', $like);

                session()->put('filters.sessions.isFiltered', true);
            });

        return $query;
    }

    public function scopeOrder($query)
    {
        $sort = request()->get('sort', null);
        $availableOrders = ['asc', 'desc', 'rand'];

        if (is_null($sort) || empty($sort)) {
            return $query;
        }

        $sort = explode(',', $sort);
        $field = strtolower($sort[0] ?? null);
        $order = $sort[1] ?? null;

        $order = strtolower(in_array($order, $availableOrders) ? $order : 'asc');

        // -- in random order
        if ($order == 'rand') {
            return $query->inRandomOrder();
        }

        // sort asc or desc by specific field
        switch ($field) {
            case 'ip':
                return $query->orderBy('ip_address', $order);
            break;

            case 'user':
                return $query->orderBy('user_id', $order);
            break;

            case 'act':
                return $query->orderBy('last_activity', $order);
            break;
        }
    }

    public static function logoutOtherSessions()
    {
        self::whereUserId(auth()->id())->whereNotIn('id', [session()->getId()])->delete();
    }

    public static function currentUserSessionsCount()
    {
        return self::whereUserId(auth()->id())->count();
    }

    public function browser($check = null)
    {
        
    }
}
