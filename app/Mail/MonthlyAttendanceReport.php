<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class MonthlyAttendanceReport extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $month;
    public $attendanceData;

    public function __construct($student, $month, $attendanceData)
    {
        $this->student = $student;
        $this->month = $month;
        $this->attendanceData = $attendanceData;
    }

    public function build()
    {
        // Force database query to get fresh data
        $freshAttendanceData = $this->student->attendance()->whereMonth('date', Carbon::parse($this->month)->month)->get();

        return $this->view('emails.monthly-attendance')
            ->with([
                'student' => $this->student,
                'month' => $this->month,
                'attendanceData' => $freshAttendanceData
            ])
            ->subject('Monthly Attendance Report - ' . date('F Y', strtotime($this->month)));
    }
}
