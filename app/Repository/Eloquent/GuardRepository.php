<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Models\Guard;
use App\Repository\BaseRepository;
use Laravel\Sanctum\PersonalAccessToken;

class GuardRepository extends BaseRepository
{

    public function __construct(private User $user, private Guard $guard)
    {}

    public function create(array $data): array
    {
        if(! $guard = $this->guard->create($data))
        {
            return [
                "status" => false,
                "message" => "Guard creation failed"
            ];
        }

        return[
            'status' => $this->isSuccessful(),
            'data' => $guard,
        ];

    }

    public function update($data, $guardId)
    {
        $guard = $this->guard->find($guardId)->first();

        if(!$guard){
            return [
                "status" => false,
                "message" => "Guard not found"
            ];
        }

        $guard->update($data->all());

        return response()->json([
            'status' => true,
            'data' => $guard
        ]);
    }

    public function get($id)
    {
        if(! $guard = $this->guard->where('id', $id)->get()){
            return [
                "status" => false,
                "message" => "Guard not found"
            ];
        }

        return [
            "status" => true,
            "data" => $guard
        ];
    }

    public function getAll()
    {
        if(! $guards = $this->guard->all()){
            return [
                "status" => false,
                "message" => "Guard not found"
            ];
        }

        return [
            "status" => true,
            "data" => $guards
        ];
    }

    public function userGuards(){

        $user =  auth('sanctum')->user();

        $userId = $user->id;

       if(! $guards = $this->guard->where('user_id', $userId))
       {
            return [
                "status" => false,
                "message" => "Guard not found"
            ];
       }

       return [
            "status" => true,
            "data" => $guards
        ];

    }

}
