<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LinkRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Link;
use Carbon\Carbon;


class LinkController extends Controller
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
        $links = Link::all();
        return view('links.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinkRequest $request)
    {
        $link = new link;
        $link->link = $request->link;
        $link->url = $request->url;
        $link->user_id = $request->author;
        if ($request->hasFile('image')) {
            $filename = time().".".$request->file('image')->getClientOriginalExtension();
            Image::make($request->file('image'))->save(public_path('images/links/' . $filename));
            $link->image = $filename;
        } else {
            $link->image = 'link.jpg';
        }
        $link->slug =  slug_th($request->link);
        $link->save();
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
        $link = link::find($id);
        return view('links.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LinkRequest $request, $id)
    {
        $link = link::find($id);
        $link->link = $request->link;
        $link->url = $request->url;
        $link->user_id = $request->author;
        if ($request->hasFile('image')) {
            $filename = time().".".$request->file('image')->getClientOriginalExtension();
            if ($link->image != 'link.jpg') {
                Storage::disk('link')->delete($link->image);
            }
            Image::make($request->file('image'))->save(public_path('images/links/' . $filename));
            $link->image = $filename;
        } else {
            $link->image = $link->image;
        }
        $link->slug =  slug_th($request->link);
        $link->save();
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
        $link = link::find($id);
        if ($link->image != 'link.jpg') {
            Storage::disk('link')->delete($link->image);
        }
        $link->delete();
        return back()->with([
          'alert' => 'alert-success',
          'message' => 'ลบข้อมูลเรียบร้อย',
        ]);
    }
}
