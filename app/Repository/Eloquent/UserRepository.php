<?php

namespace App\Repository\Eloquent;

use App\Models\Profile;
use App\Repository\BaseRepository;

class UserRepository extends BaseRepository{

    protected $profile;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    public function createProfile($data){

        $data["user_id"] = auth()->user()->id;

        return [
            "status" => $this->isSuccessful(),
            "message" => "Profile updated successfully",
            "data" => $this->profile->create($data)
        ];
    }

    public function updateProfile($data){

        if(!auth()->user()->profile->update($data)){
            return [
                "status" => $this->isUnsuccessful(),
                "message" => "Profile update failed"
            ];
        }

        return [
            "status" => auth()->user()->profile->update($data),
            "message" => "Profile updated successfully",
            "data" =>$data
        ];
    }

    public function getProfile()
    {
        return auth()->user()->profile;
    }
}
