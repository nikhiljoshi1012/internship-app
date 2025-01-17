<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        if (!$student) {
            $student = new Student();
            $student->email = Auth::user()->email;
            $student->save();
        }
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

    public function viewMyAttendance()
    {
        $student = Student::where('email', Auth::user()->email)->first();
        if (!$student) {
            Log::error('Student record not found for user: ' . Auth::user()->email);
            abort(404);
        }
        $attendances = Attendance::where('student_id', $student->id)
            ->orderBy('date', 'desc')
            ->get();

        return view('student_attendance', compact('attendances'));
    }
}
