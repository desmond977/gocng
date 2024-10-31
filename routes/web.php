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

Route::get('/', function () {
    // Http::get();
    // Http::post();
    // Http::put();
    // Http::delete();
    // Http::patch();
    return view('welcome');
});

Route::get('/formpage', function (Request $request) {
    if(!$request->phone){
        return redirect()->back()->withInput($request->all());
    }
    $result=Http::withQueryParameters([
        'phone'=>$request->phone,
        'password'=>'8xhlYx_94{e$'
    ])
    ->withHeaders([
        'Accept'=>'ápplication/json'
    ])
        ->get('https://datastore.oncloud.com.ng/payload/getinfo');

    $result= $result->body();
     $result=json_decode($result, true);

    return view('formpage',compact('result'));
})->name('formpage');




Route::get('/eligibility', function () {
    return view('eligibility');
})->name('eligibility');




Route::post('/save-data', [AppController::class, 'saveData'])->name('saveData');
