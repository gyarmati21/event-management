<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        return view('event.events');
    }

    public function create()
    {
        return view('event.create');
    }

    public function store(Request $request)
    {
        // Validate form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'is_vip' => 'nullable|boolean', // Make is_vip nullable to avoid issues with unchecked checkbox
        ]);
    
        // Handle file upload for the image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('uploads/events', 'public');
        }
    
        // Get logged-in user's ID (breeze)
        $createdBy = auth()->user()->id;
    
        // Create the new event in the database
        Event::create([
            'name' => $request->name,
            'date' => $request->date,
            'location' => $request->location,
            'image' => $imagePath,
            'type' => $request->type,
            'description' => $request->description,
            'is_vip' => $request->has('is_vip') ? true : false, // Handling checkbox
            'created_by' => $createdBy,
        ]);
    
        // Redirect to the dashboard with a success message
        return redirect('/dashboard')->with('success', 'Event created successfully.');

    }
    

}
