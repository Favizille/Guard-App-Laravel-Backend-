<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\BaseRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Notifications\EmailNotification;

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

        auth()->login($this->user->where("email", $request['email'])->first());

        return [
            "status" => $this->isSuccessful(),
            "user" => auth()->user(),
            'token' => auth()->user()->createToken('myapptoken')->plainTextToken,
        ];
    }

    public function requestOTP($data){
        $otp = rand(1000, 9999);
        Log::info("otp = ".$otp);

        $user = $this->user->where('email', '=', $data->email)->update(['otp' => $otp]);

        if($user){

            $message = [
                'subject' => 'Testing Application OTP',
                'body' => 'Your OTP is : ' .$otp
            ];

            var_dump($data->email);

            Mail::to($data->email->send(new EmailNotification($message)));

            return [
                "status" => $this->isSuccessful(),
                "message" => "OTP sent"
            ];
        }

        return $this->isUnsuccessful();
    }

    public function verifyOTP($data){

        $user = $this->user->where([['email', '=', $data['email']], ['otp', '=', $data['otp']]])->first();

        if($user){
            auth()->login($user, true);
            User::where('email','=',$data['email'])->update(['otp' => null]);
            $accessToken = auth()->user()->createToken('authToken')->accessToken;

            return ["status" => $this->isSuccessful(),
            "message" => "Success",
            'user' => auth()->user(),
            'access_token' => $accessToken
            ];
        }

        return $this->failResponse();
    }

}
