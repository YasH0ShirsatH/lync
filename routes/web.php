<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PageController;

// Override Laravel Grapes package routes FIRST to ensure precedence
Route::middleware('auth:teacher')->group(function() {
    Route::post('hello/front-end-builder/create-page', [PageController::class, 'store'])->name('new_page.store');
    Route::post('cms/front-end-builder/create-page', [PageController::class, 'store']);
    Route::put('hello/front-end-builder/update-page-content/{id}', [PageController::class, 'updateContent'])->name('update.page_content');
    Route::get('hello/front-end-builder/all-pages', [PageController::class, 'allPages'])->name('page.all');
    Route::get('hello/front-end-builder/find-page/{id}', [PageController::class, 'show'])->name('page.find');
    Route::delete('hello/front-end-builder/delete-page/{id}', [PageController::class, 'destroy'])->name('page.delete');
    Route::put('hello/front-end-builder/update-page/{id}', [PageController::class, 'update'])->name('update.page');
});

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'account'],function(){

    //GUEST MIDDLEWARE
    Route::group(['middleware' => 'guest.multi'],function(){
//         Route::get('/login', [LoginController::class, 'index'])->name('account.login');
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
Route::get('/{slug}', [PageController::class, 'showBySlug']);


// Teacher Routes
Route::group(['middleware' => 'auth:teacher'], function(){
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/teacher/forms', [TeacherController::class, 'getForms'])->name('teacher.forms');
    Route::post('/teacher/assign-form', [TeacherController::class, 'assignFormToClassrooms'])->name('teacher.assignForm');
    Route::get('/teacher/formBuilder', [FormController::class, 'formBuilder'])->name('teacher.formBuilder');
    Route::get('/teacher/showForm/{id}', [FormController::class, 'showForm'])->name('teacher.showForm');
    Route::get('/teacher/editForm/{id}', [FormController::class, 'editForm'])->name('teacher.editForm');
    Route::post('/teacher/updateForm/{id}', [FormController::class, 'update'])->name('teacher.updateForm');
    Route::get('/teacher/classroom/setup', [TeacherController::class, 'classroomInitialSetup'])->name('teacher.classroom.setup');
    Route::get('/teacher/deleteForm/{id}', [FormController::class, 'deleteForm'])->name('teacher.deleteForm');
    Route::get('/teacher/deleteClass/{id}', [ClassroomController::class, 'deleteClass'])->name('teacher.deleteClass');

    Route::get('/teacher/classroom/show/{id}', [ClassroomController::class, 'index'])->name('teacher.classroom.show');
    Route::post('/teacher/classroom/save', [ClassroomController::class, 'createClassroom'])->name('teacher.classroom.save');
    Route::post('/form/save', [FormController::class, 'store'])->name('form.save');
    Route::get('/teacher/classroom/{classroom}/removeForm/{form}', [ClassroomController::class, 'removeForm'])->name('teacher.classroom.removeForm');
    Route::get('/teacher/classroom/{classroom}/form/{form}/responses', [ClassroomController::class, 'viewAllResponses'])->name('teacher.classroom.viewResponses');
    Route::get('/teacher/classroom/{classroom}/student/{student}/responses', [ClassroomController::class, 'viewStudentResponses'])->name('teacher.classroom.viewStudentResponses');
    Route::get('/teacher/submission/{submission}', [ClassroomController::class, 'viewSubmission'])->name('teacher.viewSubmission');
    Route::put('/teacher/submission/{submission}/remark', [ClassroomController::class, 'updateSubmissionRemark'])->name('teacher.updateSubmissionRemark');
    Route::get('/teacher/classroom/cms', [PageController::class, 'builder'])->name('website.builder.teacher');
    Route::get('hello/front-end-builder', [PageController::class, 'builder'])->name('website.builder');

    // Block/Component routes
    Route::get('hello/get/custome-components', function() { return response()->json([]); })->name('custome_component.all');
    Route::post('hello/store/custome-component', function() { return response()->json(['success' => true]); })->name('custome_component.store');
    Route::put('hello/store/custome-component/update/{id}', function() { return response()->json(['success' => true]); })->name('update.component');
    Route::delete('hello/store/custome-component/delete/{id}', function() { return response()->json(['success' => true]); })->name('component.delete');

    Route::get('/teacher/classroom/cms/websiteLinks', [PageController::class, 'showWebsiteLinks'])->name('website.links.teacher');
    Route::get('teacher/website/delete/{id}' , [PageController::class, 'destroyPage'])->name('teacher.deletePage');
    Route::delete('/pages/{id}', [PageController::class, 'destroy'])->name('pages.destroy');


});

// Student Routes
Route::group(['middleware' => 'auth:student'], function(){
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/classrooms', [StudentController::class, 'viewClasses'])->name('student.classes');
    Route::get('/student/classrooms/{classroom}/forms', [StudentController::class, 'viewAssignedForms'])->name('student.viewAssignedForms');
    Route::get('/student/classrooms/joined', [StudentController::class, 'viewJoinedClasses'])->name('student.viewJoinedClasses');
    Route::get('/student/classrooms/{classroom}/forms/{form}', [StudentController::class, 'showForm'])->name('student.showForm');
    Route::post('/student/join-class', [StudentController::class, 'joinClass'])->name('student.joinClass');
    Route::post('/student/leave-class', [StudentController::class, 'leaveClass'])->name('student.leaveClass');
    Route::post('/student/submit-form', [StudentController::class, 'submitForm'])->name('student.submitForm');
    Route::get('/student/all-assigned-forms', [StudentController::class, 'viewAllAssignedForms'])->name('student.allAssignedForms');
});









