<?php

use Illuminate\Support\Collection;


use RapidWeb\GoogleOAuth2Handler\GoogleOAuth2Handler;
use RapidWeb\GooglePeopleAPI\GooglePeople;

if (! Collection::hasMacro('range')) {
    /*
     * Create a new collection instance with a range of numbers. `range`
     * accepts the same parameters as PHP's standard `range` function.
     *
     * @see range
     *
     * @param mixed $start
     * @param mixed $end
     * @param int|float $step
     *
     * @return \Illuminate\Support\Collection
     */
    Collection::macro('range', function ($start, $end, $step = 1): Collection {
        return new Collection(range($start, $end, $step));
    });
}

// -- return sizes readable by humans
function human_filesize($size, $decimals = 2)
{
    $unit = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];

    return @round($size/pow(1024, ($i=floor(log($size, 1024)))), $decimals) . $unit[$i];
    return sprintf("%.{$decimals}f", $size / pow(1024, $i = floor((strlen($size) - 1) / 3))) . @$unit[$i];
}

// -- is the mime type an image
function is_image($mimeType)
{
    return starts_with($mimeType, 'image/');
}

// flash notifications
if (! function_exists('flash')) {
    /**
     * Arrange for a flash message.
     *
     * @param  string|null $message
     * @param  string      $level
     * @return \Laracasts\Flash\FlashNotifier
     */
    function flash($message = null, $level = 'info', $title = null)
    {
        switch ($level) {
            default:
            case 'info':
                is_null($title)
                    ? Flash::info($message)
                    : Flash::info($title, $message);
            break;

            case 'success':
                is_null($title)
                    ? Flash::success($message)
                    : Flash::success($title, $message);
            break;

            case 'warning':
                is_null($title)
                    ? Flash::warning($message)
                    : Flash::warning($title, $message);
            break;

            case 'error':
                is_null($title)
                    ? Flash::error($message)
                    : Flash::error($title, $message);
            break;
        }
    }
}

// user
if (! function_exists('user')) {
    function user()
    {
        if (auth()->check()) {
            return auth()->user();
        }

        return new \App\Models\NullModel;
    }
}

if (! function_exists('yesno')) {
    /**
     *  Show translated yes/no based on expression
     *
     * @param  mix  $expression
     * @param  null|boolean  $which
     *
     * @return string
     */
    function yesno($expression = null, $which = null)
    {
        return empty($expression)
            ? (($which !== true) ? trans('app.no') : '')
            : (($which !== false) ? trans('app.yes') : '');
    }
}

/**
* @link http://gist.github.com/385876
*/
function csv_to_array($filename='', $delimiter=';')
{
    $header = NULL;
    $data = [];

    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
        {
            $row = collect($row) -> map(function ($item, $key) {
                return str_replace(' ', '_', trim($item));
            }) -> toArray();

            if(!$header)
            {
                $header = collect($row) -> map(function ($item, $key) {
                    return strtolower($item);
                }) -> toArray();
            }
            else
            {
                $data[] = array_combine($header, $row);
            }
        }
        fclose($handle);
    }
    return $data;
}

function csv_to_collection($filename='', $delimiter=';')
{
    $header = NULL;
    $data = collect([]);

    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
        {
            $row = collect($row) -> map(function ($item, $key) {
                return str_replace(' ', '_', trim($item));
            });

            if(!$header)
            {
                $header = $row -> map(function ($item, $key) {
                    return strtolower($item);
                });
            }
            else
            {
                $data -> push($header -> combine($row));
            }
        }
        fclose($handle);
    }

    return $data;
}

function str_baseconvert($str, $frombase=10, $tobase=36) {
    $str = trim($str);
    if (intval($frombase) != 10) {
        $len = strlen($str);
        $q = 0;
        for ($i=0; $i<$len; $i++) {
            $r = base_convert($str[$i], $frombase, 10);
            $q = bcadd(bcmul($q, $frombase), $r);
        }
    }
    else $q = $str;

    if (intval($tobase) != 10) {
        $s = '';
        while (bccomp($q, '0', 0) > 0) {
            $r = intval(bcmod($q, $tobase));
            $s = base_convert($r, 10, $tobase) . $s;
            $q = bcdiv($q, $tobase, 0);
        }
    }
    else $s = $q;

    return $s;
}

function google($type)
{
    switch( $type )
    {
        default:
        case 'handler':
            $clientId = env('GOOGLE_CONTACTS_CLIENT_ID');
            $clientSecret = env('GOOGLE_CONTACTS_CLIENT_SECRET');
            $refreshToken = env('GOOGLE_CONTACTS_REFRESH_TOKEN');
            $scopes = explode('|', env('GOOGLE_CONTACTS_SCOPES'));

            return new GoogleOAuth2Handler($clientId, $clientSecret, $scopes, $refreshToken);
        break;

        case 'people':
            $googleOAuth2Handler = google('handler');
            return new GooglePeople($googleOAuth2Handler);
        break;
    }

    return null;
}

function javascript()
{
    return app() -> JavaScript;
}
