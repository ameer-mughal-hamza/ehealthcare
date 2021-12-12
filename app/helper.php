<?php

use App\Models\Blog;
use App\Models\Message;
use App\Models\Patient;

function getTitle($title = ''){
    return $title ? "E Health Care - {$title}" : "E Health Care";
}

function getTotalMessages(){
    $messages = Message::all();
    return $messages->count();
}

function getRandomMRN() {
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
?>
