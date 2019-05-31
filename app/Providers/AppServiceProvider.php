<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        View::composer('layouts.back-end.master', function ($view) {
            $notifications = \App\Contact::all()->where('read', '0');
            $view->with('notifications', $notifications);
        });
        view::composer('layouts.front-end.master', function ($view) {
            $navbar_categories = \App\Category::all();
            $navbar_departments = \App\Department::all();
            $navbar_courses = \App\Course::all();
            $navbar_documents = \App\Document::all();
            $navbar_galleries = \App\Gallery::all();

            /*--------------------visitor-----------------------*/
            $visitors = \App\Visitor::all()->count();
            $sessions = \App\Session::all()->count();
            $ip_address = request()->ip();
            $user_agent = request()->header('User-Agent');

            $year = Carbon::now()->format('Y');
            $month = Carbon::now()->format('m');
            // $days_in_month = Carbon::now()->daysInMonth;
            $day = Carbon::now()->format('d');

            $start_of_year = Carbon::create($year, 1, 31)->startOfYear();
            $end_of_year = Carbon::create($year, 1, 31)->endOfYear();
            $start_of_month = Carbon::create($year, $month)->startOfMonth();
            $end_of_month = Carbon::create($year, $month)->endOfMonth();
            $start_of_day = Carbon::create($year, $month, $day)->startOfDay();
            $end_of_day= Carbon::create($year, $month, $day)->endOfDay();

            $start_last_year = Carbon::create(strval($year-1), 1, 31)->startOfYear();
            $end_last_year = Carbon::create(strval($year-1), 1, 31)->endOfYear();
            $start_last_month = Carbon::create($year, strval($month-1))->startOfMonth();
            $end_last_month = Carbon::create($year, strval($month-1))->endOfMonth();
            $start_last_day = Carbon::create($year, $month, strval($day-1))->startOfDay();
            $end_last_day= Carbon::create($year, $month, strval($day-1))->endOfDay();

            $visitor_in_year = \App\Visitor::all()->where('created_at', '>=', $start_of_year)->where('created_at', '<=', $end_of_year)->count();
            $visitor_in_month = \App\Visitor::all()->where('created_at', '>=', $start_of_month)->where('created_at', '<=', $end_of_month)->count();
            $visitor_in_day = \App\Visitor::all()->where('created_at', '>=', $start_of_day)->where('created_at', '<=', $end_of_day)->count();

            $visitor_last_year = \App\Visitor::all()->where('created_at', '>=', $start_last_year)->where('created_at', '<=', $end_last_year)->count();
            $visitor_last_month = \App\Visitor::all()->where('created_at', '>=', $start_last_month)->where('created_at', '<=', $end_last_month)->count();
            $visitor_last_day = \App\Visitor::all()->where('created_at', '>=', $start_last_day)->where('created_at', '<=', $end_last_day)->count();
            // dd($start_last_month.' --- '.$end_last_month);

            $view->with([
              'navbar_categories' => $navbar_categories,
              'navbar_departments' => $navbar_departments,
              'navbar_courses' => $navbar_courses,
              'navbar_documents' => $navbar_documents,
              'navbar_galleries' => $navbar_galleries,
              'visitors' => $visitors,
              'sessions' => $sessions,
              'ip_address' => $ip_address,
              'user_agent' => $user_agent,
              'visitor_in_year' => $visitor_in_year,
              'visitor_in_month' => $visitor_in_month,
              'visitor_in_day' => $visitor_in_day,
              'visitor_last_year' => $visitor_last_year,
              'visitor_last_month' => $visitor_last_month,
              'visitor_last_day' => $visitor_last_day,
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
