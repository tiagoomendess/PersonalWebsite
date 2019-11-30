<?php

namespace App\Services;

use App\Repositories\CVDownloadAttemptRepository;
use App\Repositories\CVDownloadTokenRepository;
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

    public function canDownload(string $token): bool
    {
        if ($this->cvDownloadTokenRepository->canTokenBeUsed($token)) {
            Log::info("Token '$token' was authorized to download CV");
            return true;
        } else {
            Log::info("Token '$token' was NOT authorized to download CV");
            return false;
        }
    }

    public function getFilePath(string $locale): string
    {
        return  storage_path("app" . DIRECTORY_SEPARATOR . "cv_tiago_mendes_$locale.pdf");
    }
}
