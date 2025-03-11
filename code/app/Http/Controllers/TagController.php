<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:tags,name'
        ]);

        $tag = Tag::create([
            'name' => $request->name,
            'created_at' => now(),
            'updated_at' => now()   
        ]);

        return response()->json(['success' => true, 'tag' => $tag]);
    }
    public function destroy($id)
    {
        $tag = Tag::find($id);
        if ($tag) {
            $tag->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

}

