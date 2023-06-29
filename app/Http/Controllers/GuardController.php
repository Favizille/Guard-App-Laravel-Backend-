<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GuardRequest;
use App\Repository\Eloquent\GuardRepository;

class GuardController extends Controller
{

    public function __construct(private GuardRepository $guardRepository)
    {}

    public function create(GuardRequest $request)
    {
        return $this->guardRepository->create($request->validated());
    }

    public function update($request, $guardId)
    {
        return $this->guardRepository->update($request, $guardId);
    }

    public function get($guardId)
    {
        return $this->guardRepository->get($guardId);
    }

    public function getAll()
    {
        return $this->guardRepository->getAll();
    }

    public function userGuards(){
        return $this->guardRepository->userGuards();
    }
}
