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
        });

        return $query;
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
