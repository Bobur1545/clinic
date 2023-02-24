<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {
        $teachers = Teacher::all();
        $departments = Department::all();
        return view('admin.teacher', ['teachers' => $teachers, 'departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::all();
        return view('admin.teacher', ['teachers' => $teachers ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request):RedirectResponse
    {
        $request->validate([
            'name'=> 'required', 'tel_number'=>'required',
            'email'=>'required', 'speciality'=>'required', 'department_id'=>'required', 'image'=>'required|file'
        ]);

        $input = $request->all();

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $destinationPath = 'images/';
            $profilImage = '/'.$destinationPath.date('YmdHis').'.'.$image->getClientOriginalName();
            $image->move($destinationPath, $profilImage);
            $input['image'] = "$profilImage";
        }

        Teacher::create($input);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.teacher', compact('teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $id)
    {
        $request->validate([
            'name'=> 'required',
            'tel_number'=>'required',
            'email'=>'required',
            'speciality'=>'required',
            'department_id'=>'required'
        ]);

        $teacher = Teacher::find($request->id);
        if ($request->hasFile('image')){
            unlink(public_path($teacher->image));
            $image = $request->file('image');
            $profilImage = date('YmdHis').'.'.$image->getClientOriginalName();
            $image->move(public_path("images/"), $profilImage);
            $teacher->image="/images/".$profilImage;
        }

        $teacher->name = $request->name;
        $teacher->tel_number = $request->tel_number;
        $teacher->email = $request->email;
        $teacher->speciality = $teacher->speciality;
        $teacher->department_id = $request->department_id;
        $teacher->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->back();
    }

    public function teachers()
    {
        $teachers = Teacher::all();
        $departments = Department::all();
        return view('teachers', ['teachers' => $teachers, 'departments' => $departments]);
    }

}
