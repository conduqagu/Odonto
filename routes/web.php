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
    Route::get('/destroyasociación/{id}','UserController@destroyasociacion')->name('destroyasociacion');
    Route::get('/listsmystudent','UserController@listsmystudent')->name('listsmystudent');
    Route::get('/asignaralumno/{id}','UserController@asignaralumno')->name('asignaralumno');
    Route::get('/patients/indexteacher','PatientController@indexteacher')->name('indexteacher');
    Route::get('/patients/createteacher','PatientController@createteacher')->name('createteacher');
    Route::post('/patients/storeteacher','PatientController@storeteacher')->name('storeteacher');
    Route::get('/patients/editteacher/{id}','PatientController@editteacher')->name('editteacher');
    Route::put('/patients/updateteacher/{id}','PatientController@updateteacher')->name('updateteacher');
    Route::delete('/patients/{id}','PatientController@destroy')->name('patientdestroy');
    Route::get('/patients/añadirAlumno/{id}','PatientController@añadirAlumno')->name('añadirAlumno');
    Route::get('/patients/storeAlumno/{id}','PatientController@storeAlumno')->name('storeAlumno');
    Route::get('/patients/destroyStudent/{id}','PatientController@destroyStudent')->name('destroyStudent');
    Route::delete('/patients/deleteStudent/{id}','PatientController@deleteStudent')->name('deleteStudent');

});

Route::group(['middleware'=> 'App\Http\Middleware\StudentMiddleware'], function()
{
    Route::get('/patients/index','PatientController@index')->name('patients.index');
    Route::get('/patients/create','PatientController@create')->name('patients.create');
    Route::post('/patients/store','PatientController@store')->name('patients.store');
    Route::get('/patients/edit/{id}','PatientController@edit')->name('patients.edit');
    Route::put('/patients/update/{id}','PatientController@update')->name('patients.update');


});


Route::get('/patients/dientesPatient/{id}','DienteController@indexPatient')->name('dientesPatient');
Route::get('/patients/createDientesPac/{id}','DienteController@createDientesPac')->name('createDientesPac');
Route::get('/patients/createDientesPacChild/{id}','DienteController@createDientesPacChild')->name('createDientesPacChild');
Route::resource('dientes','DienteController');


Route::get('/exams/index_asociacionED/{id}','AsociacionExamDienteController@index')->name('index_asociacionED');
Route::get('/exams/create_asociacionED/{id}','AsociacionExamDienteController@create_asociacionED')->name('create_asociacionED');
Route::post('/exams/store_asociacionED/{id}','AsociacionExamDienteController@store_asociacionED')->name('store_asociacionED');
Route::get('/exams/edit_asociacionED/{id}','AsociacionExamDienteController@edit')->name('edit_asociacionED');
Route::put('/exams/update_asociacionED/{id}','AsociacionExamDienteController@update')->name('update_asociacionED');



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
