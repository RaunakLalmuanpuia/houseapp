<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\FlamController;
use App\Http\Controllers\OnDutyController;
use App\Http\Controllers\NotOnDutyController;
use App\Http\Controllers\NonOfficialController;
use App\Http\Controllers\StudyTourController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\AdminApplicationController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});



Route::get('/apply/step-one', function () {
    return Inertia::render('Form/StepOne', [
    ]);
})->name('apply.step-one');

//Route::get('/apply/step-one', [FlamController::class, 'stepOne'])->name('apply.step-one');

//Flam
Route::group(['prefix'=>'flam'], function () {
    Route::get('/apply/step-one', [FlamController::class, 'stepOne'])->name('apply.flam.step-one');
    Route::get('/apply/step-two', [FlamController::class, 'stepTwo'])->name('apply.flam.step-two');
    Route::get('/apply/step-three', [FlamController::class, 'stepThree'])->name('apply.flam.step-three');

// Final submission
    Route::post('/apply/submit', [FlamController::class, 'submit'])->name('apply.flam.submit');
    Route::get('submission', [FlamController::class, 'submission'])->name('apply.flam.submission');
});
//On Duty
Route::group(['prefix'=>'on-duty'], function () {
    Route::get('/apply/step-one', [OnDutyController::class, 'stepOne'])->name('apply.on-duty.step-one');
    Route::get('/apply/step-two', [OnDutyController::class, 'stepTwo'])->name('apply.on-duty.step-two');
    Route::get('/apply/step-three', [OnDutyController::class, 'stepThree'])->name('apply.on-duty.step-three');

// Final submission
    Route::post('/apply/submit', [OnDutyController::class, 'submit'])->name('apply.on-duty.submit');

    Route::get('submission', [OnDutyController::class, 'submission'])->name('apply.on-duty.submission');
});
//Not on Duty
Route::group(['prefix'=>'not-on-duty'], function () {
    Route::get('/apply/step-one', [NotOnDutyController::class, 'stepOne'])->name('apply.not-on-duty.step-one');
    Route::get('/apply/step-two', [NotOnDutyController::class, 'stepTwo'])->name('apply.not-on-duty.step-two');
    Route::get('/apply/step-three', [NotOnDutyController::class, 'stepThree'])->name('apply.not-on-duty.step-three');

    // Final submission
    Route::post('/apply/submit', [NotOnDutyController::class, 'submit'])->name('apply.not-on-duty.submit');

    Route::get('submission', [NotOnDutyController::class, 'submission'])->name('apply.not-on-duty.submission');
});
//Private
Route::group(['prefix'=>'non-official'], function () {
    Route::get('/apply/step-one', [NonOfficialController::class, 'stepOne'])->name('apply.non-official.step-one');
    Route::get('/apply/step-two', [NonOfficialController::class, 'stepTwo'])->name('apply.non-official.step-two');
    Route::get('/apply/step-three', [NonOfficialController::class, 'stepThree'])->name('apply.non-official.step-three');

    // Final submission
    Route::post('/apply/submit', [NonOfficialController::class, 'submit'])->name('apply.non-official.submit');
    Route::get('submission', [NonOfficialController::class, 'submission'])->name('apply.non-official.submission');
});


//Study Tour
Route::group(['prefix'=>'study-tour'], function () {
    Route::get('/apply/step-one', [StudyTourController::class, 'stepOne'])->name('apply.study-tour.step-one');
    Route::get('/apply/step-two', [StudyTourController::class, 'stepTwo'])->name('apply.study-tour.step-two');
    Route::get('/apply/step-three', [StudyTourController::class, 'stepThree'])->name('apply.study-tour.step-three');

    // Final submission
    Route::post('/apply/submit', [StudyTourController::class, 'submit'])->name('apply.study-tour.submit');

    Route::get('submission', [StudyTourController::class, 'submission'])->name('apply.study-tour.submission');
});

// Check application status
Route::group(['prefix'=>'status'], function () {
    Route::get('index', [StatusController::class, 'index'])->name('status.index');
    Route::get('{applicationId}', [StatusController::class, 'getStatus'])->name('status.application');
    Route::get('{applicationId}/view', [StatusController::class, 'show'])->name('status.show-application');

});

// Admin Applications
Route::group(['prefix'=>'admin'], function () {
    Route::get('/applications/incoming', [AdminApplicationController::class, 'incoming'])->name('admin.application.incoming');
//    Route::get('{applicationId}', [StatusController::class, 'getStatus'])->name('status.application');
//    Route::get('{applicationId}/view', [StatusController::class, 'show'])->name('status.show-application');

});



Route::group([], function () {

    Route::get('login', [AuthController::class, 'create'])->name('login');
//    Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('login.forgot');
//    Route::post('forgot-password/send-otp', [AuthController::class, 'sendOtp'])->name('forgot.send');
//    Route::post('forgot-password/verify-otp', [AuthController::class, 'verifyOtp'])->name('forgot.verify');
//    Route::post('forgot-password/set-password', [AuthController::class, 'changePassword'])->name('forgot.password');
    Route::post('login', [AuthController::class, 'store'])->name('login.store');
    Route::delete('logout', [AuthController::class, 'destroy'])->name('login.destroy');

});
