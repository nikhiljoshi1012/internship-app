<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Support\Facades\Storage;

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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $photoPath = $request->file('photo') ? $request->file('photo')->store('photos', 'public') : null;

        Student::create([
            'name' => $request->name,
            'division' => $request->division,
            'rollno' => $request->rollno,
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
        $divisions = Student::select('division')->distinct()->get();
        $attendanceData = [];

        foreach ($divisions as $division) {
            $students = Student::where('division', $division->division)->get();
            $totalPresent = Attendance::whereIn('student_id', $students->pluck('id'))
                ->where('is_present', 1)
                ->count();
            $totalRecords = Attendance::whereIn('student_id', $students->pluck('id'))->count();

            $attendanceData[$division->division] = [
                'percentage' => $totalRecords > 0 ?
                    round(($totalPresent / $totalRecords) * 100, 2) : 0,
                'total_students' => $students->count()
            ];
        }

        return view('overall_attendance', compact('attendanceData'));
    }
}
