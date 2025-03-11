<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
class FileUpload extends Controller
{
  public function createForm(){
    return view('file-upload');
  }

  public function fileUpload(Request $req){
        $req->validate([
        'file' => 'required|mimes:pdf|max:10240'
        ]);

        $fileModel = new File;

        if($req->file()) {
            $fileName = time().'_'.$req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');

            $fileModel->name = time().'_'.$req->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();

            return back()
            ->with('success','File has been uploaded.')
            ->with('file', $fileName);
        }
   }
   public function show()
    {
        //$researchGroups = ResearchGroup::latest()->paginate(5);
        $files = File::all();
        //return $files;
        return view('show',compact('files'));
    }
    public function download($file){
        //return Storage::download($file);
        return response()->download(storage_path('/'. $file));
        //return response()->download(storage_path('/storage/app/files/'.$file));
     }
public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $post = Post::find($id);
    
        $post->update($request->all());
    
        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully.');
    }
}