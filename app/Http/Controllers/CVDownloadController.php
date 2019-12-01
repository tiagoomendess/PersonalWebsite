<?php

namespace App\Http\Controllers;

use App\Services\CVDownloadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CVDownloadController extends Controller
{
    /** @var CVDownloadService */
    private $cvDownloadService;

    public function __construct(CVDownloadService $cvDownloadService)
    {
        $this->cvDownloadService = $cvDownloadService;
        $this->middleware('throttle:12,1');
    }

    public function downloadPage(Request $request, string $token = "")
    {
        //If the token is not set in the URI, try the query params
        if (empty($token) && !empty($request->query->get('token'))) {
            return redirect()->route('cv', ['token' => $request->query->get('token')]);
        }

        $this->cvDownloadService->registerDownloadAttempt(
            $token,
            $request->server('REMOTE_ADDR'),
            $request->getLocale(),
            $request->header('User-Agent')
        );

        $this->cvDownloadService->setSameLocaleAsToken($request, $token);

        $data = [
            'canDownload' => $this->cvDownloadService->canTokenBeUsed($token),
            'token' => $token,
        ];

        return view('pages.download_cv', $data);
    }

    public function downloadFile(string $token, string $random_string)
    {
        if ($this->cvDownloadService->incrementTokenUsages($token)) {

            $tokenObj = $this->cvDownloadService->getObjectByToken($token);
            $file = $this->cvDownloadService->getFilePath($tokenObj->locale);
            Log::info("File for token $token was sent! Random string was $random_string");
            return response()->download($file, Str::slug('cv_' . config('custom.first_and_last_name'), '_') . '.pdf');

        } else {
            Log::info("File for token $token was authorized on the page but failed on actual download!");
            return redirect()->route('cv', ['token' => $token]);
        }
    }
}
