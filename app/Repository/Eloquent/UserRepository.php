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

    public function updateProfile($data){

        var_export(auth()->user());

        // $user->update([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'updated_at' => now()
        // ]);

        var_export($data);

        // return [
        //     "status" => $this->isSuccessful(),
        //     "message" => "Profile updated successfully",
        //     "data" => $this->profile->update($data)
        // ];
    }
}
