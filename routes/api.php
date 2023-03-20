<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post("/register", [AuthController::class, "register"]);
Route::post("login", [AuthController::class, "login"]);
Route::post("/logout", [AuthController::class, "logout"]);

// i) name of visitee(someone who is visited you)
// ii) Destination
// iii)purpose
// -Business type (drop down)
// -pleasure
// -event name(pop up )
// -others
// iii) phone number
// iv) Durations(Hours,minutes,days)
// N/b: OTP Code is sent to mail after completion of the guard session.
// Are you done?
// If no, extend time
// If yes, input code previously sent to mail.(when book a guard form is completed: )
// V)  Guardian/ Emergency contact (required)
// Vi) Question as pop up to Discard info or keep information



// profile details :
// 1. Name
// 2. Address
// 3. Phone number
// 4. NIN
// 5. State o,f origin
// 6. State of residence
// 7. Date of birth
// 8. Image (compulsory)
