<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        return Student::all();
    }
    public function show($id)
    {
        return Student::find($id);
    }
    public function store(Request $req)
    {
        $req->validate([
                'name'=>'required',
                'city'=>'required',
                'fees'=>'required',
        ]);
         return Student::create($req->all());
    }
    public function update(Request $req,$id)
    {
        $student=Student::find($id);
        $student->name=$req->name;
        $student->city=$req->city;
        $student->fees=$req->fees;
        $student->update();
        return $student;

       /*  $student=Student::find($id);
        $student->update($req->all());
        return $student; */
    }
    public function destroy($id)
    {
         return Student::find($id)->delete();
    }
}
