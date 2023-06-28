<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\BaseRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Notifications\EmailNotification;
use App\Notifications\ResetPassword;

class AuthRepository extends BaseRepository{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register($request){
        $request['password'] = bcrypt($request['password']);

        if(!$user = $this->user->create($request)){
            return [
                "status" => $this->isUnsuccessful(),
                "message" => "SignUp Failed"
            ];
        }

        return [
            "status" => $this->isSuccessful(),
            "user" => $user,
            'token' => $user->createToken('myapptoken')->plainTextToken,
        ];
    }

    public function login($request){
        if(!auth()->attempt([
            'email' => $request['email'],
            'password' => $request['password']
            ])) {

            return [
                "status" => $this->isUnsuccessful(),
                "message" => "Invalid credientials"
            ];
        }

        $user = $this->user->where("email", $request['email'])->first();
        auth()->login($user);

        return [
            "status" => $this->isSuccessful(),
            "user" => $user,
            'token' => $user->createToken('myapptoken')->plainTextToken,
        ];
    }


    public function sendOTP(object $data):array
    {
        $otp = rand(1000, 9999);
        Log::info("otp = ".$otp);

        $user = $this->user->where('email', '=', $data->email)->first();

        if(! $user->update(["otp" => $otp])){
            return [
                "status" => false,
                "message" => "OTP has not been sent",
            ];
        }

        $user->notify(new EmailNotification([
            'subject' => 'Your GuardApp Account OTP',
            'body' => 'Your OTP is : ' .$otp
        ]));

        return [
            "status" => $this->isSuccessful(),
            "message" => "OTP sent"
        ];

    }

    public function verifyOTP(object $data):array
    {

        $user = $this->user->where([['email', '=', $data['email']], ['otp', '=', $data['otp']]])->first();

        if(!$user){

            return [
                "status" => "fail" ,
                "message" => [ 1 => "Wrong OTP", 2 => "Invalid Email"]
            ];
        }

        auth()->login($user, true);
        $this->user->where('email','=',$data['email'])->update(['otp' => null]);
        $accessToken = $user->createToken('authToken')->accessToken;

        return [
            "status" => $this->isSuccessful(),
            "message" => "Success",
            'user' => auth()->user(),
            'access_token' => $accessToken
        ];

    }

    public function forgetPassword($data)
    {
        $user = $this->user->where('email', $data['email'])->first();

        $message = [
            "subject" => "Forgotten Your Password?",
            "body" =>"No worries, click the link below to reset your password",
            "url"=>" ", //put a get route to a view to reset password
        ];

        Mail::to($user->notify(new ResetPassword($message)));

        return $this->isSuccessful();

    }

    public function resetPassword($data)
    {
        $user = $this->user->where('email', $data['email'])->update([
            "password" => bcrypt($data["password"])
        ]);

        if(!$user)
        {
            return $this->failResponse();
        }

        return [
            "status" => $this->isSuccessful(),
            "message" => "Reset Password Done"
        ];

        $message = [
            "subject" => "Reset Password",
            "body" => "Password Reset was Successful"
        ];

        Mail::to($user->notify(new EmailNotification($message)));


    }

}
