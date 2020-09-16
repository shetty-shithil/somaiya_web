<?php

use Illuminate\Support\Facades\Route;
use App\Events;
use App\Venue;
use App\stake_holders;
use App\Event_Permissions;
use App\Users;
use App\event_schedule;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    $events=Events::all('id','title','department','stake_holder_id');
    $evs=event_schedule::all('date','start_time','end_time');
    return view('events.calendar',compact('events','evs'));
});
Route::resource('events','EventsController');
// Route::get('/events/create', 'EventsController@create');
// Route::post('/events/create', 'EventsController@store');
// Route::post('/events','EventsController@store');

Auth::routes();
Route::get('register', 'UsersController@showRegistrationForm')->name('register');
Route::post('register', 'UsersController@register');
// Route::post('events/{params}','EventsController@store');

Route::get('/venues','EventsController@venues');
Route::get('/eventst','EventsController@eventst');
Route::get('stkh','EventsController@stakeholders');
Route::get('estkh','EventsController@eventstakeholders');
Route::get('permissions','EventsController@eventpermissions');
Route::get('schedules','EventsController@eventschedules');

// Route::post('/eventst','EventsController@stores');
// Route::post('stkh','EventsController@stakeholders');
// Route::post('estkh','EventsController@eventstakeholders');
// Route::post('permissions','EventsController@eventpermissions');
// Route::post('schedules','EventsController@eventschedules');

Route::get('/home', 'HomeController@index')->name('home');
