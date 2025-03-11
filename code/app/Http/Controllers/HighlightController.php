<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Highlight;
use Illuminate\Support\Facades\Storage;
use App\Models\Tag;


class HighlightController extends Controller
{
    public function index()
    {
        $highlights = Highlight::orderBy('priority', 'asc')->get();
        $highlights = Highlight::with('tags')->get();
        return view('highlights.index', compact('highlights'));
    }



    public function create()
    {
        $existingTags = Tag::pluck('name')->toArray();

        return view('highlights.create', compact('existingTags'));
    }

    
    //add Highlight
    //upload image
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_th' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_th' => 'nullable|string',
            'image_en' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'image_th' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'priority' => 'required|integer',
        ]);

        $imagePathEn = $request->file('image_en')->store('highlights/en', 'public');
        $imagePathTh = $request->file('image_th')->store('highlights/th', 'public');

        Highlight::create([
            'title_en' => $request->title_en,
            'title_th' => $request->title_th,
            'description_en' => $request->description_en,
            'description_th' => $request->description_th,
            'image_url_en' => 'storage/' . $imagePathEn,
            'image_url_th' => 'storage/' . $imagePathTh,
            'priority' => $request->priority,
        ]);

        return redirect()->route('highlights.index')->with('success', 'Highlight created successfully.');
    }

    public function edit(Highlight $highlight)
    {
        $existingTags = Tag::pluck('name')->toArray();
        $highlightTags = $highlight->tags()->pluck('name')->toArray();
    
        return view('highlights.edit', compact('highlight', 'existingTags', 'highlightTags'));
    }
    

    //อัปเดต Highlight
    public function update(Request $request, Highlight $highlight)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_th' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_th' => 'nullable|string',
            'image_en' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image_th' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
            'priority' => 'required|integer',
        ]);

        //ตรวจสอบและอัปเดตไฟล์ภาพใหม่(en, th)
        if ($request->hasFile('image_en')) {
            // ลบรูปเดิม
            if ($highlight->image_url_en) {
                Storage::disk('public')->delete(str_replace('storage/', '', $highlight->image_url_en));
            }
            // อัปโหลดรูปใหม่
            $imagePathEn = $request->file('image_en')->store('highlights/en', 'public');
            $highlight->image_url_en = 'storage/' . $imagePathEn;
        }

        if ($request->hasFile('image_th')) {
            // ลบรูปเดิม
            if ($highlight->image_url_th) {
                Storage::disk('public')->delete(str_replace('storage/', '', $highlight->image_url_th));
            }
            // อัปโหลดรูปใหม่
            $imagePathTh = $request->file('image_th')->store('highlights/th', 'public');
            $highlight->image_url_th = 'storage/' . $imagePathTh;
        }

        //อัปเดต Highlight ใน database
        $highlight->update([
            'title_en' => $request->title_en,
            'title_th' => $request->title_th,
            'description_en' => $request->description_en,
            'description_th' => $request->description_th,
            'priority' => $request->priority,
        ]);

        //จัดการ Tags    
        $tags = $request->input('tags', []);
        $tagIds = [];

        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }

        $highlight->tags()->sync($tagIds);

        return redirect()->route('highlights.index')->with('success', 'Highlight updated successfully.');
    }

    //ลบข้อมูลและรูปภาพ
    public function destroy(Highlight $highlight)
    {
        // ลบรูปภาพจาก storage
        if ($highlight->image_url_en) {
            Storage::disk('public')->delete(str_replace('storage/', '', $highlight->image_url_en));
        }
        if ($highlight->image_url_th) {
            Storage::disk('public')->delete(str_replace('storage/', '', $highlight->image_url_th));
        }
        //ลบข้อมูลจาก database
        $highlight->delete();

        return redirect()->route('highlights.index')->with('success', 'Highlight deleted successfully.');
    }
}
