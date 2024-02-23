<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Rating;

class CourseController extends Controller
{
    public function fetchAllCourses() {
        $courses = Course::all();
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
