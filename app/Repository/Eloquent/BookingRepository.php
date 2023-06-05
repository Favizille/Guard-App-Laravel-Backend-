<?php

namespace App\Repository\Eloquent;

use App\Repository\BaseRepository;
use App\Models\User;

class BookingRepository extends BaseRepository
{
    protected $user;

    public function __construct( User $user){
        $this->user = $user;
    }

    public function create($data){


        if(auth()->user() !== $this->user ){
            return [
                "status" => $this->failResponse('Unauthorised'),
            ];
        }

        return[
            'status' => $this->successResponse('book has been created successfully'),
            'data' => $this->book->create($data->all()),
        ];

    }

}