<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FileRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Document;
use App\File;

class FileController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'verified', 'backend']);
        $this->middleware('permission:list', ['only' => ['index']]);
        $this->middleware('permission:create', ['only' => ['create','store']]);
        $this->middleware('permission:edit', ['only' => ['edit','update']]);
        $this->middleware('permission:show', ['only' => ['show']]);
        $this->middleware('permission:delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::all();
        return view('files.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $documents = Document::all();
        return view('files.create', compact('documents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FileRequest $request)
    {
        $file = new File;
        $file->document_id = $request->document;
        $file->title =  $request->title;
        $file->status =  $request->status;
        $file->user_id =  $request->author;
        $file->view =  "0";
        if ($request->hasFile('file')) {
            $filename = time().".".$request->file('file')->getClientOriginalExtension();
            $request->file('file')->move(public_path('documents/files/'), $filename);
            $file->file = $filename;
        } else {
            $file->file = 'null';
        }
        $file->slug = slug_th($request->title);
        $file->save();
        return back()->with([
          'alert' => 'alert-success',
          'message' => 'บันทึกข้อมูลเรียบร้อย',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $documents = Document::all();
        $file = file::find($id);
        return view('files.edit', compact('file', 'documents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FileRequest $request, $id)
    {
        $file = File::find($id);
        $file->document_id = $request->document;
        $file->title =  $request->title;
        $file->status =  $request->status;
        $file->user_id =  $request->author;
        if ($request->hasFile('file')) {
            $filename = time().".".$request->file('file')->getClientOriginalExtension();
            $request->file('file')->move(public_path('documents/files/'), $filename);
            Storage::disk('file')->delete($file->file);
            $file->file = $filename;
        } else {
            $file->file = $file->file;
        }
        $file->slug = slug_th($request->title);
        $file->save();
        return back()->with([
          'alert' => 'alert-success',
          'message' => 'บันทึกข้อมูลเรียบร้อย',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = file::find($id);
        Storage::disk('file')->delete($file->file);
        $file->delete();
        return back()->with([
          'alert' => 'alert-success',
          'message' => 'ลบข้อมูลเรียบร้อย!',
        ]);
    }
}
