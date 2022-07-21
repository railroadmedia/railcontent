<?php

// For some reason the laravel vapor asset uploading to cloudfront and S3 doesn't work for manifest files
// so they have to be served directly via a route:
// https://stackoverflow.com/questions/66065225/how-to-publish-a-manifest-file-with-laravel-vapor

Route::middleware('cache.headers:public;max_age=7200')->get(
    '/favicons/drumeo/manifest.json',
    function (): string {
        return file_get_contents(public_path('/favicons/drumeo/manifest.json'));
    }
);

Route::middleware('cache.headers:public;max_age=7200')->get(
    '/favicon/site.webmanifest',
    function (): string {
        return file_get_contents(public_path('/favicon/site.webmanifest'));
    }
);

Route::middleware('cache.headers:public;max_age=7200')->get(
    '/favicons/{brand}/site.webmanifest',
    function ($brand): string {
        return file_get_contents(public_path('/favicons/' . $brand . '/site.webmanifest'));
    }
);

// /favicons/drumeo/manifest.json?v=2017
// /favicons/guitareo/site.webmanifest?v=2018
// /favicons/musora/site.webmanifest?v=2018
// /favicons/pianote/site.webmanifest?v=2018
// /favicons/singeo/site.webmanifest?v=2018
// /favicons/musora/site.webmanifest?v=2018
// /favicon/site.webmanifest?v=2018
