<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class CVDownloadTokenRepository
{
    public function canTokenBeUsed(string $token): bool
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
            DB::rollBack();
            DB::commit();
            return false;
        }
    }
}
