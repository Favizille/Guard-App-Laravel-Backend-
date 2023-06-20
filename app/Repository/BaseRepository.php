<?php

namespace App\Repository;

class BaseRepository{

    public function isSuccessful(){
        return true;
    }

    public function isUnsuccessful(){
        return false;
    }

    public function failResponse(){
        return [
            "status" => "false",
            "message" => "failed",
        ];
    }
}
