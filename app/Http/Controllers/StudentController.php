<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Attendance;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('student', compact('students'));
    }

    public function show($id)
    {
        $student = Student::find($id);
        $attendances = Attendance::where('student_id', $id)->get();
        return view('student-attendance', compact('student', 'attendances'));
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
        }
        return redirect()->route('student.index');
    }
}
