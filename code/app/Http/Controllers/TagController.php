<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
<<<<<<< HEAD
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

=======
        public function store(Request $request)
        {
            $request->validate(['name' => 'required|unique:tags']);
            $tag = Tag::create(['name' => $request->name]);
            return response()->json(['success' => true, 'tag' => $tag]);
        }
        
        public function update(Request $request, $id)
        {
            $tag = Tag::findOrFail($id);
            $request->validate(['name' => 'required|unique:tags,name,'.$id]);
            $tag->update(['name' => $request->name]);
            return response()->json(['success' => true]);
        }
        
        public function destroy($id)
        {
            Tag::destroy($id);
            return response()->json(['success' => true]);
        }
        
        public function manage()
        {
            $tags = Tag::all();
            return view('tags.manage', compact('tags'));
        }
        
>>>>>>> b8167b3f9ca2b0a9faa1101a509d95b48b616bbd
}

