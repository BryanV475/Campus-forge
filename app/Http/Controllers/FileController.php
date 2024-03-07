<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function store(Request $request)
    {
        // validate the file max size 5MB and only pdf file
        $request->validate([
            'file' => 'required|mimes:pdf|max:5120',
        ]);

        $file = new File();
        $file->name = $request->file->getClientOriginalName();
        $file->path = $request->file->store('files');
        $file->approved = false;
        $file->course_id = $request->course_id;
        $file->save();

        return back()
            ->with('success', 'File uploaded successfully');
    }

    // get all files that are unapproved in json format by course id
    public function getUnapprovedFilesByCourseId($id)
    {
        $files = File::where('approved', false)->where('course_id', $id)->get();
        return response()->json($files);
    }


    // get all files that are approved in json format by course id
    public function getApprovedFilesByCourseId($id)
    {
        $files = File::where('approved', true)->where('course_id', $id)->get();
        return response()->json($files);
    }

    // get all files in json format by course id
    public function getAllFilesByCourseId($id)
    {
        $files = File::where('course_id', $id)->get();
        return response()->json($files);
    }

    // approve the file
    public function approveFile($id)
    {
        $file = File::find($id);
        $file->approved = true;
        $file->save();
        return response()->json(['message' => 'File approved successfully']);
    }

    // delete the file
    public function deleteFile($id)
    {
        $file = File::find($id);
        $file->delete();
        return response()->json(['message' => 'File deleted successfully']);
    }

    // serve the file
    public function serveFile($id)
    {
        $file = File::find($id);
        return response()->download(storage_path('app/' . $file->path));
    }

}
