<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Tutor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {
        $faculties = Faculty::all();
        $tutors = Tutor::all();
        return view('admin.tutor', ['tutors' => $tutors, 'faculties' => $faculties]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tutors = Tutor::all();
        return view('admin.tutor', ['tutors' => $tutors]);
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
            'address'=>'required', 'faculty_id'=>'required', 'image'=>'required|file'
        ]);

        $input = $request->all();

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $destinationPath = 'images/';
            $profilImage = '/'.$destinationPath.date('YmdHis').'.'.$image->getClientOriginalName();
            $image->move($destinationPath, $profilImage);
            $input['image'] = "$profilImage";
        }

        Tutor::create($input);
        return redirect()->back()->with('success','Muvaffaqiyatli yaratildi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function show(Tutor $tutor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function edit(Tutor $tutor)
    {
        return view('admin.tutor', compact('tutors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tutor $id):RedirectResponse
    {
        $request->validate([
            'name'=> 'required',
            'tel_number'=>'required',
            'address'=>'required',
            'faculty_id'=>'required'
        ]);

        $tutor = Tutor::find($request->id);
        if ($request->hasFile('image')){
            unlink(public_path($tutor->image));
            $image = $request->file('image');
            $profilImage = date('YmdHis').'.'.$image->getClientOriginalName();
            $image->move(public_path("images/"), $profilImage);
            $tutor->image="/images/".$profilImage;
        }

        $tutor->name = $request->name;
        $tutor->tel_number = $request->tel_number;
        $tutor->address = $request->address;
        $tutor->faculty_id = $request->faculty_id;
        $tutor->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tutor $tutor)
    {
        $tutor->delete();
        return redirect()->back()->with('success','Muvaffaqiyatli o\'chirildi');
    }

    public function tutors()
    {
        $faculties = Faculty::all();
        $tutors = Tutor::all();
        return view('tutors', ['tutors' => $tutors, 'faculties' => $faculties]);
    }
}
