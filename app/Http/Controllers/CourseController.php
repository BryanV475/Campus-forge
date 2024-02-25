<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Rating;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{

    public function show($id)
    {
        // Recupera el curso y calcula el promedio de las calificaciones ('ratings') al vuelo
        $course = Course::withAvg('ratings', 'rating')
                        ->findOrFail($id);

        // Incluye el promedio de las calificaciones como un atributo adicional en el modelo
        $course->avg_rating = $course->ratings_avg_rating;

        $user = auth()->user();

        return Inertia::render('CourseOverview', [
            'course' => $course,
            'user' => $user ? $user->only('id', 'name', 'email') : null,
        ]);
    }


    public function fetchAllCourses() {
        $courses = Course::withCount(['ratings as average_rating' => function($query) {
            $query->select(DB::raw('coalesce(ROUND(avg(rating), 2), 0)'));

        }])->get();
    
        return response()->json($courses);
    }

    public function getCourseById($idCourse) {
        $course = Course::find($idCourse);
        $course->ratings = Rating::where('course_id', $idCourse)->get();
        $course->average_rating = Rating::where('course_id', $idCourse)->avg('rating');
        return response()->json($course);
    }

    public function createCourse(Request $request) {
        $course = Course::create($request->all());
        return response()->json($course, 201);
    }

    public function editCourse(Request $request, $idCourse) {
        $course = Course::find($idCourse);
        $course->update($request->all());
        return response()->json($course);
    }

    public function deleteCourse($idCourse) {
        Course::destroy($idCourse);
        return response()->json(null, 204);
    }

    public function fileUpload(Request $request, $idCourse) {
        $request->validate([
            'syllabus' => 'required|file',
        ]);
        $path = $request->file('syllabus')->store('syllabus_files');
        $course = Course::find($idCourse);
        $course->syllabus_url = $path;
        $course->save();
        return response()->json(['path' => $path], 200);
    }
}
