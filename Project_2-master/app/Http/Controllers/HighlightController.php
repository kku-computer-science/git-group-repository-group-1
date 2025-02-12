<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Highlight;
use Illuminate\Support\Facades\Storage;

class HighlightController extends Controller
{
    public function index()
    {
        $highlights = Highlight::orderBy('priority', 'asc')->get();
        return view('highlights.index', compact('highlights'));
    }
    

    public function create()
    {
        return view('highlights.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'priority' => 'required|integer',
            'status' => 'required|in:active,inactive',
        ]);

        // Upload image
        $imagePath = $request->file('image')->store('uploads/highlights', 'public');

        Highlight::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => 'storage/' . $imagePath,
            'priority' => $request->priority,
            'status' => $request->status,
        ]);

        return redirect()->route('highlights.index')->with('success', 'Highlight created successfully.');
    }

    public function edit(Highlight $highlight)
    {
        return view('highlights.edit', compact('highlight'));
    }

    public function update(Request $request, Highlight $highlight)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'priority' => 'required|integer',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($highlight->image_url) {
                Storage::disk('public')->delete(str_replace('storage/', '', $highlight->image_url));
            }
            // Upload new image
            $imagePath = $request->file('image')->store('uploads/highlights', 'public');
            $highlight->image_url = 'storage/' . $imagePath;
        }

        $highlight->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => $request->status,
            'image_url' => $highlight->image_url,
        ]);

        return redirect()->route('highlights.index')->with('success', 'Highlight updated successfully.');
    }

    public function destroy(Highlight $highlight)
    {
        // Delete image
        if ($highlight->image_url) {
            Storage::disk('public')->delete(str_replace('storage/', '', $highlight->image_url));
        }

        $highlight->delete();
        return redirect()->route('highlights.index')->with('success', 'Highlight deleted successfully.');
    }
}
