<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Repository\Eloquent\AuthRepository;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository){
        $this->authRepository = $authRepository;
    }

    public function responseIsTrue(){
        return true;
    }

    public function responseIsFalse(){
        return false;
    }

    public function register(RegisterRequest $request){
        $registerResponse = $this->authRepository->register($request->validated());


        return $registerResponse;
    }

    public function login(LoginRequest $request){
        $loginResponse = $this->authRepository->login($request->validated());

        return $loginResponse;
    }

    public function logout(){

       return [
        "status" => "success",
        "data" => Auth::logout(),
       ];
    }

    public function requestOTP(Request $request)
    {
        $response = $this->authRepository->requestOTP($request);

        return $response;
    }

    public function verifyOTP(Request $request){

        return $this->authRepository->verifyOTP($request);
    }
}
