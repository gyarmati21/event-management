<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('creator')->get();
        return view('event.index', compact('events'));
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
            'is_vip' => 'nullable|boolean',
        ]);

        // Handle file upload for the image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;

            // Store image in the local 'uploads/events/' directory
            $path = 'uploads/events/';
            $file->move($path, $filename);

            // Set the correct image path for storage and display
            $imagePath = $path . $filename;
        }

        // Get the logged-in user's ID
        $createdBy = auth()->user()->id;

        // Create a new event in the database
        Event::create([
            'name' => $request->name,
            'date' => $request->date,
            'location' => $request->location,
            'image' => $imagePath,
            'type' => $request->type,
            'description' => $request->description,
            'is_vip' => $request->has('is_vip') ? true : false,
            'created_by' => $createdBy,
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        if (auth()->user()->id !== $event->created_by) {
            abort(403, 'Unauthorized action.');
        }

        return view('event.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        // Ensure the user is authorized to update the event
        if (auth()->user()->id !== $event->created_by) {
            abort(403, 'Unauthorized action.');
        }

        // Validate inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'is_vip' => 'nullable|boolean',
        ]);

        $imagePath = $event->image;  // Keep the existing image path

        // If a new image is uploaded, handle the image upload and delete the old one
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;

            // Store the new image
            $path = 'uploads/events/';
            $file->move($path, $filename);
            $imagePath = $path . $filename;

            // Delete the old image if it exists
            if (File::exists($event->image)) {
                File::delete($event->image);
            }
        }

        // Update the event details
        $event->update([
            'name' => $request->name,
            'date' => $request->date,
            'location' => $request->location,
            'image' => $imagePath,
            'type' => $request->type,
            'description' => $request->description,
            'is_vip' => $request->has('is_vip'),
        ]);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        if (auth()->user()->id !== $event->created_by) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the image if it exists
        if (File::exists($event->image)) {
            File::delete($event->image);
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

    public function myEvents()
    {
        $user = auth()->user();
        $createdEvents = $user->createdEvents()->with('users')->get();
        $joinedEvents = $user->joinedEvents()->with('creator')->get();

        return view('event.myevents', compact('createdEvents', 'joinedEvents'));
    }

    public function joinEvent(Event $event)
    {
        $user = auth()->user();

        if (!$event->users->contains($user)) {
            $event->users()->attach($user->id);
        }

        return redirect()->route('events.index')->with('success', 'You have successfully joined the event!');
    }
}
