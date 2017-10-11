<?php

namespace Railroad\Railcontent\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Railroad\Railcontent\Repositories\LanguageRepository;
use Railroad\Railcontent\Services\ConfigService;

class LanguageMiddleware
{
    /**
     * @var RequestTracker
     */
    protected $language;

    /* Localization constructor.
     *
    * @param \Illuminate\Foundation\Application $app
    */
    public function __construct(Application $app, LanguageRepository $language)
    {
        $this->app = $app;
        $this->language = $language;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param  Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // check if the language it's already defined for user
        $userLanguage = $this->language->getUserLanguage();

        if(!$userLanguage) {
            // read the language from the request header
            $locale = $request->header('Content-Language');

            // if the header is missed
            if(!$locale) {
                // take the default local language
                $locale = ConfigService::$defaultLanguage;
            }

            // check the languages defined is supported
            if(!in_array($locale, ConfigService::$availableLanguages)) {
                // respond with error
                return abort(403, 'Language not supported.');
            }

            $this->language->setUserLanguage($locale);
            }

        // get the response after the request is done
            $response = $next($request);

        // return the response
        return $response;
    }
}