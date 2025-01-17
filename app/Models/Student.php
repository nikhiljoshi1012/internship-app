<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email',
        'division',
        'rollno',
        'photo'
    ];

    // In Student.php model
    public function attendance()
    {
        return $this->hasMany(Attendance::class)->latest();
    }
}
