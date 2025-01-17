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

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
}
