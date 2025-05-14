<?php

use App\Models\Faq;
use App\Models\Notice;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\FlamController;
use App\Http\Controllers\OnDutyController;
use App\Http\Controllers\NotOnDutyController;
use App\Http\Controllers\NonOfficialController;
use App\Http\Controllers\StudyTourController;
use App\Http\Controllers\MedicalController;

use App\Http\Controllers\StatusController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\FaqController;

use App\Http\Controllers\AdminApplicationController;

use App\Http\Controllers\ReportController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\RateCategoryController;

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\HouseApplicationController;
use App\Http\Controllers\UserController;




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

// Fetch all houses with their room types and room rates {Welcome page}
Route::get('/houses', [HouseController::class, 'json_index'])->name('house.json_index');

// Fetch FAQs {welcome page}
Route::get('/faqs_json',[FaqController::class, 'json_index'])->name('faqs.json_index');

//FAQS Page
Route::get('/faqs', function () {
    return Inertia::render('Faqs/Show', [
        'faqs' => Faq::where('status', 'active')->get(),
    ]);
})->name('faq.show');


//Notice Page
Route::get('/notice', function () {
    return Inertia::render('Notice/Show', [
        'notices' => Notice::where('status', 'published')->paginate(10),
    ]);
})->name('notice.show');


//Step 1
Route::get('/apply/step-one', function () {
    return Inertia::render('Form/StepOne', [
    ]);
})->name('apply.step-one');

//Flam
Route::group(['prefix'=>'flam'], function () {
    Route::get('/apply/step-one', [FlamController::class, 'stepOne'])->name('apply.flam.step-one');
    Route::get('/apply/step-two', [FlamController::class, 'stepTwo'])->name('apply.flam.step-two');
    Route::get('/apply/step-three', [FlamController::class, 'stepThree'])->name('apply.flam.step-three');
    Route::get('/apply/verify', [FlamController::class, 'verify'])->name('apply.flam.verify');
    Route::post('/apply/submit', [FlamController::class, 'submit'])->name('apply.flam.submit');
    Route::get('submission', [FlamController::class, 'submission'])->name('apply.flam.submission');
});

//On Duty
Route::group(['prefix'=>'on-duty'], function () {
    Route::get('/apply/step-one', [OnDutyController::class, 'stepOne'])->name('apply.on-duty.step-one');
    Route::get('/apply/step-two', [OnDutyController::class, 'stepTwo'])->name('apply.on-duty.step-two');
    Route::get('/apply/step-three', [OnDutyController::class, 'stepThree'])->name('apply.on-duty.step-three');
    Route::get('/apply/verify', [OnDutyController::class, 'verify'])->name('apply.on-duty.verify');
    Route::post('/apply/submit', [OnDutyController::class, 'submit'])->name('apply.on-duty.submit');
    Route::get('submission', [OnDutyController::class, 'submission'])->name('apply.on-duty.submission');
});

//Not on Duty
Route::group(['prefix'=>'not-on-duty'], function () {
    Route::get('/apply/step-one', [NotOnDutyController::class, 'stepOne'])->name('apply.not-on-duty.step-one');
    Route::get('/apply/step-two', [NotOnDutyController::class, 'stepTwo'])->name('apply.not-on-duty.step-two');
    Route::get('/apply/step-three', [NotOnDutyController::class, 'stepThree'])->name('apply.not-on-duty.step-three');
    Route::get('/apply/verify', [NotOnDutyController::class, 'verify'])->name('apply.not-on-duty.verify');
    Route::post('/apply/submit', [NotOnDutyController::class, 'submit'])->name('apply.not-on-duty.submit');
    Route::get('submission', [NotOnDutyController::class, 'submission'])->name('apply.not-on-duty.submission');
});


//Medical
Route::group(['prefix'=>'medical'], function () {
    Route::get('/apply/step-one', [MedicalController::class, 'stepOne'])->name('apply.medical.step-one');
    Route::get('/apply/step-two', [MedicalController::class, 'stepTwo'])->name('apply.medical.step-two');
    Route::get('/apply/step-three', [MedicalController::class, 'stepThree'])->name('apply.medical.step-three');
    Route::get('/apply/verify', [MedicalController::class, 'verify'])->name('apply.medical.verify');
    Route::post('/apply/submit', [MedicalController::class, 'submit'])->name('apply.medical.submit');
    Route::get('submission', [MedicalController::class, 'submission'])->name('apply.medical.submission');
});

//Private
Route::group(['prefix'=>'non-official'], function () {
    Route::get('/apply/step-one', [NonOfficialController::class, 'stepOne'])->name('apply.non-official.step-one');
    Route::get('/apply/step-two', [NonOfficialController::class, 'stepTwo'])->name('apply.non-official.step-two');
    Route::get('/apply/step-three', [NonOfficialController::class, 'stepThree'])->name('apply.non-official.step-three');
    Route::get('/apply/verify', [NonOfficialController::class, 'verify'])->name('apply.non-official.verify');
    Route::post('/apply/submit', [NonOfficialController::class, 'submit'])->name('apply.non-official.submit');
    Route::get('submission', [NonOfficialController::class, 'submission'])->name('apply.non-official.submission');
});

//Study Tour
Route::group(['prefix'=>'study-tour'], function () {
    Route::get('/apply/step-one', [StudyTourController::class, 'stepOne'])->name('apply.study-tour.step-one');
    Route::get('/apply/step-two', [StudyTourController::class, 'stepTwo'])->name('apply.study-tour.step-two');
    Route::get('/apply/step-three', [StudyTourController::class, 'stepThree'])->name('apply.study-tour.step-three');
    Route::get('/apply/verify', [StudyTourController::class, 'verify'])->name('apply.study-tour.verify');
    Route::post('/apply/submit', [StudyTourController::class, 'submit'])->name('apply.study-tour.submit');
    Route::get('submission', [StudyTourController::class, 'submission'])->name('apply.study-tour.submission');
});

// Check application status
Route::group(['prefix'=>'status'], function () {
    Route::get('index', [StatusController::class, 'index'])->name('status.index');
    Route::get('{applicationId}', [StatusController::class, 'getStatus'])->name('status.application');
    Route::get('{applicationId}/view', [StatusController::class, 'show'])->name('status.show-application');

});


//Application Actions
Route::group([], function () {
    Route::post('/applications/{application}/forward', [ApplicationController::class, 'forward'])->name('applications.forward');
    Route::post('/applications/{application}/approve', [ApplicationController::class, 'approve'])->name('applications.approve');
    Route::post('/applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');


    Route::get('/applications/{application}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');

    Route::put('/applications/flam/{application}/update', [ApplicationController::class, 'updateFlam'])->name('applications.flam.update');

    Route::post('/applications/on-duty/{application}/update', [ApplicationController::class, 'updateOnDuty'])->name('applications.on-duty.update');

    Route::put('/applications/not-on-duty/{application}/update', [ApplicationController::class, 'updateNotOnDuty'])->name('applications.not-on-duty.update');

    Route::put('/applications/not-official/{application}/update', [ApplicationController::class, 'updateNonOfficial'])->name('applications.not-official.update');

    Route::post('/applications/study-tour/{application}/update', [ApplicationController::class, 'updateStudyTour'])->name('applications.study-tour.update');



});



////Application Actions
//Route::group([], function () {
//    Route::post('/applications/{application}/forward', [ApplicationController::class, 'forward'])->middleware('role:Admin')->name('applications.forward');
//    Route::post('/applications/{application}/approve', [ApplicationController::class, 'approve'])->middleware('role:Admin|House')->name('applications.approve');
//    Route::post('/applications/{application}/reject', [ApplicationController::class, 'reject'])->middleware('role:Admin|House')->name('applications.reject');
//});


// Admin Applications
Route::group(['prefix'=>'admin'], function () {
    Route::get('/applications/incoming', [AdminApplicationController::class, 'indexIncoming'])->name('admin.application.index_incoming');
    Route::get('/applications/approved', [AdminApplicationController::class, 'indexApproved'])->name('admin.application.index_approved');
    Route::get('/applications/rejected', [AdminApplicationController::class, 'indexRejected'])->name('admin.application.index_rejected');
    Route::get('/applications/{application}/view', [AdminApplicationController::class, 'viewApplication'])->name('admin.application.view');
});


// House Applications
Route::group(['prefix'=>'house'], function () {
    Route::get('/applications/incoming', [HouseApplicationController::class, 'indexIncoming'])->name('house.application.index_incoming');
    Route::get('/applications/approved', [HouseApplicationController::class, 'indexApproved'])->name('house.application.index_approved');
    Route::get('/applications/rejected', [HouseApplicationController::class, 'indexRejected'])->name('house.application.index_rejected');
    Route::get('/applications/{application}/view', [HouseApplicationController::class, 'viewApplication'])->name('house.application.view');
});

//Report
Route::group(['prefix'=>'admin'], function () {
    Route::get('/report', [ReportController::class, 'index'])->name('admin.report.index');
    Route::get('/json-index', [ReportController::class, 'jsonIndex'])->name('admin.report.json-index');
});
//Auth
Route::group([], function () {

    Route::get('login', [AuthController::class, 'create'])->name('login');
//    Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('login.forgot');
//    Route::post('forgot-password/send-otp', [AuthController::class, 'sendOtp'])->name('forgot.send');
//    Route::post('forgot-password/verify-otp', [AuthController::class, 'verifyOtp'])->name('forgot.verify');
//    Route::post('forgot-password/set-password', [AuthController::class, 'changePassword'])->name('forgot.password');
    Route::post('login', [AuthController::class, 'store'])->name('login.store');
    Route::delete('logout', [AuthController::class, 'destroy'])->name('login.destroy');

});
// FAQs
Route::group(['prefix'=>'admin'], function () {

    Route::get('/faq', [FaqController::class, 'index'])->name('admin.faq.index');
    Route::post('/faqs', [FaqController::class, 'store'])->name('admin.faq.store');
    Route::put('/faqs/{faq}', [FaqController::class, 'update'])->name('admin.faq.update');
    Route::delete('/faqs/{faq}', [FaqController::class, 'destroy'])->name('admin.faq.destroy');

});
//Notice
Route::group(['prefix'=>'admin'], function () {
    Route::get('/notice', [NoticeController::class, 'index'])->name('admin.notice.index');
    Route::post('/notice', [NoticeController::class, 'store'])->name('admin.notice.store');
    Route::put('/notice/{notice}', [NoticeController::class, 'update'])->name('admin.notice.update');
    Route::delete('/notice/{notice}', [NoticeController::class, 'destroy'])->name('admin.notice.destroy');
});
//Rate
Route::group(['prefix'=>'admin'], function () {
    Route::get('/rate', [RateController::class, 'index'])->name('admin.rate.index');
    Route::post('/rate', [RateController::class, 'store'])->name('admin.rate.store');
    Route::put('/rate/{roomRate}', [RateController::class, 'update'])->name('admin.rate.update');
    Route::delete('/rate/{roomRate}', [RateController::class, 'destroy'])->name('admin.rate.destroy');
});
// Settings
Route::group(['prefix'=>'admin'], function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings.index');
});
//House
Route::group(['prefix'=>'admin'], function () {
    Route::get('/house', [HouseController::class, 'index'])->name('admin.house.index');
    Route::post('/house', [HouseController::class, 'store'])->name('admin.house.store');
    Route::put('/house/{house}', [HouseController::class, 'update'])->name('admin.house.update');
    Route::delete('/house/{house}', [HouseController::class, 'destroy'])->name('admin.house.destroy');
});
//Room Category
Route::group(['prefix'=>'admin'], function () {
    Route::get('/rate-category', [RateCategoryController::class, 'index'])->name('admin.rate-category.index');
    Route::post('/rate-category', [RateCategoryController::class, 'store'])->name('admin.rate-category.store');
    Route::put('/rate-category/{rateCategory}', [RateCategoryController::class, 'update'])->name('admin.rate-category.update');
    Route::delete('/rate-category/{rateCategory}', [RateCategoryController::class, 'destroy'])->name('admin.rate-category.destroy');
});
// Room type
Route::group(['prefix'=>'admin'], function () {
    Route::get('/room_type', [RoomTypeController::class, 'index'])->name('admin.room_type.index');
    Route::post('/room_type/{house}', [RoomTypeController::class, 'store'])->name('admin.room_type.store');
    Route::put('/room_type/{house}/{roomType}', [RoomTypeController::class, 'update'])->name('admin.room_type.update');
    Route::delete('/room_type/{house}/{roomType}', [RoomTypeController::class, 'destroy'])->name('admin.room_type.destroy');
});


//Users
Route::group(['prefix'=>'admin'], function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::put('update/{model}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('{model}', [UserController::class, 'destroy'])->name('admin.users.destroy');

});


