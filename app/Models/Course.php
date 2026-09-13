<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use  App\Models\Scopes\DepartmentScope;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Matrix\Builder;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_id',
        'dep_id',
        'student_id',
        'teacher_id',
        'section_id',
        'subject_name',
        'price',
        'start_date',
        'end_date',
        'start_hour',
        'end_hour',
        'num_of_session',
        'days_of_course',
        'teacher_name',
        'department_id',
        'coursenumber',
        'note',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'stucourse')->withPivot('general_number', 'page_number',
        'certificate_number', 'note' ,'coursegrade','coursegrade','Student_id');
    }
     public function test(){
        return $this->belongsToMany(Student::class);
     }
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class );
    }

    protected static function booted()
{
     static::addGlobalScope('department', function (EloquentBuilder $builder) {
            $user = request()->user();

            // If no user logged in, return (for API or system calls)
            if (!$user) {
                return;
            }

            // Admin sees everything
            if ($user->hasRole('Admin')) {
                return;
            }

            // If user has a department, filter courses by department
            if ($user->department_id) {
                $builder->where('dep_id', $user->department_id);
            }
        });
}
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }

protected static function boot()
{
    parent::boot();

    static::creating(function ($user) {
        if ($user->department_id === null && request()->user()) {
            $user->department_id = request()->user()->department_id;
        }
    });
}
public function Payments(){
    return $this->hasMany(Payment::class);
}




}
