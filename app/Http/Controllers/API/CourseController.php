<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $courses = Course::all();
        return $courses;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,jfif,gif|max:2048',
                'totalGrade' => 'required|integer',
                'description' => 'required|string|max:500',
                'track_id' => 'required'
            ]);
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/courses'), $imageName);
                $imagePath = 'images/courses/' . $imageName;
            } else {
                $imagePath = null;
            }
            Course::create([
                'name' => $validatedData['name'],
                'totalGrade' => $validatedData['totalGrade'],
                'description' => $validatedData['description'],
                'track_id' => $validatedData['track_id'],
                'logo' => $imagePath,
            ]);
    
            return response()->json(['message' => 'Student Added Successfully'], 201);
    
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return $course;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $imagePath = $course->logo;
    if ($request->hasFile('logo')) {
        $image = $request->file('logo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/courses'), $imageName);
        $imagePath = 'images/courses/' . $imageName;
    }
    $course->update([
        'name' => $request->input('name'),
        'logo' => $request->input('logo'),
        'totalGrade' => $request->input('totalGrade'),
        'description' => $request->input('description'),
        'img' => $imagePath,
        'track_id' => $request->input('track_id'),
    ]);
        return 'Course Updated Succesfully';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $logoPath = public_path($course->logo);

        if (file_exists($logoPath)) {
            unlink($logoPath);
        }
        $course->delete();
        return "student deleted successfully";
    }
}
