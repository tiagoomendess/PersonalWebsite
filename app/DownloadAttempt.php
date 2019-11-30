<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DownloadAttempt extends Model
{
    protected $fillable = ['token', 'ip', 'locale', 'user_agent'];
}
