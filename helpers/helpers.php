<?php

use Railroad\Railcontent\Entities\ContentFilterResultsEntity;

if (! function_exists('cf_img')) {
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
    function cf_img(string $pathFromOriginOrUrl, array $options = [])
    {
        $urlString = 'https://musora.com/cdn-cgi/image/';
        $optionsStringArray = [];

        foreach ($options as $optionKey => $optionValue) {
            $optionsStringArray[] = $optionKey . '=' . $optionValue;
        }

        $optionsStringArray[] = 'metadata=none';

        $urlString .= implode(',', $optionsStringArray);

        $urlString .= '/' . $pathFromOriginOrUrl;

        return $urlString;
    }

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
