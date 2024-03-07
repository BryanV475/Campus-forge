<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\FileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/courses', [CourseController::class, 'fetchAllCourses']);
Route::get('/courses/{id}', [CourseController::class, 'getCourseById']);
Route::post('/courses', [CourseController::class, 'createCourse']);
Route::put('/courses/{id}', [CourseController::class, 'editCourse']);
Route::delete('/courses/{id}', [CourseController::class, 'deleteCourse']);
Route::post('/courses/{id}/upload', [CourseController::class, 'fileUpload']);


Route::post('/ratings', [RatingController::class, 'createRatingByCourse']);
Route::get('/ratings/{courseId}', [RatingController::class, 'getRatingsByCourse']);
Route::delete('/ratings/{id}', [RatingController::class, 'deleteRating']);
Route::put('/ratings/{id}', [RatingController::class, 'editRating']);
Route::get('/courses/{courseId}/average-rating', [RatingController::class, 'getAverageRateByCourse']);

Route::post('/files', [FileController::class, 'store']);
Route::get('/files/unapproved/{id}', [FileController::class, 'getUnapprovedFilesByCourseId']);
Route::get('/files/approved/{id}', [FileController::class, 'getApprovedFilesByCourseId']);
Route::get('/files/all/{id}', [FileController::class, 'getAllFilesByCourseId']);
Route::put('/files/approve/{id}', [FileController::class, 'approveFile']);
Route::delete('/files/{id}', [FileController::class, 'deleteFile']);
