<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_mark extends Model
{
    use HasFactory;
    protected $table = 'students_marks';
    protected $fillable = [
        'student_id',
        'mark',
        'result',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
