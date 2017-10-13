<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Session;
use Railroad\Railcontent\Repositories\LanguageRepository;

class LanguageController extends Controller
{

    protected $languageRepository;

    /**
     * LanguageController constructor.
     * @param LanguageRepository $languageRepository
     */
    public function __construct(LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    /**
     * Change the user favorite language
     * @param  Request $request
     * @return Response - the user it's redirected back
     */
    public function switchLang(Request $request)
    {
        $locale = $request->input('locale');
        $setUserLanguage = $this->languageRepository->setUserLanguage($locale);
        if(!$setUserLanguage)
        {
            return response()->json('Language with locale '.$locale.' not supported.', 404);
        }
        return response()->json('Set language with success.', 201);
    }
}