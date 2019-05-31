<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CyrildeWit\EloquentViewable\Viewable;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Calendar;
use Tracker;
use XmlParser;
use App\Category;
use App\Article;
use App\Tag;
use App\Highlight;
use App\Guidance;
use App\File;
use App\Gallery;
use App\Picture;
use App\Event;
use App\Department;
use App\Course;
use App\Personnel;
use App\Document;
use App\Research;
use App\Portfolio;
use App\Award;
use App\Message;
use App\Counter;
use App\Visitor;
use App\Link;

class FrontpageController extends Controller
{
    public function index()
    {
        //Visitor Counter
        $user_agent = request()->header('User-Agent');
        $ip_address = request()->ip();
        $date_now = now()->format('Y-m-d');
        $visitors = Visitor::where('ip_address', $ip_address)->whereDate('created_at', $date_now)->get();
        if (!$visitors->count()) {
            $visitor = new Visitor;
            $visitor->ip_address = $ip_address;
            $visitor->user_agent = $user_agent;
            $visitor->save();
        }
        $articles = Category::join('articles', function ($join) {
            $join->on('categories.id', 'articles.category_id')
            ->where('categories.type', 'ข่าว')
            ->where('articles.status', '1');
        })->get()->sortByDesc('created_at');
        $highlights = Highlight::all();
        $guidances = Guidance::all();
        $galleries = Gallery::all();
        $events = Event::all();
        $departments = Department::all();
        $courses = Course::all();
        $documents = Document::all();
        $portfolios = Portfolio::all();
        $awards = Award::all();
        $files = File::all();
        $personnels = Personnel::all()->where('position', 'ผู้อำนวยการโรงเรียน');
        $messages = Message::all();
        $counters = Counter::all();
        $researches = Research::all();
        $links = Link::all();
        $xml = XmlParser::load('https://www.kroobannok.com/rss.xml');
        $feed  = $xml->getContent();
        return view('frontpage', compact('articles', 'highlights', 'guidances', 'galleries', 'events', 'departments', 'portfolios', 'awards', 'courses', 'documents', 'files', 'personnels', 'messages', 'counters', 'researches', 'links', 'feed'));
    }
    public function article($category, $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        //meta
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $title = $article->article;
        $description = str_limit($article->content);
        $image = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://$_SERVER[HTTP_HOST]/images/articles/".$article->image;

        $article->increment('view');
        $article->save();
        $categories = Category::all();
        $articles = Article::all();
        $tags = Tag::all();
        return view('article', compact('article', 'categories', 'articles', 'tags', 'url', 'title', 'description', 'image'));
    }

    public function articles()
    {
        $data = Category::join('articles', function ($join) {
            $join->on('categories.id', '=', 'articles.category_id')
            ->where('categories.type', 'ข่าว')
            ->where('articles.status', '1');
        })->orderBy('articles.created_at', 'desc')->paginate(9);
        $categories = Category::all();
        $articles = Article::all();
        $tags = Tag::all();
        return view('articles', compact('categories', 'tags', 'articles', 'data'));
    }

    public function categories($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $data = Article::where('status', '1')->where('category_id', $category->id)->orderBy('created_at', 'desc')->paginate(9);
        $categories = Category::all();
        $articles = Article::all();
        $tags = Tag::all();
        return view('categories', compact('category', 'data', 'articles', 'categories', 'tags'));
    }

    public function tags($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $data = $tag->articles()->where('status', '1')->orderBy('created_at', 'desc')->paginate(9);
        $categories = Category::all();
        $articles = Article::all();
        $tags = Tag::all();
        return view('tags', compact('tag', 'articles', 'data', 'categories', 'tags'));
    }

    public function events()
    {
        $cards = Event::orderBy('start_date', 'desc')->paginate(9);
        $events = Event::all();
        $data = [];
        if ($events->count()) {
            foreach ($events as $key => $value) {
                $data[] = Calendar::event(
                $value->event,
                true,
                new \DateTime($value->start_date),
                new \DateTime($value->end_date.' +1 day'),
                null,
                [
                  'color' => $value->color,
                  'url' => 'กิจกรรม/'.$value->slug,
                ]
              );
            }
        }
        $calendar = Calendar::addEvents($data);
        return view('events', compact('cards', 'calendar', 'events'));
    }
    public function event($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $events = Event::all();
        return view('event', compact('events', 'event'));
    }

    public function departments($slug)
    {
        $department = Department::where('slug', $slug)->firstOrFail();
        $departments = Department::all();
        $personnels = Personnel::all();
        return view('departments', compact('department', 'personnels', 'departments'));
    }
    public function courses($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $courses = Course::all();
        $personnels = Personnel::all();
        return view('courses', compact('course', 'personnels', 'departments'));
    }
    public function personnel($slug)
    {
        $personnel = Personnel::where('slug', $slug)->firstOrFail();
        $courses = Course::all();
        $researches = Research::all();
        return view('personnel', compact('personnel', 'courses', 'researches'));
    }
    public function galleries()
    {
        $galleries = Gallery::where('status', '1')->orderBy('created_at', 'desc')->paginate(9);
        return view('galleries', compact('galleries'));
    }
    public function gallery($slug)
    {
        $gallery = Gallery::where('slug', $slug)->firstOrFail();

        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $title = $gallery->gallery;
        $description = str_limit($gallery->content);
        $image = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://$_SERVER[HTTP_HOST]/images/galleries/".$gallery->image;

        $gallery->increment('view');
        $gallery->save();
        $galleries = Gallery::all();
        $pictures = Picture::all();
        return view('gallery', compact('gallery', 'pictures', 'galleries', 'url', 'title', 'description', 'image'));
    }
    public function document($slug)
    {
        $document = Document::where('slug', $slug)->firstOrFail();
        $documents = Document::all();
        $files = File::all();
        return view('document', compact('documents', 'files', 'document'));
    }
    public function documents()
    {
        $files = File::where('status', '1')->orderBy('created_at', 'desc')->paginate(10);
        $documents = Document::all();
        return view('documents', compact('documents', 'files'));
    }
    public function research($slug)
    {
        $research = Research::where('slug', $slug)->firstOrFail();
        return view('research', compact('research'));
    }

    public function researches()
    {
        $researches = Research::orderBy('created_at', 'desc')->paginate(10);
        return view('researches', compact('researches'));
    }
    public function portfolios()
    {
        $awards = Award::paginate(10);
        return view('portfolios', compact('awards'));
    }
    public function award($slug)
    {
        $award = Award::where('slug', $slug)->firstOrFail();
        $awards = Award::all();
        return view('award', compact('award', 'awards'));
    }
    public function rss()
    {
        $articles = Category::join('articles', function ($join) {
            $join->on('categories.id', 'articles.category_id')
            ->where('categories.type', 'ข่าว')
            ->where('articles.status', '1');
        })->get()->sortByDesc('created_at')->slice(0,9);
        return response()->view('rss', compact('articles'))->header('Content-Type', 'text/xml');
    }
}
