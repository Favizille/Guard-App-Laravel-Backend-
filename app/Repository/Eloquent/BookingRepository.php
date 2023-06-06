<?php

namespace App\Repository\Eloquent;

use App\Repository\BaseRepository;
use App\Models\User;
use App\Models\Booking;

class BookingRepository extends BaseRepository
{
    protected $user;
    protected $book;

    public function __construct( User $user, Booking $book){
        $this->user = $user;
        $this->book = $book;
    }

    public function thisUser(){
       return  $this->user->where('email', auth()->user()->email)->first();
    }

    public function create($data){

        
        if(auth()->user() !== $this->user){
            return [
                "status" => $this->failResponse('Unauthorised'),
            ];
        }

        return[
            'status' => $this->isSuccessful(),
            'data' => $this->book->create($data->all()),
        ];

    }

}