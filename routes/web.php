<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');


Route::get('/', function () {
    
    return view('welcome');
});

Route::get('/formpage', function (Request $request) {
    if (!$request->phone) {
        return redirect()->back()->withInput($request->all());
    }

    $result = Http::withQueryParameters([
        'phone' => $request->phone,
        'password' => '8xhlYx_94{e$'
    ])
    ->withHeaders([
        'Accept' => 'application/json'
    ])
    ->get('https://datastore.oncloud.com.ng/payload/getinfo');

 $result= $result->body();
    $result = json_decode($result, true);

    if (empty($result)) {
        // Redirect back to the welcome page with a message if phone number not found
        return redirect()->route('welcome')->with('alert', 'Phone number not found. Please visit www.gocng.ng/booking-page to register.');
    }

    // Store the result in session
    session(['userData' => $result]);

    return view('formpage', compact('result'));
})->name('formpage');



// Route::get('/formpage', function (Request $request) {

//     if(!$request->phone){
//         return redirect()->back()->withInput($request->all());
//     }
//     $result=Http::withQueryParameters([
//         'phone'=>$request->phone,
//         'password'=>'8xhlYx_94{e$'
//     ])
//     ->withHeaders([
//         'Accept'=>'ápplication/json'
//     ])
//         ->get('https://datastore.oncloud.com.ng/payload/getinfo');

//     $result= $result->body();
//      $result=json_decode($result, true);

//     return view('formpage',compact('result'));
// })->name('formpage');


Route::get('/eligibility', function () {
    $result = session('userData');

    if (!$result) {
        return redirect()->route('formpage')->with('error', 'Please enter phone number first.');
    }

    return view('eligibility', compact('result'));
})->name('eligibility');


// Route::get('/eligibility', function () {
//     return view('eligibility');
// })->name('eligibility');




Route::post('/save-data', [AppController::class, 'saveData'])->name('saveData');

Route::post('/check-eligibility', [AppController::class, 'checkEligibility'])->name('check-eligibility');

Route::post('/apply-now', [AppController::class, 'applyNow'])->name('apply-now');
