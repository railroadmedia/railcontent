<?php

use App\Services\LiveStreamEventService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Illuminate\Support\Str;

if (!function_exists('current_user_has_recent_order')) {
    function current_user_has_recent_order() {
        if (user()) {
            return DB::connection(config('ecommerce.database_connection_name'))
                ->table('ecommerce_orders')
                ->where('user_id', user()->id)
                ->where('created_at', '>', \Carbon\Carbon::now()->subMinutes(1)->toDateTimeString())
                ->exists();
        }

        return false;
    }
}

if (!function_exists('get_legacy_brand_base_url')) {
    function get_legacy_brand_base_url($brand = null, $withPort = true) {
        if (empty($brand)) {
            $brand = brand();
        }

        if (App::environment() == 'local' || App::environment() == 'development') {
            return 'https://dev.' . $brand . '.com' . ($withPort ? ':8443' : '');
        } elseif (App::environment() != 'production') {
            return 'https://' . App::environment() . '.' . $brand . '.com';
        }

        return 'https://www.' . $brand . '.com';
    }
}

if (!function_exists('get_musora_brand_base_url')) {
    function get_musora_brand_base_url() {
        if (App::environment() == 'local' || App::environment() == 'development') {
            return 'https://dev.musora.com:8443';
        } elseif (App::environment() != 'production') {
            return 'https://' . App::environment() . '.musora.com';
        }

        return 'https://www.musora.com';
    }
}

if (!function_exists('cf_img')) {
    /**
     * Process image and Get a CDN URL using our cloudflare images account.
     * https://developers.cloudflare.com/images/image-resizing/url-format/
     *
     * Option examples:
     * $options = [
     *      'width' => 100,
     *      'height' => 100,
     *      'dpr' => 1,
     *      'fit' => 'scale-down', // options: 'scale-down', 'contain', 'cover', 'crop', 'pad'
     *      'gravity' => 'auto', // options: 'auto', 'left', 'right', 'top', 'bottom'
     *      'quality' => 85, // 1 -> 100 scale
     *      'format' => 'auto',
     *      'anim' => false,
     *      'sharpen' => 0, // 0 -> 10 range
     *      'blur' => 0, // 0 -> 250 range
     * ];
     *
     * @return string
     */
    function cf_img(string|null $pathFromOriginOrUrl, array $options = [])
    {
        if (empty($pathFromOriginOrUrl)) {
            return '';
        }

        $urlString = 'https://www.musora.com/musora-cdn/image/';
        $optionsStringArray = [];

        foreach ($options as $optionKey => $optionValue) {
            $optionsStringArray[] = $optionKey.'='.$optionValue;
        }

        $optionsStringArray[] = 'metadata=none';

        $urlString .= implode(',', $optionsStringArray);

        $urlString .= '/'.$pathFromOriginOrUrl;

        return $urlString;
    }
}

if (!function_exists('content_to_json')) {
    /**
     * @param $contents
     * @return string
     */
    function content_to_json($contents)
    {
        if (!empty($contents)) {
            return (new ContentFilterResultsEntity(
                ['results' => $contents, 'total_results' => count($contents)]
            ))->toResponseRawJson();
        }

        return '';
    }
}

if (!function_exists('possessivize')) {
    /**
     * @return string
     */
    function possessivize($string)
    {
        return $string.'\''.($string[strlen($string) - 1] !== 's' ? 's' : '');
    }
}

if (!function_exists('current_subdomain')) {
    /**
     * @return string
     */
    function current_subdomain()
    {
        $url = \Illuminate\Support\Facades\URL::current();

        $parsedUrl = parse_url($url);

        $host = explode('.', $parsedUrl['host']);

        $subdomain = $host[0];

        return $subdomain;
    }
}

if(!function_exists('get_resource_icon')){
    /**
     * @param $filename
     * @return string
     */
    function get_resource_icon($filename){
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        switch($extension){
            case 'png':
                return 'fa-file-text';
            case 'pdf':
                return 'fa-file-pdf';
            case 'zip':
                return 'fa-file-archive';
            case 'mp3':
            case 'wav':
                return 'fa-file-audio';
            case 'mp4':
                return 'fa-file-video';
            default:
                return 'fa-cloud-download';
        }
    }
}

if(!function_exists('parse_lesson_type_readable')){
    function parse_lesson_type_readable($type, $plural = false){
        switch ($type) {
            case 'course-part':
                $parsedType = 'Courses';
                break;
            case 'song-part':
                $parsedType = 'Songs';
                break;
            case 'play-along-part':
                $parsedType = 'Play-Alongs';
                break;
            case 'recording':
                $parsedType = 'Archives';
                break;
            case 'unit-part':
                $parsedType = 'Learning Paths';
                break;
            case 'chord-and-scale':
                $parsedType = 'Chords & Scales';
                break;
            case 'semester-pack':
                $parsedType =  'Pack';
                break;
            case 'semester-pack-lesson':
                $parsedType = 'Pack';
                break;
            case 'pack-bundle':
                $parsedType = 'Pack';
                break;
            case 'pack-bundle-lesson':
                $parsedType = 'Pack';
                break;
            case 'student-review':
                $parsedType = 'Student Reviews';
                break;
            case 'boot-camps':
                $parsedType = 'Bootcamps';
                break;
            default:
                $parsedType = $type;
                break;
        }

        if($plural){
            return $parsedType[strlen($parsedType)-1] == 's' ? $parsedType : ($parsedType . 's');
        }

        return $parsedType;
    }
}

if (!function_exists('parse_xp_value')) {
    function parse_xp_value($xp){
        if($xp >= 1000 && $xp < 100000){
            return round($xp / 1000, 1) . 'K';
        }
        else if($xp >= 100000 && $xp < 1000000){
            return round($xp / 1000, 0) . 'K';
        }
        else if($xp >= 1000000){
            return round($xp / 1000000, 1) . 'M';
        }

        return $xp;
    }
}

function isLive()
{
    $cacheName = brand() . '_is_live';

    if (cache()->has($cacheName)) {
        return cache()->get($cacheName);
    }

    /**
     * @var $liveService LiveStreamEventService
     */
    $liveService = app(LiveStreamEventService::class);

    $isLive = $liveService->currentlyLive();
    if ($isLive) {

        cache()->put(
            $cacheName,
            true,
            1
        );
    } else {

        cache()->put(
            $cacheName,
            false,
            1
        );
    }

    return $isLive;
}

if (!function_exists('array_entity_column')) {
    /**
     * @param stdClass[] $arrayOfEntities
     * @param string $getMethodName
     * @return array
     */
    function array_entity_column(array $arrayOfEntities, $getMethodName)
    {
        $arrayOfValues = [];

        foreach ($arrayOfEntities as $entity) {
            if (method_exists($entity, $getMethodName)) {
                $arrayOfValues[] = $entity->$getMethodName();
            }
        }

        return $arrayOfValues;
    }
}

if (!function_exists('assembleUserAttributes')) {
    /**
     * Extract user properties and certain method results into an array.
     *
     * @param object $userObject
     * @return array
     */
    function assembleUserAttributes($userObject) {
        if (empty($userObject)) {
            return [];
        }

        $userData = method_exists($userObject, 'toArray') ? $userObject->toArray() : [];

        $methodsToCall = ['getDashboardUrl', 'isAMember'];

        foreach ($methodsToCall as $method) {
            if (method_exists($userObject, $method)) {
                $key = Str::snake($method);
                $userData[$key] = $userObject->$method();
            }
        }

        return $userData;
    }
}

/**
 * Formats a number to a shorter version, converting it to 'K' for thousands and 'M' for millions.
 *
 * @param int|float $num The number to be formatted.
 * @return string The formatted number with 'K' or 'M' suffix, or the original number if it's less than 1000.
 */

if (!function_exists('convertNumber')) {
    function convertNumber($num)
    {
        if (!is_numeric($num)) {
            $num = floatval($num);
        }

        if ($num >= 1000000) {
            $million = $num / 1000000;
            $decimal = fmod($million, 1) > 0 ? '.' . substr(number_format($million, 1), -1) : '';
            return floor($million) . $decimal . 'M';
        } elseif ($num >= 1000) {
            return number_format($num / 1000) . 'K';
        }
        return $num;
    }
}


/**
 * Zipper merges arrays into a single array
 *
 * @param array[array] $arraysToZip children arrays must be sequencially numerically indexed
 * @return array The merged array
 */
if (!function_exists('zipperMerge')) {
    function zipperMerge($arraysToZip)
    {
        $results = [];
        $reIndexedArrays = [];
        foreach($arraysToZip as $array) {
            if (!$array) continue;
            $reIndexedArrays[] = array_values($array);
        }
        if (!$reIndexedArrays) {
            return $results;
        }
        $lengths = array_map(function($child){return count($child);}, $reIndexedArrays);
        $maxLength = max($lengths);
        for($j = 0; $j < $maxLength; $j++) {
            foreach($reIndexedArrays as $child) {
                if (count($child) == 0 || $j >= count($child)) continue;
                $results[] = $child[$j];
            }
        }
        return $results;
    }
}

if (!function_exists('dispatchWithDelay')) {
    /**
     * @param mixed $job
     * @param int $delaySeconds
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    function dispatchWithDelay($job, $delaySeconds)
    {
        return dispatch($job)->delay(Carbon::now()->addSeconds($delaySeconds));
    }
}

if (!function_exists('encodeURI')) {
    /**
     * @param $url
     * @return string
     */
    function encodeURI($url)
    {
        $res = preg_match('/.*:\/\/(.*?)\//', $url, $matches);
        if ($res) {
            // except host name
            $url_tmp = str_replace($matches[0], "", $url);

            // except query parameter
            $url_tmp_arr = explode("?", $url_tmp);

            // encode each tier
            $url_tear = explode("/", $url_tmp_arr[0]);
            foreach ($url_tear as $key => $tear) {
                $url_tear[$key] = rawurlencode($tear);
            }

            $ret_url = $matches[0].implode('/', $url_tear);

            // encode query parameter
            if (count($url_tmp_arr) >= 2) {
                $ret_url .= "?".encodeURISub($url_tmp_arr[1]);
            }

            return $ret_url;
        } else {
            return encodeURISub($url);
        }
    }
}
/**
 * https://stackoverflow.com/questions/4929584/encodeuri-in-php/6059053
 */
function encodeURISub($url)
{
    $unescaped = [
        '%2D' => '-',
        '%5F' => '_',
        '%2E' => '.',
        '%21' => '!',
        '%7E' => '~',
        '%2A' => '*',
        '%27' => "'",
        '%28' => '(',
        '%29' => ')'
    ];
    $reserved = [
        '%3B' => ';',
        '%2C' => ',',
        '%2F' => '/',
        '%3F' => '?',
        '%3A' => ':',
        '%40' => '@',
        '%26' => '&',
        '%3D' => '=',
        '%24' => '$'
    ];
    $score = [
        '%23' => '#'
    ];

    return strtr(rawurlencode($url), array_merge($reserved, $unescaped, $score));
}


