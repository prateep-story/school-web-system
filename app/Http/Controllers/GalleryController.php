<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Gallery;
use App\Picture;
use Carbon\Carbon;

class GalleryController extends Controller
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
        $galleries = Gallery::all();
        return view('galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $gallery = new Gallery;
        $gallery->gallery = $request->gallery;
        $gallery->content = $request->content;
        $gallery->created_at = Carbon::parse($request->event_date);
        $gallery->status = $request->status;
        $gallery->user_id = $request->author;
        $gallery->view = "0";
        if ($request->hasFile('image')) {
            $filename = time().".".$request->file('image')->getClientOriginalExtension();
            Image::make($request->file('image'))->save(public_path('images/galleries/' . $filename));
            Image::make($request->file('image'))->resize(350, null, function ($constraint){
                $constraint->aspectRatio();
            })->fit(350, 183, null, 'top')->save(public_path('images/thumbnails/' . $filename));
            $gallery->image = $filename;
        } else {
            $gallery->image = 'gallery.jpg';
        }
        $gallery->slug =  slug_th($request->gallery);
        $gallery->save();
        return back()->with([
          'alert' => 'alert-success',
          'message' => 'บันทึกข้อมูลเรียบร้อย!',
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
        $pictures = Picture::all()->where('gallery_id', $id);
        return view('galleries.show', compact('pictures'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery = Gallery::find($id);
        return view('galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, $id)
    {
        $gallery = Gallery::find($id);
        $gallery->gallery = $request->gallery;
        $gallery->content = $request->content;
        $gallery->created_at = Carbon::parse($request->event_date);
        $gallery->status = $request->status;
        $gallery->user_id = $request->author;
        if ($request->hasFile('image')) {
            $filename = time().".".$request->file('image')->getClientOriginalExtension();
            if ($gallery->image != 'gallery.jpg') {
                Storage::disk('gallery')->delete($gallery->image);
                Storage::disk('thumbnail')->delete($gallery->image);
            }
            Image::make($request->file('image'))->save(public_path('images/galleries/' . $filename));
            Image::make($request->file('image'))->resize(350, null, function ($constraint){
                $constraint->aspectRatio();
            })->fit(350, 183, null, 'top')->save(public_path('images/thumbnails/' . $filename));
            $gallery->image = $filename;
        } else {
            $gallery->image = $gallery->image;
        }
        $gallery->slug =  slug_th($request->gallery);
        $gallery->save();
        return back()->with([
          'alert' => 'alert-success',
          'message' => 'บันทึกข้อมูลเรียบร้อย!',
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
        $gallery = Gallery::find($id);
        if ($gallery->image != 'gallery.jpg') {
            Storage::disk('gallery')->delete($gallery->image);
            Storage::disk('thumbnail')->delete($gallery->image);
        }
        if ($gallery->pictures->count()) {
            foreach ($gallery->pictures as $picture) {
                if ($picture->picture != 'picture.jpg') {
                    Storage::disk('picture')->delete($picture->picture);
                    $picture->delete();
                }
            }
        }
        $gallery->delete();
        return back()->with([
          'alert' => 'alert-success',
          'message' => 'ลบข้อมูลเรียบร้อย',
        ]);
    }
}
