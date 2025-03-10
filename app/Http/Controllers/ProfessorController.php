<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\MonthlyAttendanceReport;
use Carbon\Carbon;

class ProfessorController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('professor', compact('students'));
    }

    public function handleAttendance(Request $request, $division)
    {
        if ($request->isMethod('get')) {
            $students = Student::where('division', $division)->orderBy('rollno')->get();
            return view('mark_attendance', compact('students', 'division'));
        }

        $request->validate([
            'date' => 'nullable|date',
            'division' => 'required|string',
            'attendance' => 'required|array',
            'attendance.*' => 'required|boolean',
            'remarks' => 'nullable|array',
            'remarks.*' => 'nullable|string|max:255'
        ]);

        $date = $request->date ?? now()->format('Y-m-d');
        $presentCount = 0;
        $absentCount = 0;

        foreach ($request->attendance as $studentId => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'date' => $date
                ],
                [
                    'is_present' => $status,
                    'remarks' => $request->remarks[$studentId] ?? null
                ]
            );

            $status ? $presentCount++ : $absentCount++;
        }

        return redirect()
            ->route('professor.attendance', ['division' => $division])
            ->with('success', "Attendance marked successfully! Present: $presentCount, Absent: $absentCount");
    }

    public function create()
    {
        return view('create_student');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'rollno' => 'required|string|max:255|unique:students',
            'email' => 'required|email|unique:students',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', //edit size if needed
        ]);

        $photoPath = $request->file('photo') ? $request->file('photo')->store('photos', 'public') : null;

        Student::create([
            'name' => $request->name,
            'division' => $request->division,
            'rollno' => $request->rollno,
            'email' => $request->email,
            'photo' => $photoPath,
        ]);

        return redirect()->route('professor.dashboard')->with('success', 'Student created successfully');
    }

    public function destroy($id)
    {
        Student::find($id)->delete();
        return redirect()->route('professor.dashboard')->with('success', 'Student deleted successfully');
    }

    public function monthlyAttendance($month)
    {
        $students = Student::with(['attendance' => function ($query) use ($month) {
            $query->whereMonth('date', $month);
        }])->get();

        return view('monthly_attendance', compact('students', 'month'));
    }

    public function overallAttendance()
    {
        $month = Carbon::now()->format('F');
        $students = Student::with(['attendance' => function ($query) {
            $query->whereMonth('date', Carbon::now()->month);
        }])->get();

        return view('monthly_attendance', compact('students', 'month'));
    }

    public function sendMonthlyReport($studentId, $month)
    {
        // Get fresh data from database
        $student = Student::with(['attendance' => function ($query) use ($month) {
            $query->whereMonth('date', Carbon::parse($month)->month)
                ->whereYear('date', Carbon::parse($month)->year)
                ->latest(); // Orders by most recent first
        }])->findOrFail($studentId);

        // Pass fresh data to the mail
        Mail::to($student->email)->send(new MonthlyAttendanceReport(
            $student,
            $month,
            $student->attendance
        ));

        return back()->with('success', 'Attendance report sent successfully to ' . $student->email);
    }
    public function manageStudents()
    {
        $students = Student::orderBy('division')
            ->orderBy('rollno')
            ->get();
        return view('manage_students', compact('students'));
    }
}
