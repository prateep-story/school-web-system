<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GuidanceRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Guidance;

class GuidanceController extends Controller
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
        $guidances= Guidance::all();
        return view('guidances.index', compact('guidances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('guidances.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuidanceRequest $request)
    {
        $guidance = new Guidance;
        $guidance->guidance = $request->guidance;
        $guidance->status = $request->status;
        $guidance->user_id = $request->author;
        if ($request->hasFile('image')) {
            $filename = time().".".$request->file('image')->getClientOriginalExtension();
            Image::make($request->file('image'))->resize(800, null, function ($constraint){
                $constraint->aspectRatio();
            })->fit(800, 600, null, 'top')->save(public_path('images/guidances/' . $filename));
            $guidance->image = $filename;
        } else {
            $guidance->image = 'guidance.jpg';
        }
        $guidance->url = $request->url;
        $guidance->slug =  slug_th($request->guidance);
        $guidance->save();
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
        $guidance = Guidance::find($id);
        $size = filesize('images/guidances/'.$guidance->image);
        return view('guidances.edit', compact('guidance', 'size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GuidanceRequest $request, $id)
    {
        $guidance = Guidance::find($id);
        $guidance->guidance = $request->guidance;
        $guidance->status = $request->status;
        $guidance->user_id = $request->author;
        if ($request->hasFile('image')) {
            $filename = time().".".$request->file('image')->getClientOriginalExtension();
            if ($guidance->image != 'guidance.jpg') {
                Storage::disk('guidance')->delete($guidance->image);
            }
            Image::make($request->file('image'))->resize(800, null, function ($constraint){
                $constraint->aspectRatio();
            })->fit(800, 600, null, 'top')->save(public_path('images/guidances/' . $filename));
            $guidance->image = $filename;
        } else {
            $guidance->image = $guidance->image;
        }
        $guidance->url = $request->url;
        $guidance->slug =  slug_th($request->guidance);
        $guidance->save();
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
        $guidance = Guidance::find($id);
        if ($guidance->image != 'guidance.jpg') {
            Storage::disk('guidance')->delete($guidance->image);
        } else {
            $guidance->image = $guidance->image;
        }
        $guidance->delete();
        return back()->with([
           'alert' => 'alert-success',
           'message' => 'ลบข้อมูลเรียบร้อย!',
        ]);
    }
}
