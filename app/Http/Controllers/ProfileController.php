<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\User;

class ProfileController extends Controller
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
        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(404);
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
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate($request, [
            'name'   => 'required|max:255',
            'email' => 'required',
            'avatar' => 'dimensions:min_width=200,min_height=200',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->hasFile('avatar')) {
            $filename = time().".".$request->file('avatar')->getClientOriginalExtension();
            if ($user->avatar != 'avatar.jpg') {
                Storage::disk('avatar')->delete($user->avatar);
            }
            list($width, $height) = getimagesize($request->file('avatar'));
            if ($width > $height) {
                Image::make($request->file('avatar'))->resize(null, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->crop(200, 200)->save(public_path('images/avatars/' . $filename)); //Landscape
            } else {
                Image::make($request->file('avatar'))->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->crop(200, 200)->save(public_path('images/avatars/' . $filename)); //Portrait
            }
            $user->avatar = $filename;
        } else {
            $user->avatar = $user->avatar;
        }
        $user->save();
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
        return abort(404);
    }
}
