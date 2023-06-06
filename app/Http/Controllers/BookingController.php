<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Repository\Eloquent\BookingRepository;


class BookingController extends Controller
{

    protected $bookingRepository;

    public function  __construct(BookingRepository $bookingRepository){
        $this->bookingRepository = $bookingRepository;
    }

    public function create(BookRequest $book){

        return $this->bookingRepository->create($book->validated());
    }
}
