<?php

use App\Events\NewTrade;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/playground',function(){
//     try{
//         event(new NewTrade());

//     }catch(Exception $e){
//         dd($e->getMessage());
//     }

//     return null;
// });

Route::get('/trigger/{data}', function ($data) {
    echo "<p>You have sent $data</p>";
    event(new App\Events\NewTrade($data));
});
