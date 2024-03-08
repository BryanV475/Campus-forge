<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RatingController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        // Asegúrate de que el usuario esté autenticado
        $user = Auth::user();

        // Comprueba si el usuario tiene el rol de 'student'
        if ($user->hasRole('student')) {
            return Inertia::render('UserDashboard');
        }

        // Si el usuario es 'admin' o cualquier otro rol, muestra el AdminDashboard
        return Inertia::render('AdminDashboard');
    })->name('dashboard');

    Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
});

