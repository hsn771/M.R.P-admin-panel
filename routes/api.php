<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\PhotoGalleryController;
use App\Http\Controllers\Api\VideoGalleryController;
use App\Http\Controllers\Api\HeaderLogoController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\WomanNoticeController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\HeroSectionController;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\IntroductionController;
use App\Http\Controllers\Api\MissionController;
use App\Http\Controllers\Api\WomanEmpowerCardController as ApiWomanEmpowerCardController;
use App\Http\Controllers\Api\RequestSubmissionController as ApiRequestSubmissionController;
use App\Http\Controllers\Api\MemberRegistrationController;
use App\Http\Controllers\RequestSubmissionController;
use App\Http\Controllers\WomanEmpowerCardController;
use Illuminate\Support\Facades\Route;

// Public auth routes (API)
Route::post('/login', [AuthController::class, 'login']);

// Public routes (for React frontend)
Route::post('/request-submission', [RequestSubmissionController::class, 'store']);
Route::get('/request-submissions', [ApiRequestSubmissionController::class, 'index']);
Route::get('/request-form-image', [ApiRequestSubmissionController::class, 'getFormImage']);
Route::post('/woman-empower-card', [WomanEmpowerCardController::class, 'store']);
Route::get('/woman-empower-cards', [ApiWomanEmpowerCardController::class, 'index']);
Route::get('/woman-empower-form-image', [ApiWomanEmpowerCardController::class, 'getFormImage']);
Route::get('sliders', [SliderController::class, 'index']);
Route::get('/photo-galleries', [PhotoGalleryController::class, 'index']);
Route::get('/video-galleries', [VideoGalleryController::class, 'index']);
Route::get('/header-logos', [HeaderLogoController::class, 'index']);
Route::get('/event', [EventController::class, 'index']);
Route::get('/woman-notices', [WomanNoticeController::class, 'index']);
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/hero-sections', [HeroSectionController::class, 'index']);
Route::get('/abouts', [AboutController::class, 'index']);
Route::get('/introductions', [IntroductionController::class, 'index']);
Route::get('/missions', [MissionController::class, 'index']);
Route::post('/send-otp', [RequestSubmissionController::class, 'sendOTP']);
Route::post('/verify-otp', [RequestSubmissionController::class, 'verifyOTP']);
Route::post('/member-registration', [MemberRegistrationController::class, 'store']);
Route::post('/agent-registration', [\App\Http\Controllers\Api\AgentRegistrationController::class, 'store']);
Route::post('/sub-agent-registration', [\App\Http\Controllers\Api\SubAgentRegistrationController::class, 'store']);
Route::post('/contact', [\App\Http\Controllers\Api\ContactController::class, 'store']);
Route::get('/our-details', [\App\Http\Controllers\Api\OurDetailController::class, 'index']);
Route::get('/vacancies', [\App\Http\Controllers\Api\VacancyController::class, 'index']);
Route::post('/apply-for-vacancy', [\App\Http\Controllers\Api\JobApplicationController::class, 'store']);
Route::post('/event-registration', [\App\Http\Controllers\Api\EventRegistrationController::class, 'store']);

// Protected API routes
Route::middleware('auth:api')->group(function (): void {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Admin-only user management APIs (no dashboard API)
    Route::middleware('role:admin')->group(function (): void {
        Route::get('/users', [UserController::class, 'index']);
        Route::post('/users', [UserController::class, 'store']);
        Route::post('/users/{user}/roles', [UserController::class, 'syncRoles']);
    });
});



