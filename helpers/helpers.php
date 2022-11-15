<?php

use App\Services\LiveStreamEventService;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;

if (!function_exists('current_user_has_recent_order')) {
    function current_user_has_recent_order() {
        if (user()) {
            return DB::connection(config('ecommerce.database_connection_name'))
                ->table('ecommerce_orders')
                ->where('user_id', user()->id)
                ->where('created_at', '>', \Carbon\Carbon::now()->subMinute()->toDateTimeString())
                ->exists();
        }

        return false;
    }
}

if (!function_exists('get_legacy_brand_base_url')) {
    function get_legacy_brand_base_url($brand = null) {
        if (empty($brand)) {
            $brand = brand();
        }

        if (App::environment() == 'local' || App::environment() == 'development') {
            return 'https://dev.' . $brand . '.com';
        } elseif (App::environment() == 'beta-testing' || str_contains(App::environment(), 'staging')) {
            return 'https://staging.' . $brand . '.com';
        }

        return 'https://www.' . $brand . '.com';
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

        $urlString = 'https://musora.com/cdn-cgi/image/';
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
    $cacheStore = cache()->store(config('cache.default'))->getStore();

    if (method_exists($cacheStore, 'setPrefix')) {
        $oldPrefix = $cacheStore->getPrefix();
        $cacheStore->setPrefix(config('cache.prefix'));
    }

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

    if (method_exists($cacheStore, 'setPrefix')) {
        $cacheStore->setPrefix($oldPrefix);
    }

    return $isLive;
}
