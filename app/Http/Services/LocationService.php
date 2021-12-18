<?php

namespace App\Http\Services;

class LocationService
{
    public function __constructor()
    {

    }

    public function getMunicipalities()
    {
        $path = public_path() . "/assets/municipalities.json"; // ie: /var/www/laravel/app/storage/json/filename.json
        $json = json_decode(file_get_contents($path), true);

        return $json;
    }


}
