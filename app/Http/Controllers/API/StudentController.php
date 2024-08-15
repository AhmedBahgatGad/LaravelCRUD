<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return $students;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email',
                'age' => 'required|integer|min:1|max:120',
                'gender' => 'required|in:male,female',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,jfif,gif|max:2048',
                'track' => 'required|string|max:255',
                'address' => 'required|string|max:500',
                'mobile' => 'required|string|max:15',
            ]);
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $imagePath = 'images/' . $imageName;
            } else {
                $imagePath = null;
            }
            Student::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'age' => $validatedData['age'],
                'gender' => $validatedData['gender'],
                'img' => $imagePath,
                'track' => $validatedData['track'],
                'address' => $validatedData['address'],
                'mobile' => $validatedData['mobile'],
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
    public function show(Student $student)
    {
        return $student;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $imagePath = $student->img;
    if ($request->hasFile('img')) {
        $image = $request->file('img');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $imagePath = 'images/' . $imageName;
    }
    $student->update([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'age' => $request->input('age'),
        'gender' => $request->input('gender'),
        'img' => $imagePath,
        'track' => $request->input('track'),
        'address' => $request->input('address'),
        'mobile' => $request->input('mobile'),
    ]);
        return 'Student Updated Succesfully';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $logoPath = public_path($student->img);

        if (file_exists($logoPath)) {
            unlink($logoPath);
        }
        $student->delete();
        return "student deleted successfully";
    }
}
