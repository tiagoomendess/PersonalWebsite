<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DownloadToken extends Model
{
    protected $fillable = ['token', 'max_download', 'download_count', 'locale'];
}
