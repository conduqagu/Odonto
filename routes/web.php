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


Route::group(['middleware'=> 'App\Http\Middleware\AdminMiddleware'], function()
{
    Route::get('/perfiladmin','UserController@perfiladmin')->name('perfiladmin');
    Route::put('/perfiladmin/update/{id}','UserController@updateperfiladmin')->name('updateperfiladmin');
    Route::get('/user/create','UserController@create')->name('userCreate');
    Route::post('/user/store','UserController@store')->name('userStore');
    Route::get('/user','UserController@index')->name('userIndex');
    Route::get('/user/edit/{id}','UserController@edit')->name('user.edit');
    Route::put('/user/update/{id}','UserController@update')->name('user.update');
    Route::delete('/user/destroy/{id}','UserController@destroy')->name('user.destroy');
    Route::get('/exams/indexExamsAdmin', 'ExamController@indexExamsAdmin')->name('indexExamsAdmin');
    Route::resource('tipo_tratamientos', 'TipoTratamientoController');
    Route::resource('brakets', 'BraketController');
    Route::resource('diagnosticos', 'DiagnosticoController');
    Route::get('/asociacion_exam_diente_periodonciaA/index/{id}', 'AsociacionExamDienteController@indexPeriodoncia')->name('index_asociacionEDPeriodonciaA');
    Route::get('/exams/index_asociacionEDA/{id}', 'AsociacionExamDienteController@indexasociacionEDTeacher')->name('indexasociacionEDA');
    Route::get('/indexstudents/{id}','UserController@indexstudents')->name('indexstudents');
    Route::get('/destroyasociación/{id}','UserController@destroyasociacion')->name('destroyasociacion');
    Route::get('/asignaralumno/{id}','UserController@asignaralumno')->name('asignaralumno');

});

Route::group(['middleware'=> 'App\Http\Middleware\TeacherMiddleware'], function()
{
    Route::get('/user/createT','UserController@create')->name('userCreateT');
    Route::post('/user/storeT','UserController@store')->name('userStoreT');
    Route::get('/patients/indexteacher','PatientController@indexteacher')->name('indexteacher');
    Route::get('/patients/createteacher','PatientController@createteacher')->name('createteacher');
    Route::post('/patients/storeteacher','PatientController@storeteacher')->name('storeteacher');
    Route::get('/patients/editteacher/{id}','PatientController@editteacher')->name('editteacher');
    Route::put('/patients/updateteacher/{id}','PatientController@updateteacher')->name('updateteacher');
    Route::delete('/patients/{id}','PatientController@destroy')->name('patientdestroy');
    //Route::get('/patients/añadirAlumno/{id}','PatientController@añadirAlumno')->name('añadirAlumno');
    Route::get('/patients/storeAlumno/{id}','PatientController@storeAlumno')->name('storeAlumno');
    Route::get('/patients/destroyStudent/{id}','PatientController@destroyStudent')->name('destroyStudent');
    Route::delete('/patients/deleteStudent/{id}','PatientController@deleteStudent')->name('deleteStudent');
    Route::get('/perfiles/perfilteacher','UserController@perfilteacher')->name('perfilteacher');
    Route::put('/perfiles/updateperfilteacher/{id}','UserController@updateperfilteacher')->name('updateperfilteacher');
    Route::get('/exams/indexStudent/{id}','ExamController@indexStudent')->name('examsIndexStudent');
    Route::delete('/exams/delete/{id}','ExamController@examsdeleteTeacher')->name('examsdeleteTeacher');
    Route::get('/exams/createteacher/{id}','ExamController@examsCreateTeacher')->name('examsCreateTeacher');
    Route::post('/exams/storeteacher','ExamController@examsStoreTeacher')->name('examsStoreTeacher');
    Route::get('/exams/editteacher/{id}','ExamController@examsEditTeacher')->name('examsEditTeacher');
    Route::put('/exams/updateteacher/{id}','ExamController@examsUpdateTeacher')->name('examsUpdateTeacher');

    Route::resource('storage', 'StorageController');
});

Route::group(['middleware'=> 'App\Http\Middleware\StudentMiddleware'], function()
{
    Route::get('/patients/index','PatientController@index')->name('patients.index');
    Route::get('/patients/create','PatientController@create')->name('patients.create');
    Route::post('/patients/store','PatientController@store')->name('patients.store');
    Route::get('/patients/edit/{id}','PatientController@edit')->name('patients.edit');
    Route::put('/patients/update/{id}','PatientController@update')->name('patients.update');
    Route::get('/perfiles/perfilstudent','UserController@perfilstudent')->name('perfilstudent');
    Route::put('/perfiles/updateperfilstudent/{id}','UserController@updateperfilstudent')->name('updateperfilstudent');
    Route::get('/exams/destroyStudent/{id}','ExamController@examsdestroyStudent')->name('examsdestroyStudent');
    Route::delete('/exams/deleteStudent/{id}','ExamController@examsdeleteStudent')->name('examsdeleteStudent');
    Route::get('/exams/create/{id}','ExamController@create')->name('exams.create');
    Route::post('/exams/store','ExamController@store')->name('exams.store');
    Route::get('/exams/edit/{id}','ExamController@edit')->name('exams.edit');
    Route::put('/exams/update/{id}','ExamController@update')->name('exams.update');

});

Route::group(['middleware'=> 'auth'], function() {

    Route::get('/imprimir/{id}', 'ExamController@imprimir')->name('imprimir_examen');
    Route::get('/patients/dientesPatient/{id}', 'DienteController@indexPatient')->name('dientesPatient');
    Route::get('/patients/createDientesPac/{id}', 'DienteController@createDientesPac')->name('createDientesPac');
    Route::get('/patients/createDientesPacChild/{id}', 'DienteController@createDientesPacChild')->name('createDientesPacChild');
    Route::get('/diente/create/{id}','DienteController@create')->name('diente.create');
    Route::resource('dientes', 'DienteController');
    Route::post('/asociacion_ExamDiags/store/{id}', 'DiagnosticoController@store_asociacion_diagnostico_exam')->name('asociacion_ExDiags.store');
    Route::get('/asociacion_ExamDiags/create/{id}', 'DiagnosticoController@create_asociacion_diagnostico_exam')->name('asociacion_ExDiags.create');
    Route::delete('/asociacion_ExamDiags/destroy/{id}', 'DiagnosticoController@destroy_asociacion_diagnostico_exam')->name('asociacion_ExDiags.destroy');
    Route::get('/exams/evaluaciones/{id}','ExamController@evaluaciones')->name('exams.evaluaciones');


    Route::get('/prueba_complementaria/create/{id}', 'PruebaComplementariaController@create')->name('prueba_complementarias.createT');
    Route::resource('prueba_complementarias', 'PruebaComplementariaController');
    Route::get('/tratamientos/create/{id}', 'TratamientoController@createT')->name('tratamientos.createT');
    Route::resource('tratamientos', 'TratamientoController');

    Route::get('/exams/edit_iva/{id}','ExamController@edit_iva')->name('edit_iva');
    Route::put('/exams/update_iva/{id}','ExamController@update_iva')->name('update_iva');
    //Route::get('/exams/index/{id}', 'ExamController@index')->name('exams.index');
    Route::get('/exams/show/{id}', 'ExamController@show')->name('exams.show');
    Route::get('/exams/create_asociacionED/{id}', 'AsociacionExamDienteController@create_asociacionED')->name('create_asociacionED');
    Route::post('/exams/store_asociacionED/{id}', 'AsociacionExamDienteController@store_asociacionED')->name('store_asociacionED');
    Route::get('/exams/index_asociacionED/{id}', 'AsociacionExamDienteController@index')->name('index_asociacionED');
    Route::get('/exams/edit_asociacionED/{id}','AsociacionExamDienteController@edit')->name('edit_asociacionED');
    Route::put('/exams/update_asociacionED/{id}','AsociacionExamDienteController@update')->name('update_asociacionED');
    Route::get('/asociacion_exam_diente_periodoncia/create/{id}', 'AsociacionExamDienteController@create_asociacionEDPeriodoncia')->name('create_asociacionEDPeriodoncia');
    Route::post('/asociacion_exam_diente_periodoncia/store/{id}', 'AsociacionExamDienteController@store_asociacionEDPeriodoncia')->name('store_asociacionEDPeriodoncia');
    Route::get('/asociacion_exam_diente_periodoncia/index/{id}', 'AsociacionExamDienteController@indexPeriodoncia')->name('index_asociacionEDPeriodoncia');
    Route::get('/asociacion_exam_diente_periodoncia/edit/{id}', 'AsociacionExamDienteController@edit_asociacionEDPeriodoncia')->name('edit_asociacionEDPeriodoncia');
    Route::put('/asociacion_exam_diente_periodoncia/update/{id}', 'AsociacionExamDienteController@update_asociacionEDPeriodoncia')->name('update_asociacionEDPeriodoncia');
    Route::get('/correo/{id}', 'ExamController@correo_pago')->name('correo_pago');


    Route::get('/exams/createTeacherInicial/{id}', 'ExamController@examsCreateTeacherInicial')->name('examsCreateTeacherInicial');
    Route::put('/exams/updateteacherInicial/{id}', 'ExamController@examsUptadeTeacherInicial')->name('examsUptadeTeacherInicial');
    Route::get('/exams/createTeacherInfantil/{id}', 'ExamController@examsCreateTeacherInfantil')->name('examsCreateTeacherInfantil');
    Route::put('/exams/updateteacherInfantil/{id}', 'ExamController@examsUptadeTeacherInfantil')->name('examsUptadeTeacherInfantil');
    Route::get('/exams/createTeacherPeriodontal/{id}', 'ExamController@examsCreateTeacherPeriodontal')->name('examsCreateTeacherPeriodontal');
    Route::put('/exams/updateteacherPeriodontal/{id}', 'ExamController@examsUptadeTeacherPeriodontal')->name('examsUptadeTeacherPeriodontal');
    Route::get('/exams/createTeacherOrtodoncia/{id}', 'ExamController@examsCreateTeacherOrtodoncia')->name('examsCreateTeacherOrtodoncia');
    Route::put('/exams/updateteacherOrtodoncia/{id}', 'ExamController@examsUptadeTeacherOrtodoncia')->name('examsUptadeTeacherOrtodoncia');
    Route::get('/exams/createTeacherevOrto/{id}', 'ExamController@examsCreateTeacherevOrto')->name('examsCreateTeacherevOrto');
    Route::put('/exams/updateteacherevOrto/{id}', 'ExamController@examsUptadeTeacherevOrto')->name('examsUptadeTeacherevOrto');
    Route::get('/exams/pagado/{id}', 'ExamController@pagado')->name('pagado');
    Route::get('/exams/no_pagado/{id}', 'ExamController@no_pagado')->name('no_pagado');


    Route::get('/patients/show/{id}','PatientController@show')->name('patients.show');

});

Route::get('/paypal/pay/{id}', 'PaymentController@payWithPayPal')->name('paypal_pay');
Route::get('/paypal/status/{id}', 'PaymentController@payPalStatus')->name('paypal_status');
Route::get('/pago/error', 'PaymentController@pago_error')->name('pago_error');
Route::get('/pago/correcto', 'PaymentController@pago_correcto')->name('pago_correcto');

Route::get('/informacion', function () {
    return view('objetivos');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

