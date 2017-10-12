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
        $this->languageRepository->setUserLanguage($locale);

        return redirect()->back();
    }
}