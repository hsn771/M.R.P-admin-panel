<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\PermissionController as AdminPermissionController;
use App\Http\Controllers\Admin\SliderController as AdminSliderController;
use App\Http\Controllers\Admin\RequestSubmissionController as AdminRequestSubmissionController;
use App\Http\Controllers\Admin\PhotoGalleryController as AdminPhotoGalleryController;
use App\Http\Controllers\Admin\VideoGalleryController as AdminVideoGalleryController;
use App\Http\Controllers\Admin\HeaderLogoController as AdminHeaderLogoController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\WomanNoticeController as AdminWomanNoticeController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\HeroSectionController as AdminHeroSectionController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\IntroductionController as AdminIntroductionController;
use App\Http\Controllers\Admin\WomanEmpowerCardController as AdminWomanEmpowerCardController;
use App\Http\Controllers\Admin\MissionController as AdminMissionController;
use App\Http\Controllers\Admin\MemberRegistrationController as AdminMemberRegistrationController;
use App\Http\Controllers\Admin\AgentRegistrationController as AdminAgentRegistrationController;
use App\Http\Controllers\Admin\SubAgentRegistrationController as AdminSubAgentRegistrationController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\EventRegistrationController as AdminEventRegistrationController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\OurInitialController as AdminOurInitialController;
use App\Http\Controllers\Admin\OurMilestoneController as AdminOurMilestoneController;
use App\Http\Controllers\Admin\OurLeadershipController as AdminOurLeadershipController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestSubmissionController;
use Illuminate\Support\Facades\Route;

// Redirect root to admin dashboard (or login if not authenticated)
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

// Guest-only routes
Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

// Authenticated admin panel routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User management
    Route::resource('users', AdminUserController::class)->except(['show']);

    // Role management
    Route::resource('roles', AdminRoleController::class)->except(['show']);

    // Permission management (simple: create & list)
    Route::resource('permissions', AdminPermissionController::class)->only(['index', 'create', 'store']);

    // Slider management
    Route::resource('sliders', AdminSliderController::class)->except(['show']);

    // Request submissions management
    Route::resource('request-submissions', AdminRequestSubmissionController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::post('/request-submissions/form-image/update', [AdminRequestSubmissionController::class, 'updateFormImage'])->name('request-submissions.update-form-image');

    // Photo gallery management
    Route::resource('photo-galleries', AdminPhotoGalleryController::class)->except(['show']);

    // Video gallery management
    Route::resource('video-galleries', AdminVideoGalleryController::class)->except(['show']);

    // Settings management (header-logos route for backward compatibility)
    Route::get('/header-logos', [AdminHeaderLogoController::class, 'index'])->name('header-logos.index');
    Route::get('/header-logos/edit', [AdminHeaderLogoController::class, 'edit'])->name('header-logos.edit');
    Route::put('/header-logos', [AdminHeaderLogoController::class, 'update'])->name('header-logos.update');

    // Event management
    Route::resource('events', AdminEventController::class);

    // Woman notice management
    Route::resource('woman-notices', AdminWomanNoticeController::class)->except(['show']);

    // Blog management
    Route::resource('blogs', AdminBlogController::class)->except(['show']);

    // Hero section management
    Route::resource('hero-sections', AdminHeroSectionController::class)->except(['show']);

    // About management
    Route::resource('abouts', AdminAboutController::class)->except(['show']);

    // Introduction management
    Route::resource('introductions', AdminIntroductionController::class)->except(['show']);

    // Woman empower card management
    Route::resource('woman-empower-cards', AdminWomanEmpowerCardController::class)->only(['index', 'show', 'destroy']);
    Route::post('/woman-empower-cards/form-image/update', [AdminWomanEmpowerCardController::class, 'updateFormImage'])->name('woman-empower-cards.update-form-image');

    // Mission management
    Route::resource('missions', AdminMissionController::class)->except(['show']);

    // Member Registration management
    Route::resource('member-registrations', AdminMemberRegistrationController::class);
    Route::get('member-registrations/file/{filename}', [AdminMemberRegistrationController::class, 'viewFile'])->name('member-registrations.view-file');

    // Agent Registration management
    Route::resource('agent-registrations', AdminAgentRegistrationController::class);
    Route::get('agent-registrations/file/{filename}', [AdminAgentRegistrationController::class, 'viewFile'])->name('agent-registrations.view-file');

    // Sub Agent Registration management
    Route::resource('sub-agent-registrations', AdminSubAgentRegistrationController::class);
    Route::get('sub-agent-registrations/file/{filename}', [AdminSubAgentRegistrationController::class, 'viewFile'])->name('sub-agent-registrations.view-file');

    // Contact management
    Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);

    // Our Details management
    Route::resource('our-details', \App\Http\Controllers\Admin\OurDetailController::class);

    // Vacancy management
    Route::resource('vacancies', \App\Http\Controllers\Admin\VacancyController::class);

    // Job Applications management
    Route::resource('job-applications', \App\Http\Controllers\Admin\JobApplicationController::class)->only(['index', 'show', 'destroy']);

    // Event Registration management
    Route::resource('event-registrations', AdminEventRegistrationController::class)->only(['index', 'show', 'destroy']);

    // News management
    Route::resource('news', AdminNewsController::class);

    // Our Initials management
    Route::resource('our-initials', AdminOurInitialController::class);

    // Our Milestones management
    Route::resource('our-milestones', AdminOurMilestoneController::class);

    // Our Leaderships management
    Route::resource('our-leaderships', AdminOurLeadershipController::class);
});

// Authenticated user profile
Route::middleware('auth')->group(function (): void {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

