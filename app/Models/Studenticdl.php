<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Studenticdl extends Model
{
    use HasFactory;
    protected $table = 'student_icdl';
    protected $fillable = [
        'student_id',
        'skill_no',
        'employment',
        'test_language',
        'image',
        'password',
        'version',
        'croups',
        'exam_fee',
        'course_number'
    ];
    protected $primaryKey = false;


    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
