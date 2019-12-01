<?php

namespace App\Services;

use App\DownloadToken;
use App\Repositories\CVDownloadAttemptRepository;
use App\Repositories\CVDownloadTokenRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class CVDownloadService
{
    /** @var CVDownloadAttemptRepository */
    protected $cvDownloadAttemptRepository;

    /** @var CVDownloadTokenRepository */
    protected $cvDownloadTokenRepository;

    public function __construct(
        CVDownloadAttemptRepository $cvDownloadAttemptRepository,
        CVDownloadTokenRepository $cvDownloadTokenRepository
    )
    {
        $this->cvDownloadAttemptRepository = $cvDownloadAttemptRepository;
        $this->cvDownloadTokenRepository = $cvDownloadTokenRepository;
    }

    public function registerDownloadAttempt($token, $ip, $locale, $user_agent)
    {
        //Only worth registering it when it's defined, else ignore
        if (!empty($token)) {
            $this->cvDownloadAttemptRepository->create($token, $ip, $locale, $user_agent);
        }
    }

    public function incrementTokenUsages(string $token): bool
    {
        if ($this->cvDownloadTokenRepository->incrementTokenUsages($token)) {
            Log::info("Token '$token' was authorized to download CV");
            return true;
        } else {
            Log::info("Token '$token' was NOT authorized to download CV");
            return false;
        }
    }

    public function canTokenBeUsed(string $token): bool
    {
        $tokenObject = $this->cvDownloadTokenRepository->getObjectByToken($token);

        if ($tokenObject && $tokenObject->download_count < $tokenObject->max_download) {
            return true;
        } else {
            return false;
        }
    }

    public function getFilePath(string $locale): string
    {
        $path = storage_path("app" . DIRECTORY_SEPARATOR . "cv" . DIRECTORY_SEPARATOR . $locale . ".pdf");

        return  $path;
    }

    public function getObjectByToken(string $token): ?DownloadToken
    {
        return $this->cvDownloadTokenRepository->getObjectByToken($token);
    }

    public function setSameLocaleAsToken(Request $request, string $token)
    {
        $tokenObj = $this->cvDownloadTokenRepository->getObjectByToken($token);

        if ($tokenObj) {

            $locale = $tokenObj->locale;
            if (in_array($locale, config('custom.available_locales'))) {
                $request->session()->flash('locale', $locale);
                Cookie::queue('locale', $locale, 525948);
                App::setLocale($locale);
            }
        }
    }
}
