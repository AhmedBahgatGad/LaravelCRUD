<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tracks = Track::all();
        return view('tracks.tracksData', compact("tracks"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tracks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/tracks'), $imageName);
            $imagePath = 'images/tracks/' . $imageName;
        } else {
            $imagePath = null;
        }
        Track::create([
            'about' => $request->input('about'),
            'name' => $request->input('name'),
            'logo' => $imagePath,
        ]);
        return redirect('tracks')->with('flash_message', 'Student Addedd!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $track = Track::find($id);

        if (!$track) {
            abort(404, 'Track not found');
        }
        return view('tracks.show')->with('track', $track);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $track = Track::findOrFail($id);
        return view('tracks.update', compact('track'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $track = Track::findOrFail($id);
        $imagePath = $track->logo;
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/tracks'), $imageName);
            $imagePath = 'images/tracks' . $imageName;
        }
        $track->update([
            'name' => $request->input('name'),
            'about' => $request->input('about'),
            'logo' => $imagePath
        ]);
        return redirect('tracks')->with('flash_message', 'student Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $track = Track::findOrFail($id);
        $logoPath = public_path($track->logo);

        if (file_exists($logoPath)) {
            unlink($logoPath);
        }
        $track->delete();
        return to_route('tracks.index');
    }
}
