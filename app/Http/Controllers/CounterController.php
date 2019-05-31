<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CounterRequest;
use App\Counter;

class CounterController extends Controller
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
        $counters= Counter::all();
        return view('counters.index', compact('counters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('counters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CounterRequest $request)
    {
        $counter = new Counter;
        $counter->title = $request->title;
        $counter->icon = $request->icon;
        $counter->quantity = $request->quantity;
        $counter->user_id = $request->author;
        $counter->save();
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
        $counter = Counter::find($id);
        return view('counters.edit', compact('counter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CounterRequest $request, $id)
    {
        $counter = Counter::find($id);
        $counter->title = $request->title;
        $counter->icon = $request->icon;
        $counter->quantity = $request->quantity;
        $counter->user_id = $request->author;
        $counter->save();
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
        $counter = Counter::find($id);
        $counter->delete();
        return back()->with([
         'alert' => 'alert-success',
         'message' => 'ลบข้อมูลเรียบร้อย',
      ]);
    }
}
