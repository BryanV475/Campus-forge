<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{

    public function createRatingByCourse(Request $request) {

        $blacklist = config('blacklist');

        $comment = $request->comment ?? null;

        foreach ($blacklist as $word) {
            if (stripos($comment, $word) !== false) {
                return response()->json(['error' => 'Tu comentario contiene palabras prohibidas, ten cuidado.'], 400);
            }
        }

        $rating = new Rating();
        $rating->course_id = $request->course_id;
        $rating->user_id = $request->user_id;
        $rating->rating = $request->rating;
        $rating->comment = $comment;
        $rating->save();

        return response()->json($rating, 201);
    }

    public function getRatingsByCourse($courseId)
    {
        $ratings = Rating::where('course_id', $courseId)
                    ->with(['user:id,name', 'course']) // Asegúrate de que el modelo User tenga un campo 'name'
                    ->get(['id', 'user_id', 'course_id', 'rating', 'comment']);

        return response()->json($ratings);
    }

    public function deleteRating($idRating) {
        Rating::destroy($idRating);
        return response()->json(null, 204);
    }

    public function editRating(Request $request, $idRating) {

        $blacklist = config('blacklist');

        $comment = $request->comment ?? null;

        foreach ($blacklist as $word) {
            if (stripos($comment, $word) !== false) {
                return response()->json(['error' => 'Your comment contains blacklisted words.'], 400);
            }
        }

        $rating = Rating::find($idRating);
        $rating->update($request->all());
        return response()->json($rating);
    }

    public function getAverageRateByCourse($courseId) {
        $averageRating = Rating::where('course_id', $courseId)->avg('rating');
        return response()->json(['averageRating' => $averageRating]);
    }
}
