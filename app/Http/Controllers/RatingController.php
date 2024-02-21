<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function createRatingByCourse(Request $request, $courseId) {
        $rating = new Rating();
        $rating->course_id = $courseId;
        $rating->user_id = $request->user_id;
        $rating->rating = $request->rating;
        $rating->comment = $request->comment ?? null; // El comentario es opcional
        $rating->save();

        return response()->json($rating, 201);
    }

    public function deleteRating($idRating) {
        Rating::destroy($idRating);
        return response()->json(null, 204);
    }

    public function editRating(Request $request, $idRating) {
        $rating = Rating::find($idRating);
        $rating->update($request->all());
        return response()->json($rating);
    }

    public function getAverageRateByCourse($courseId) {
        $averageRating = Rating::where('course_id', $courseId)->avg('rating');
        return response()->json(['averageRating' => $averageRating]);
    }
}
