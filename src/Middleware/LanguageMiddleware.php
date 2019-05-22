<?php

namespace Railroad\Railcontent\Middleware;

use Closure;
use Illuminate\Http\Request;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Repositories\ContentRepository;
use Throwable;

class LanguageMiddleware
{
    /** Handle an incoming request.
     * If in the database does not exist a favorite language for the authenticated user, read the locale from the
     * request header. If the header data is missing set a default language from the configuration file as locale. Set
     * the user favorite language if the locale is supported by the CMS.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws Throwable
     */
    public function handle(Request $request, Closure $next)
    {
        // read the language from the request header
        $locale = $request->header('Content-Language');

        // if the header is missed
        if (empty($locale)) {
            // take the default local language
            $locale = config('railcontent.default_language');
        }

        // check if the language defined is supported by the CMS; if not return not found exception
        throw_if(
            !in_array($locale, config('railcontent.available_languages')),
            new NotFoundException('The language with locale ' . $locale . ' is not supported by the CMS.')
        );

        // only show content in this language
        // this may change in the future
        ContentRepository::$includedLanguages = [$locale];

        return $next($request);
    }
}