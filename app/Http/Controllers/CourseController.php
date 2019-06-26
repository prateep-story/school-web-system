<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;
use App\Course;

class CourseController extends Controller
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
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $course = new Course;
        $course->course = $request->course;
        $course->description = $request->description;
        $course->user_id = $request->author;
        $course->slug = slug_th($request->course);
        $course->save();
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
        $course = Course::find($id);
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
        $course = Course::find($id);
        $course->course = $request->course;
        $course->description = $request->description;
        $course->user_id = $request->author;
        $course->slug = slug_th($request->course);
        $course->save();
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
        $course = Course::find($id);
        $course->delete();
        return back()->with([
          'alert' => 'alert-success',
          'message' => 'ลบข้อมูลเรียบร้อย!',
        ]);
    }
}
