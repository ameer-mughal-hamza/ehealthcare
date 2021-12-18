<?php

namespace App\Http\Services;

use App\Models\Category;

class DoctorService
{
    public function __constructor()
    {

    }

    public function getCategories()
    {
        return Category::all();
    }

    public function getLanguages()
    {
        $path = public_path() . "/assets/languages.json";
        $json = json_decode(file_get_contents($path), true);

        return $json;
    }
}
