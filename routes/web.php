<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\HeroSlideController as AdminHeroSlideController;
use App\Http\Controllers\Admin\JobPostingController as AdminJobPostingController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\PartnerController as AdminPartnerController;
use App\Http\Controllers\Admin\TeamMemberController as AdminTeamMemberController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Site public
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/a-propos', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServiceController::class, 'index'])->name('services');

Route::get('/realisations', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/realisations/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/galerie', [GalleryController::class, 'index'])->name('gallery.index');

Route::get('/actualites', [NewsController::class, 'index'])->name('news.index');
Route::get('/actualites/{news:slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/offres-emploi', [JobPostingController::class, 'index'])->name('jobs.index');
Route::get('/offres-emploi/{job:slug}', [JobPostingController::class, 'show'])->name('jobs.show');
Route::get('/offres-emploi/{job:slug}/postuler', [JobApplicationController::class, 'create'])->name('jobs.apply');
Route::post('/offres-emploi/{job:slug}/postuler', [JobApplicationController::class, 'store'])->name('jobs.apply.store');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Espace d'administration
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // Connexion (accessible sans être authentifié)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.attempt');
    });

    // Zone protégée : tout utilisateur connecté (admin ou éditeur)
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('hero', AdminHeroSlideController::class)->except(['show']);

        Route::resource('projects', AdminProjectController::class)->except(['show']);
        Route::resource('partners', AdminPartnerController::class)->except(['show']);
        Route::delete('project-images/{image}', [AdminProjectController::class, 'destroyImage'])->name('projects.images.destroy');

        Route::get('gallery', [AdminGalleryController::class, 'index'])->name('gallery.index');
        Route::get('gallery/create', [AdminGalleryController::class, 'create'])->name('gallery.create');
        Route::post('gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
        Route::put('gallery/{image}', [AdminGalleryController::class, 'update'])->name('gallery.update');
        Route::delete('gallery/{image}', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');

        Route::resource('news', AdminNewsController::class)->except(['show']);
        Route::delete('news-images/{image}', [AdminNewsController::class, 'destroyImage'])->name('news.images.destroy');
        Route::resource('jobs', AdminJobPostingController::class)->except(['show']);
        Route::resource('team', AdminTeamMemberController::class)->except(['show']);
        Route::resource('testimonials', AdminTestimonialController::class)->except(['show']);

        // Réservé aux administrateurs
        Route::middleware('admin')->group(function () {
            Route::resource('users', AdminUserController::class)->except(['show']);
        });
    });
});
