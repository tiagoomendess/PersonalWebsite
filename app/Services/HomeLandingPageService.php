<?php

namespace App\Services;

use Carbon\Carbon;
use \DateTime;

class HomeLandingPageService
{
    public function getAge(DateTime $dateOfBirth): int
    {
        $now = Carbon::now();
        $dateOfBirthCarbon = Carbon::createFromTimestamp($dateOfBirth->getTimestamp());

        $age = $now->year - $dateOfBirthCarbon->year;

        if ($now->month < $dateOfBirthCarbon->month)
            $age--;
        else if($now->month == $dateOfBirthCarbon->month && $now->day < $dateOfBirthCarbon->day)
            $age--;

        return $age;
    }
}
