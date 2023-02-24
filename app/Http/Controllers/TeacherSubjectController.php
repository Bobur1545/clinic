<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherSubject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeacherSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {
        $teacherSubjects = TeacherSubject::all();
        $teachers = Teacher::all();
        $subjects = Subject::all();

        return view('admin.teacherSubject', ['teacherSubjects' => $teacherSubjects, 'teachers' => $teachers, 'subjects' => $subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teacherSubjects = TeacherSubject::all();
        return view('admin.teacherSubject', ['teacherSubjects' => $teacherSubjects]);
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
            'teacher_id' => 'required', 'subject_id' => 'required'
        ]);
        TeacherSubject::create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeacherSubject  $teacherSubject
     * @return \Illuminate\Http\Response
     */
    public function show(TeacherSubject $teacherSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeacherSubject  $teacherSubject
     * @return \Illuminate\Http\Response
     */
    public function edit(TeacherSubject $teacherSubject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeacherSubject  $teacherSubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeacherSubject $teacherSubject):RedirectResponse
    {
        $request->validate([
            'teacher_id' => 'required', 'subject_id' => 'required'
        ]);

        $teacherSubject = TeacherSubject::find($request->id);
        $teacherSubject->teacher_id = $request->teacher_id;
        $teacherSubject->subject_id = $request->subject_id;

        $teacherSubject->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeacherSubject  $teacherSubject
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherSubject $teacherSubject)
    {
        $teacherSubject->delete();
        return redirect()->back();
    }
}
