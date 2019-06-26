<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use App\Department;

class DepartmentController extends Controller
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
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        $department = new Department;
        $department->department = $request->department;
        $department->description = $request->description;
        $department->user_id = $request->author;
        $department->slug = slug_th($request->department);
        $department->save();
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
        $department = Department::find($id);
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, $id)
    {
        $department = Department::find($id);
        $department->department = $request->department;
        $department->description = $request->description;
        $department->user_id = $request->author;
        $department->slug = slug_th($request->department);
        $department->save();
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
        $department = Department::find($id);
        $department->delete();
        return back()->with([
        'alert' => 'alert-success',
        'message' => 'ลบข้อมูลเรียบร้อย!',
      ]);
    }
}
