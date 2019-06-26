<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PersonnelRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Course;
use App\Department;
use App\Personnel;

class PersonnelController extends Controller
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
        $personnels = Personnel::all();
        $departments = Department::all();
        $courses = Course::all();
        return view('personnels.index', compact('personnels', 'departments', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $courses = Course::all();
        return view('personnels.create', compact('departments', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonnelRequest $request)
    {
        $personnel = new Personnel;
        $personnel->name = $request->name;
        $personnel->gender = $request->gender;
        $personnel->category = $request->category;
        $personnel->position = $request->position;
        $personnel->accredit = $request->accredit;
        $personnel->degree = $request->degree;
        $personnel->qualification = $request->qualification;
        $personnel->major = $request->major;
        $personnel->tel = $request->tel;
        $personnel->email = $request->email;
        $personnel->department_id = $request->department;
        $personnel->department_level = $request->department_level;
        $personnel->responsible = $request->responsible;
        $personnel->course_id = $request->course;
        $personnel->course_level = $request->course_level;
        $personnel->teach = $request->teach;
        $personnel->user_id = $request->author;
        if ($request->hasFile('image')) {
            $filename = time().".".$request->file('image')->getClientOriginalExtension();
            Image::make($request->file('image'))->resize(200, 250)->save(public_path('images/personnels/' . $filename));
            $personnel->image = $filename;
        } else {
            $personnel->image = 'personnel.jpg';
        }
        $personnel->slug =  slug_th($personnel->name);
        $personnel->save();
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
        $personnel = Personnel::find($id);
        $size = filesize('images/personnels/'.$personnel->image);
        $departments = Department::all();
        $courses = Course::all();
        return view('personnels.edit', compact('personnel', 'departments', 'courses', 'size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonnelRequest $request, $id)
    {
        $personnel = Personnel::find($id);
        $personnel->name = $request->name;
        $personnel->gender = $request->gender;
        $personnel->category = $request->category;
        $personnel->position = $request->position;
        $personnel->accredit = $request->accredit;
        $personnel->degree = $request->degree;
        $personnel->qualification = $request->qualification;
        $personnel->major = $request->major;
        $personnel->tel = $request->tel;
        $personnel->email = $request->email;
        $personnel->department_id = $request->department;
        $personnel->department_level = $request->department_level;
        $personnel->responsible = $request->responsible;
        $personnel->course_id = $request->course;
        $personnel->course_level = $request->course_level;
        $personnel->teach = $request->teach;
        $personnel->user_id = $request->author;
        if ($request->hasFile('image')) {
            $filename = time().".".$request->file('image')->getClientOriginalExtension();
            if ($personnel->image != 'personnel.jpg') {
                Storage::disk('personnel')->delete($personnel->image);
            }
            Image::make($request->file('image'))->resize(200, 250)->save(public_path('images/personnels/' . $filename));
            $personnel->image = $filename;
        } else {
            $personnel->image = $personnel->image;
        }
        $personnel->slug =  slug_th($personnel->name);
        $personnel->save();
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
        $personnel = Personnel::find($id);
        if ($personnel->image != 'personnel.jpg') {
            Storage::disk('personnel')->delete($personnel->image);
        }
        $personnel->delete();
        return back()->with([
           'alert' => 'alert-success',
           'message' => 'ลบข้อมูลเรียบร้อย',
        ]);
    }
}
