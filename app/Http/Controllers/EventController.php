<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Event;
use Carbon\Carbon;

class EventController extends Controller
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
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $event = new Event;
        $event->event = $request->event;
        $event->organizer = $request->organizer;
        $event->description = $request->description;

        $event->start_date = Carbon::parse($request->start_date);
        $event->end_date = Carbon::parse($request->end_date);
        $week= Carbon::parse($request->start_date)->dayOfWeekIso;
        $color_array  = ['#f39c12', '#e84393', '#27ae60', '#d35400', '#2980b9', '#8e44ad', '#c0392b'];
        $event->color = $color_array[$week-1];
        $event->user_id = $request->author;
        $event->view = "0";
        $event->slug = slug_th($request->event);
        $event->save();
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
        $event = Event::find($id);
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, $id)
    {
        $event = Event::find($id);
        $event->event = $request->event;
        $event->organizer = $request->organizer;
        $event->description = $request->description;
        $event->start_date = Carbon::parse($request->start_date);
        $event->end_date = Carbon::parse($request->end_date);
        $week = Carbon::parse($request->start_date)->dayOfWeekIso;
        $color_array  = ['#f39c12', '#e84393', '#27ae60', '#d35400', '#2980b9', '#8e44ad', '#c0392b'];
        $event->color = $color_array[$week-1];
        $event->user_id = $request->author;
        $event->slug = slug_th($request->event);
        $event->save();
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
        $event = Event::find($id);
        $event->delete();
        return back()->with([
          'alert' => 'alert-success',
          'message' => 'ลบข้อมูลเรียบร้อย!',
        ]);
    }
}
