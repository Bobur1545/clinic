<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Group;
use App\Models\Tutor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$groups = Group::all();
        $groups = DB::select("SELECT groups.id,groups.name,groups.tutor_id,groups.department_id,departments.name as dname from groups INNER JOIN departments on groups.department_id=departments.id;");
        $departments = Department::all();
        $tutors = Tutor::all();
        return view('admin.group', ['groups' => $groups, 'departments' => $departments, 'tutors' => $tutors] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::all();
        return view('admin.group', ['groups' => $groups]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required', 'department_id' => 'required', 'tutor_id' => 'required'
        ]);

        Group::create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group):RedirectResponse
    {
        $request->validate([
           'name' => 'required', 'department_id' => 'required', 'tutor_id' => 'required'
        ]);

        $group = Group::find($request->id);
        $group->name = $request->name;
        $group->department_id = $request->department_id;
        $group->tutor_id = $request->tutor_id;
        $group->save();
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->back();
    }
}
