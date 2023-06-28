<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Models\Guard;
use App\Repository\BaseRepository;
use PhpParser\Node\Expr\Cast\Object_;

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

    public function update(int $guardId, $data)
    {
        // $guard = $this->guard->find($guardId);

        // var_dump($guard);

        if(! $guard = $this->guard->find($guardId)){
            return [
                "status" => false,
                "message" => "Guard was not Found"
            ];
        }

        if(!$guard ->update()->all())
        {
            return [
                "status" => false,
                "message" => "Update Failed"
            ];
        }


        return [
            'status' =>true,
            'data' => $guard
        ];
    }

}
