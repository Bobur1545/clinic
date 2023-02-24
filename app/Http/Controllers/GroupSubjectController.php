<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Group;
use App\Models\GroupSubject;
use App\Models\TeacherSubject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GroupSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {
        $groupSubjects = GroupSubject::all();
        $groups = Group::all();
        $subjects = Subject::all();

        return view('admin.groupSubject', ['groupSubjects' => $groupSubjects, 'groups' => $groups, 'subjects' => $subjects]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'group_id' => 'required', 'subject_id' => 'required'
        ]);

        GroupSubject::create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupSubject  $groupSubject
     * @return \Illuminate\Http\Response
     */
    public function show(GroupSubject $groupSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupSubject  $groupSubject
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupSubject $groupSubject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GroupSubject  $groupSubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupSubject $groupSubject):RedirectResponse
    {

        $request->validate([
            'group_id' => 'required', 'subject_id' => 'required'
        ]);

        $groupSubject = GroupSubject::find($request->id);
        $groupSubject->group_id = $request->group_id;
        $groupSubject->subject_id = $request->subject_id;

        $groupSubject->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupSubject  $groupSubject
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupSubject $groupSubject)
    {
        $groupSubject->delete();
        return redirect()->back();
    }
}
