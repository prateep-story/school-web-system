<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Article;
use App\Tag;
use App\Fileupload;

class ArticleController extends Controller
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
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('articles.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article;
        $article->article = $request->article;
        $article->category_id = $request->category;
        $article->content = $request->content;
        $article->status = $request->status;
        $article->user_id = $request->author;
        $article->view = "0";
        if ($request->hasFile('image')) {
            $filename = time().".".$request->file('image')->getClientOriginalExtension();
            Image::make($request->file('image'))->save(public_path('images/articles/' . $filename));
            Image::make($request->file('image'))->resize(350, 183)->save(public_path('images/thumbnails/' . $filename));
            $article->image = $filename;
        } else {
            $article->image = 'article.jpg';
        }
        $article->slug =  slug_th($request->article);
        $article->save();
        $article->tags()->sync($request->tags, false);
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
        $article = Article::find($id);
        $size = filesize('images/articles/'.$article->image);
        $categories = Category::all();
        $tags = Tag::all();
        $tag_array = array();
        foreach ($article->tags as $tag) {
            $tag_array[$tag->id] = $tag->tag;
        }
        $fileuploadArray = array();
        return view('articles.edit', compact('article', 'categories', 'tags', 'tag_array', 'size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = Article::find($id);
        $article->article = $request->article;
        $article->category_id = $request->category;
        $article->content = $request->content;
        $article->status = $request->status;
        $article->user_id = $request->author;
        if ($request->hasFile('image')) {
            $filename = time().".".$request->file('image')->getClientOriginalExtension();
            if ($article->image != 'article.jpg') {
                Storage::disk('article')->delete($article->image);
                Storage::disk('thumbnail')->delete($article->image);
            }
            Image::make($request->file('image'))->save(public_path('images/articles/' . $filename));
            Image::make($request->file('image'))->resize(350, 183)->save(public_path('images/thumbnails/' . $filename));
            $article->image = $filename;
        } else {
            $article->image = $article->image;
        }
        $article->slug = slug_th($request->article);
        $article->save();
        $article->tags()->sync($request->tags, true);
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
        $article = Article::find($id);
        $article->tags()->detach();
        if ($article->image != 'article.jpg') {
            Storage::disk('article')->delete($article->image);
            Storage::disk('thumbnail')->delete($article->image);
        }
        $article->delete();
        return back()->with([
           'alert' => 'alert-success',
           'message' => 'ลบข้อมูลเรียบร้อย',
        ]);
    }
}
