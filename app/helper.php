<?php

use App\Models\Blog;

function getTitle($title = ''){
    return $title ? "E Health Care - {$title}" : "E Health Care";
}
?>
