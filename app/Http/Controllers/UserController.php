<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Repository\Eloquent\UserRepository;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function updateProfile(ProfileRequest $request){
        $updateProfielResponse = $this->userRepository->updateProfile($request->validated());

        return $updateProfielResponse;
    }
}
