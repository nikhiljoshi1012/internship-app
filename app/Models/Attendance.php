<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Attendance extends Model
{
    protected $fillable = ['student_id', 'date', 'is_present'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
