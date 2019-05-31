<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AwardRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Portfolio;
use App\Award;

class AwardController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'verified', 'backend']);
        $this->middleware('permission:list-data', ['only' => ['index']]);
        $this->middleware('permission:create-data', ['only' => ['create','store']]);
        $this->middleware('permission:edit-data', ['only' => ['edit','update']]);
        $this->middleware('permission:show-data', ['only' => ['show']]);
        $this->middleware('permission:delete-data', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $awards = Award::all();
        return view('awards.index', compact('awards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $portfolios = Portfolio::all();
        return view('awards.create', compact('portfolios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AwardRequest $request)
    {
        $award = new Award;
        $award->title = $request->title;
        $award->subtitle = $request->subtitle;
        $award->portfolio_id = $request->portfolio;
        $award->award = $request->award;
        $award->competition = $request->competition;
        $award->institution = $request->institution;
        $award->year = $request->year;
        $award->content = $request->content;
        $award->user_id = $request->author;
        if ($request->hasFile('image')) {
            $filename = time().".".$request->file('image')->getClientOriginalExtension();
            Image::make($request->file('image'))->save(public_path('images/awards/' . $filename));
            Image::make($request->file('image'))->resize(540, null, function ($constraint){
                $constraint->aspectRatio();
            })->fit(540, 283, null, 'top')->save(public_path('images/thumbnails/' . $filename));
            $award->image = $filename;
        } else {
            $award->image = 'award.jpg';
        }
        $award->slug =  slug_th($request->title);
        $award->save();
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
        $award = Award::find($id);
        $size = filesize('images/awards/'.$award->image);
        $portfolios = Portfolio::all();
        return view('awards.edit', compact('award', 'portfolios', 'size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AwardRequest $request, $id)
    {
        $award = Award::find($id);
        $award->title = $request->title;
        $award->subtitle = $request->subtitle;
        $award->portfolio_id = $request->portfolio;
        $award->award = $request->award;
        $award->competition = $request->competition;
        $award->institution = $request->institution;
        $award->year = $request->year;
        $award->content = $request->content;
        $award->user_id = $request->author;
        if ($request->hasFile('image')) {
            $filename = time().".".$request->file('image')->getClientOriginalExtension();
            if ($award->image != 'award.jpg') {
                Storage::disk('award')->delete($award->image);
                Storage::disk('thumbnail')->delete($award->image);
            }
            Image::make($request->file('image'))->save(public_path('images/awards/' . $filename));
            Image::make($request->file('image'))->resize(540, null, function ($constraint){
                $constraint->aspectRatio();
            })->fit(540, 283, null, 'top')->save(public_path('images/thumbnails/' . $filename));
            $award->image = $filename;
        } else {
            $award->image = $award->image;
        }
        $award->slug = slug_th($request->award);
        $award->save();
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
        $award = Award::find($id);
        if ($award->image != 'award.jpg') {
            Storage::disk('award')->delete($award->image);
            Storage::disk('thumbnail')->delete($award->image);
        }
        $award->delete();
        return back()->with([
           'alert' => 'alert-success',
           'message' => 'ลบข้อมูลเรียบร้อย',
        ]);
    }
}
