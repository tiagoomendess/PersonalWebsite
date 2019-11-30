<?php

namespace App\Http\Controllers;

use App\Services\HomeLandingPageService;
use Illuminate\View\View;

class HomeLandingPageController extends Controller
{
    /** @var HomeLandingPageService */
    private $homeLandingPageService;

    public function __construct(HomeLandingPageService $homeLandingPageService)
    {
        $this->homeLandingPageService = $homeLandingPageService;
    }

    public function index(): View
    {
        $birthDate = new \DateTime(env('BIRTH_DATE', '2015-01-01'));

        $viewData = [
            'age' => $this->homeLandingPageService->getAge($birthDate)
        ];

        return view('pages.home', $viewData);
    }
}
