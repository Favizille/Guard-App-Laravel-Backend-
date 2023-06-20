<?php

namespace App\Services;

class Email implements EmailInterface
{
    public function send(){
        $message = [
            "title" => "Confirmation PIN" ,
            "body" => "",
            "action_text" => "",
            "url" => url(""),
        ];

        Notification::route('mail', $email)->notify(new Email($message));

        return view("User.settings", ["message" => "Email Sent, Please check your email"]);
    }
}
