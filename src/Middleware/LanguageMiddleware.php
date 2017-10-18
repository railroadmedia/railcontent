<?php

namespace Railroad\Railcontent\Middleware;

use Closure;
use Illuminate\Http\Request;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\LanguageRepository;
use Railroad\Railcontent\Services\ConfigService;

class LanguageMiddleware
{
    /**
     * @var LanguageRepository
     */
    protected $language;

    /** Localization constructor.
     *
     * @param LanguageRepository $language
     */
    public function __construct(LanguageRepository $language)
    {
        $this->language = $language;
    }

    /**
     * Handle an incoming request.
     * If in the database does not exist a favorite language for the authenticated user, read the locale from the request header.
     * If the header data is missing set a default language from the configuration file as locale.
     * Set the user favorite language if the locale is supported by the CMS.
     *
     * @param  Request $request
     * @param  Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // read the language from the request header
        $locale = $request->header('Content-Language');

        // if the header is missed
        if (!$locale) {
            // take the default local language
            $locale = ConfigService::$defaultLanguage;
        }

        // check if the language defined is supported by the CMS
        if (!in_array($locale, ConfigService::$availableLanguages)) {
            // respond with error
            return abort(403, 'Language not supported.');
        }

        // only show content in this language
        // this may change in the future
        ContentRepository::$includedLanguages = [$locale];

        return $next($request);
    }
}