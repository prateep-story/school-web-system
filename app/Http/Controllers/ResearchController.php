<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ResearchRequest;
use App\Research;
use App\Personnel;

class ResearchController extends Controller
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
        $researches = Research::all();
        return view('researches.index', compact('researches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personnels = Personnel::all();
        return view('researches.create', compact('personnels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResearchRequest $request)
    {
        $research = new Research;
        $research->research = $request->research;
        $research->personnel_id = $request->personnel;
        $research->year = $request->year;
        $research->abstract = $request->abstract;
        $research->result = $request->result;
        $research->status = $request->status;
        $research->user_id = $request->author;
        $research->view = "0";
        $research->slug =  slug_th($request->research);
        $research->save();
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
        $research = Research::find($id);
        $personnels = Personnel::all();
        return view('researches.edit', compact('research', 'personnels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ResearchRequest $request, $id)
    {
        $research = Research::find($id);
        $research->research = $request->research;
        $research->personnel_id = $request->personnel;
        $research->year = $request->year;
        $research->abstract = $request->abstract;
        $research->result = $request->result;
        $research->status = $request->status;
        $research->user_id = $request->author;
        $research->slug =  slug_th($request->research);
        $research->save();
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
        $research = Research::find($id);
        $research->delete();
        return back()->with([
           'alert' => 'alert-success',
           'message' => 'ลบข้อมูลเรียบร้อย',
        ]);
    }
}
