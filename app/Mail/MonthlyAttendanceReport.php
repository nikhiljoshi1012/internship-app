<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

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
        return $this->view('emails.monthly-attendance')
            ->subject('Monthly Attendance Report - ' . date('F Y', strtotime($this->month)));
    }
}
