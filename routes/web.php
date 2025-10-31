<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'account'],function(){

    //GUEST MIDDLEWARE
    Route::group(['middleware' => 'guest.multi'],function(){
        Route::get('/login', [LoginController::class, 'index'])->name('account.login');
        Route::post('/login', [LoginController::class, 'authenticate'])->name('account.login-post');
        Route::get('/register', [LoginController::class, 'register'])->name('account.register');
        Route::post('/register', [LoginController::class, 'processRegister'])->name('account.register-post');
    });

    //AUTH MIDDLEWARE
    Route::group(['middleware' => 'auth'],function(){
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('account.dashboard');
    });
});

// Logout route accessible by both guards
Route::get('/account/logout', [LoginController::class, 'logout'])->name('account.logout');

// Teacher Routes
Route::group(['middleware' => 'auth:teacher'], function(){
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/teacher/formBuilder', [FormController::class, 'formBuilder'])->name('teacher.formBuilder');
    Route::get('/teacher/showForm/{id}', [FormController::class, 'showForm'])->name('teacher.showForm');
    Route::get('/teacher/classroom/setup', [TeacherController::class, 'classroomInitialSetup'])->name('teacher.classroom.setup');
    Route::get('/teacher/deleteForm/{id}', [FormController::class, 'deleteForm'])->name('teacher.deleteForm');
    Route::get('/teacher/classroom', [ClassroomController::class, 'index'])->name('teacher.classroom');
    Route::post('/teacher/classroom/save', [ClassroomController::class, 'createClassroom'])->name('teacher.classroom.save');
    Route::post('/form/save', [FormController::class, 'store'])->name('form.save');

});

// Student Routes
Route::group(['middleware' => 'auth:student'], function(){
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');

});









