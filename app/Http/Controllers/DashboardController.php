<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Category;
use App\Article;
use App\File;
use App\Gallery;
use App\Award;
use App\Research;
use App\Highlight;
use App\Personnel;
use App\Contact;
use App\Visitor;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->where('email_verified_at', '!=', null);
        $files = File::all();
        $articles = Article::all();
        $categories = Category::all();
        $galleries = Gallery::all();
        $awards = Award::all();
        $researches = Research::all();
        $highlights = Highlight::all();
        $personnels = Personnel::all();
        $contacts = Contact::all();

        $visitor = [];
        $year = now()->format('Y');
        $start = Carbon::create($year, 1, 31, 12, 0, 0)->startOfYear();
        $end = Carbon::create($year, 1, 31, 12, 0, 0)->endOfYear();

        $visitors = Visitor::all()->where('created_at', '>=', $start)->where('created_at', '<=', $end)->groupBy(function ($month) {
            return $month->created_at->format('m');
        });

        foreach ($visitors as $key => $value) {
            $count[(int)$key] = count($value);
        }

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($count[$i])) {
                $visitor[$i] = $count[$i];
            } else {
                $visitor[$i] = 0;
            }
        }

        // dd($articles_data);
        return view('dashboard', compact('users', 'categories', 'articles', 'files', 'galleries', 'awards', 'researches', 'highlights', 'personnels', 'contacts', 'visitor'));
    }
}
