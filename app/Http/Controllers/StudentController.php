<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {
        $students = Student::all();
        $groups = Group::all();

        return view('admin.student', ['students' => $students, 'groups' => $groups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all();
        return view('admin.student', ['students' => $students]);
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
            'name' => 'required', 'group_id' => 'required', 'image' => 'required|file'
        ]);

        $input = $request->all();
        if ($request->hasFile('image')){
            $image = $request->file('image');
            $destinationPath = 'images/';
            $profilImage = '/'.$destinationPath.date('YmdHis').'.'.$image->getClientOriginalName();
            $image->move($destinationPath, $profilImage);
            $input['image'] = $profilImage;
        }

        Student::create($input);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('admin.student', compact('students'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $id):RedirectResponse
    {
        $request->validate([
            'name' => 'required', 'group_id' => 'required'
        ]);

        $student = Student::find($request->id);
        if ($request->hasFile('image')){
            unlink(public_path($student->image));
            $image = $request->file('image');
            $profilImage = date('YmdHis').'.'.$image->getClientOriginalName();
            $image->move(public_path("images/"), $profilImage);
            $student->image="/images/".$profilImage;
        }

        $student->name = $request->name;
        $student->group_id = $request->group_id;
        $student->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->back();
    }
}
