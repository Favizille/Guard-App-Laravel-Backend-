<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardRequest;
use App\Repository\Eloquent\GuardRepository;
use Illuminate\Http\Request;

class GuardController extends Controller
{

    public function __construct(private GuardRepository $guardRepository)
    {}

    public function create(GuardRequest $request)
    {
        return $this->guardRepository->create($request->validated());
    }

    public function update(int $guardId)
    {
        return $this->guardRepository->update($guardId);
    }
}
