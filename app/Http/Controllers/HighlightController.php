<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HighlightRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Article;
use App\Highlight;

class HighlightController extends Controller
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
        $highlights= Highlight::all();
        return view('highlights.index', compact('highlights'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles = Article::all()->where('status', '1');
        return view('highlights.create', compact('categories', 'articles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HighlightRequest $request)
    {
        $highlight = new Highlight;
        $highlight->highlight = $request->highlight;
        $highlight->status = $request->status;
        $highlight->user_id = $request->author;
        if ($request->hasFile('image')) {
            $filename = time().".".$request->file('image')->getClientOriginalExtension();
            Image::make($request->file('image'))->resize(1920, 660)->save(public_path('images/highlights/' . $filename));
            $highlight->image = $filename;
        } else {
            $highlight->image = 'highlight.jpg';
        }
        $highlight->url = $request->url;
        $highlight->slug =  slug_th($request->highlight);
        $highlight->save();
        $highlight->articles()->sync($request->article, false);
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
        $highlight = Highlight::find($id);
        $size = filesize('images/highlights/'.$highlight->image);
        $articles = Article::all()->where('status', '1');
        $article_array = array();
        foreach ($highlight->articles as $article) {
            $article_array[$article->id] = $article->article;
        }
        return view('highlights.edit', compact('highlight', 'articles', 'article_array', 'size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HighlightRequest $request, $id)
    {
        $highlight = Highlight::find($id);
        $highlight->highlight = $request->highlight;
        $highlight->status = $request->status;
        $highlight->user_id = $request->author;
        if ($request->hasFile('image')) {
            $filename = time().".".$request->file('image')->getClientOriginalExtension();
            if ($highlight->image != 'highlight.jpg') {
                Storage::disk('highlight')->delete($highlight->image);
            }
            Image::make($request->file('image'))->resize(1920, 660)->save(public_path('images/highlights/' . $filename));
            $highlight->image = $filename;
        } else {
            $highlight->image = $highlight->image;
        }
        $highlight->url = $request->url;
        $highlight->slug =  slug_th($request->highlight);
        $highlight->save();
        $highlight->articles()->sync($request->article, false);
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
        $highlight = Highlight::find($id);
        if ($highlight->image != 'highlight.jpg') {
            Storage::disk('highlight')->delete($highlight->image);
        } else {
            $highlight->image = $highlight->image;
        }
        $highlight->articles()->detach();
        $highlight->delete();
        return back()->with([
           'alert' => 'alert-success',
           'message' => 'ลบข้อมูลเรียบร้อย!',
        ]);
    }
}
