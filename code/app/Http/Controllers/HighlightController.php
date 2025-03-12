<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Highlight;
use Illuminate\Support\Facades\Storage;
use App\Models\Tag;


class HighlightController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:highlights-list|highlights-create|highlights-edit|highlights-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:highlights-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:highlights-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:highlights-delete', ['only' => ['destroy']]);
        // ไม่ใส่ middleware สำหรับ show() เพื่อให้ทุกคนเข้าถึงได้
    }
    public function index()
    {
        $highlights = Highlight::orderBy('priority', 'asc')->get();
        $highlights = Highlight::with('tags')->get();
        return view('highlights.index', compact('highlights'));
    }
    public function create()
    {
        $existingTags = Tag::pluck('name')->toArray();
        $existingTags = Tag::all();

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
            'tags' => 'nullable|array',
            'tags.*' => 'string',
            'priority' => 'required|integer',
        ]);

        $imagePathEn = $request->file('image_en')->store('highlights/en', 'public');
        $imagePathTh = $request->file('image_th')->store('highlights/th', 'public');

        $highlight = Highlight::create([
            'title_en' => $request->title_en,
            'title_th' => $request->title_th,
            'description_en' => $request->description_en,
            'description_th' => $request->description_th,
            'image_url_en' => 'storage/' . $imagePathEn,
            'image_url_th' => 'storage/' . $imagePathTh,
            'priority' => $request->priority,
        ]);

        //เชื่อมโยงแท็ก (Tags) กับ Highlight 
        $tags = $request->input('tags', []);
        $tagIds = [];

        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }

        //เชื่อมโยงแท็กกับ Highlight โดยใช้ sync()
        $highlight->tags()->sync($tagIds);

        return redirect()->route('highlights.index')->with('success', 'Highlight created successfully.');
    }

    //แก้ไข Highlight
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

        //เชื่อมโยงแท็ก (Tags) กับ Highlight 
        $tags = $request->input('tags', []);
        $tagIds = [];

        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }
        //เชื่อมโยงแท็กกับ Highlight โดยใช้ sync()
        $highlight->tags()->sync($tagIds);

        return redirect()->route('highlights.index')->with('success', 'Highlight updated successfully.');
    }

    //ลบข้อมูลและรูปภาพ
    public function destroy($id)
    {
        try {
            $highlight = Highlight::findOrFail($id);

            // ลบรูปภาพออกจาก storage
            if ($highlight->image_url_en) {
                Storage::disk('public')->delete(str_replace('storage/', '', $highlight->image_url_en));
            }
            if ($highlight->image_url_th) {
                Storage::disk('public')->delete(str_replace('storage/', '', $highlight->image_url_th));
            }

            // ลบแท็กที่เชื่อมโยงกับ Highlight
            $highlight->tags()->detach();

            // ลบ Highlight ออกจาก Database
            $highlight->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function show($id)
    {
        $highlight = Highlight::with('tags')->findOrFail($id);
        return view('highlights.show', compact('highlight'));
    }
    public function showByTag($tag_id)
    {
        $tag = Tag::findOrFail($tag_id); // เปลี่ยนจาก $tags เป็น $tag
        $highlights = Highlight::whereHas('tags', function ($query) use ($tag_id) {
            $query->where('tags.id', $tag_id);
        })->get();

        return view('highlights.tag', compact('highlights', 'tag')); // แก้ชื่อเป็น highlights, tag
    }
}
