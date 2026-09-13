<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Session extends Model
{
    use HasFactory;
    protected $table = 'sessions_number';
    protected $fillable =
    [
        'exam_day_id',
        'student_id',
        'start_of_test',
        'end_of_test',
        'note',
        'session_name'
    ];



    public function students()
    {
        return $this->belongsToMany(Student::class, 'session_student', 'session_id', 'student_id')
            ->withPivot('meter', 'grade')
            ->withTimestamps();
    }

    public function examday(): BelongsTo
    {
        return $this->belongsTo(Examday::class, 'exam_day_id');
    }
}
