<?php

namespace App\Http\Controllers;

use App\Services\CVDownloadService;
use Illuminate\Http\Request;

class CVDownloadController extends Controller
{
    /** @var CVDownloadService */
    private $cvDownloadService;

    public function __construct(CVDownloadService $cvDownloadService)
    {
        $this->cvDownloadService = $cvDownloadService;
    }

    public function download(Request $request, string $token = "")
    {
        //If the token is not set in the URI, try the query params
        if (empty($token) && !empty($request->query->get('token'))) {
            return redirect()->route('cv', ['token' => $request->query->get('token')]);
        }

        $this->cvDownloadService->registerDownloadAttempt(
            $token,
            $request->getClientIp(),
            $request->getLocale(),
            $request->header('User-Agent')
        );

        if ($this->cvDownloadService->canDownload($token)) {
            $file = $this->cvDownloadService->getFilePath($request->getLocale());
            return response()->download($file);
        } else {
            return view('pages.download_cv', ['token' => $token]);
        }
    }
}
