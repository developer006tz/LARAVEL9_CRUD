<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Student::latest()->paginate(5);
        return view('index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name'=>'required',
            'student_email'=>'required|email|unique:students',
            'student_date_of_birth'=>'required|date',
            'student_image'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ]);

        $file_name = time().'.'.request()->student_image->getClientOriginalExtension();
        request()->student_image->move(public_path('images'),$file_name);

        $student = new Student;

        $student->student_name=$request->student_name;
        $student->student_email=$request->student_email;
        $student->student_gender=$request->student_gender;
        $student->student_date_of_birth=$request->student_date_of_birth;
        $student->student_image= $file_name;

        $student->save();

        return redirect()->route('students.index')->with('success','student added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('show',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('edit',compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'student_name'=>'required',
            'student_email'=>'required|email|unique:students',
            'student_date_of_birth'=>'required|date',
            'student_image'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ]);

        $student_image = $request->hidden_student_image;

        if($request->student_image !=''){
            $student_image= time().'.'.request()->student_image->getClientOriginalExtension();
            request()->student_image->move(public_path('images'), $student_image);
        }

        $student = Student::find($request->hidden_id);
        $student->student_name = $request->student_name;
        $student->student_email = $request->student_email;
        $student->student_gender = $request->student_gender;
        $student->student_date_of_birth=$request->student_date_of_birth;
        $student->student_image = $studend_image;

        $student->save();

        return redirect()->route('student.index')->with('success','Student added successfull');
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
        return redirect()->route('Student.index')->with('Success', 'Student deleted ');
    }
}
