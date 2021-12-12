<?php

use App\Models\Blog;
use App\Models\Message;

function getTitle($title = ''){
    return $title ? "E Health Care - {$title}" : "E Health Care";
}

function getTotalMessages(){
    $messages = Message::all();
    return $messages->count();
}
?>
