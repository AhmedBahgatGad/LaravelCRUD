<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $courses = Course::all();
        return view('Courses.index')->with('courses', $courses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/courses'), $imageName);
            $imagePath = 'images/courses' . $imageName;
        } else {
            $imagePath = null;
        }
        Course::create([
            'name' => $request->input('name'),
            'totalGrade' => $request->input('totalGrade'),
            'logo' => $imagePath,
            'description' => $request->input('description'),
        ]);
        return redirect('course')->with('flash_message', 'Course Addedd!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::find($id);
        return view('Courses.show')->with('course', $course);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::find($id);
        return view('Courses.edit')->with('course', $course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::findOrFail($id);
    $imagePath = $course->logo;
    if ($request->hasFile('logo')) {
        $image = $request->file('logo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $imagePath = 'images/' . $imageName;
    }
    $course->update([
        'name' => $request->input('name'),
        'totalGrade' => $request->input('totalGrade'),
        'description' => $request->input('description'),
        'logo' => $imagePath,
    ]);
        return redirect('course')->with('flash_message', 'Course Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $logoPath = public_path($course->logo);

        if (file_exists($logoPath)) {
            unlink($logoPath);
        }
        $course->delete();
        return redirect('course')->with('flash_message', 'course deleted!');
    }
}
