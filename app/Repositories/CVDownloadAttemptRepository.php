<?php

namespace App\Repositories;

use App\DownloadAttempt;

class CVDownloadAttemptRepository
{
    public function create($token, $ip, $locale, $user_agent): DownloadAttempt
    {
        $attempt = new DownloadAttempt([
            'token' => $token,
            'ip' => $ip,
            'locale' => $locale,
            'user_agent' => $user_agent
        ]);
        $attempt->save();

        return $attempt;
    }
}