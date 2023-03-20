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

    public function updateProfile($request)
    {

    }
}