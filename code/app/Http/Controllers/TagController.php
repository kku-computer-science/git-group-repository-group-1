<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
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
        
}

