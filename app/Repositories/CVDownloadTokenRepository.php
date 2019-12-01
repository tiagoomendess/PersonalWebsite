<?php

namespace App\Repositories;

use App\DownloadToken;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CVDownloadTokenRepository
{
    public function incrementTokenUsages(string $token): bool
    {
        try {
            DB::beginTransaction();
            $tokenCollection = DB::table('download_tokens')->where('token', '=', $token)->get();

            if ($tokenCollection->count() != 1) {
                DB::commit();
                return false;
            }

            $tokenRecord = $tokenCollection->first();
            $maxDownload = (int)$tokenRecord->max_download;
            $downloadCount = (int)$tokenRecord->download_count;

            if ($downloadCount >= $maxDownload) {
                DB::commit();
                return false;
            }

            //update
            DB::table('download_tokens')->where('token', '=', $token)->update(['download_count' => $downloadCount + 1]);

            DB::commit();
            return true;

        } catch (\Exception $e) {
            Log::error("Error in transaction for token $token: " . $e->getMessage());
            DB::rollBack();
            return false;
        }
    }

    public function getObjectByToken(string $token): ?DownloadToken
    {
        return DownloadToken::where('token', $token)->first();
    }
}
