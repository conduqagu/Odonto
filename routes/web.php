<?php

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
Route::get('/información', function () {
    return view('objetivos');
});


Route::group(['middleware'=> 'App\Http\Middleware\TeacherMiddleware'], function()
{
    Route::get('/indexstudents','UserController@indexstudents')->name('indexstudents');
    Route::get('/asignaralumno/{id}','UserController@asignaralumno')->name('asignaralumno');
    Route::get('/patients/indexteacher','PatientController@indexteacher')->name('indexteacher');
    Route::get('/patients/createteacher','PatientController@createteacher')->name('createteacher');
    Route::post('/patients/storeteacher','PatientController@storeteacher')->name('storeteacher');
    Route::delete('/patients/destroy','PatientController@destroy')->name('destroy');


});

Route::group(['middleware'=> 'App\Http\Middleware\StudentMiddleware'], function()
{
    Route::get('/patients/index','PatientController@index')->name('index');
    Route::get('/patients/create','PatientController@create')->name('create');

});
Route::resource('patients','PatientController');
Route::resource('dientes','DienteController');
Route::resource('exams','ExamController');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
