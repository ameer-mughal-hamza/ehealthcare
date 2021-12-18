<?php

use App\Models\Blog;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

function getTitle($title = '')
{
    return $title ? "E Health Care - {$title}" : "E Health Care";
}

function getTotalMessages()
{
    $messages = Message::all();
    return $messages->count();
}

function getRandomMRN()
{
    $exist = 1;
    while ($exist > 0) {
        $random_number = rand(10000000, 99999999);
        $patient = Patient::where('user_id', $random_number)->first();
        if (!$patient) {
            $exist = 0;
        }
    }

    return $random_number;
}

function getRandomRizivNo()
{
    $exist = 1;
    while ($exist > 0) {
        $random_number = rand(10000000, 99999999);
        $doctor = Doctor::where('riziv_number', $random_number)->first();
        if (!$doctor) {
            $exist = 0;
        }
    }

    return $random_number;
}

function getLanguageValue($key)
{
    return DB::table('languages')->where([
        'id' => $key
    ])->first();
}

?>
