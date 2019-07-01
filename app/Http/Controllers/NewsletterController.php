<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewsletterRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Newsletter;

class NewsletterController extends Controller
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
        $newsletters= Newsletter::all();
        return view('newsletters.index', compact('newsletters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('newsletters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsletterRequest $request)
    {
        $newsletter = new Newsletter;
        $newsletter->newsletter = $request->newsletter;
        $newsletter->status = $request->status;
        $newsletter->user_id = $request->author;
        if ($request->hasFile('image')) {
            $filename = time().".".$request->file('image')->getClientOriginalExtension();
            Image::make($request->file('image'))->save(public_path('images/newsletters/' . $filename));
            Image::make($request->file('image'))->resize(350, 495.8)->save(public_path('images/thumbnails/' . $filename));
            $newsletter->image = $filename;
        } else {
            $newsletter->image = 'newsletter.jpg';
        }
        $newsletter->slug =  slug_th($request->newsletter);
        $newsletter->save();
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
        $newsletter = Newsletter::find($id);
        $size = filesize('images/newsletters/'.$newsletter->image);
        return view('newsletters.edit', compact('newsletter', 'size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsletterRequest $request, $id)
    {
        $newsletter = Newsletter::find($id);
        $newsletter->newsletter = $request->newsletter;
        $newsletter->status = $request->status;
        $newsletter->user_id = $request->author;
        if ($request->hasFile('image')) {
            $filename = time().".".$request->file('image')->getClientOriginalExtension();
            if ($newsletter->image != 'newsletter.jpg') {
                Storage::disk('newsletter')->delete($newsletter->image);
                Storage::disk('thumbnail')->delete($newsletter->image);
            }
            Image::make($request->file('image'))->save(public_path('images/newsletters/' . $filename));
            Image::make($request->file('image'))->resize(350, 495.8)->save(public_path('images/thumbnails/' . $filename));
            $newsletter->image = $filename;
        } else {
            $newsletter->image = $newsletter->image;
        }
        $newsletter->slug =  slug_th($request->newsletter);
        $newsletter->save();
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
        $newsletter = Newsletter::find($id);
        if ($newsletter->image != 'newsletter.jpg') {
            Storage::disk('newsletter')->delete($newsletter->image);
            Storage::disk('thumbnail')->delete($newsletter->image);
        }
        $newsletter->delete();
        return back()->with([
           'alert' => 'alert-success',
           'message' => 'ลบข้อมูลเรียบร้อย!',
        ]);
    }
}
