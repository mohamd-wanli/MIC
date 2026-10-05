<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use  App\Models\Scopes\DepartmentScope;
use Exception;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Facades\Auth;
use Matrix\Builder;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
     protected $appends = ['certificate_eligible'];
    protected $fillable = [
        'firstname',
        'fathername',
        'lastname',
        'fullname',
        'national_number',
        'department_id',
    ];

    public function marks(): HasOne
    {
        return $this->hasOne(Student_mark::class, 'student_id');
    }

    public function Extrastudent(): HasOne
    {
        return $this->hasOne(Extrastudent::class, 'student_id');
    }

    public function Studenticdl(): HasOne
    {
        return $this->hasOne(Studenticdl::class);
    }
    public function sessions()
    {
        return $this->belongsToMany(Session::class, 'session_student', 'student_id', 'session_id')
            ->withPivot('meter', 'grade')
            ->withTimestamps();
    }

      public function tes(){
        return $this->belongsToMany(Course::class);
      }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'stucourse')->withPivot('sale','page_number', 'serial_number','year_number'
        ,'coursegrade','Student_id', 'printed_at','coursegrade')
            ->withTimestamps();
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'Student_id');
    }
     protected static function booted()
    {
       static::addGlobalScope('department', function (EloquentBuilder $builder) {
            $user = request()->user();

            // If no user logged in, return (for API or system calls)
                   if(!$user){
                    return ;
                   }

            // Admin sees everything
            if ($user->hasRole('Admin')) {
                return;
            }

            // If user has a department, filter students by courses in that department
            if ($user->department_id) {
                $builder->where(function (EloquentBuilder $query) use ($user) {
                    $query->where('department_id', $user->department_id)
                        ->orWhereHas('courses', function ($courseQuery) use ($user) {
                            $courseQuery->where('dep_id', $user->department_id);
                        });
                });
            }
        });
}


        public function Payments(){
    return $this->hasMany(Payment::class);
          }

public function getAge()
{
    return $this->Extrastudent?->age;
}

public function isCertificateEligible()
{
    return $this->Extrastudent?->isCertificateEligible() ?? false;
}

public function getBirthInfo()
{
    return $this->Extrastudent?->full_birth_info ?? '—';
}


    public function getCertificateEligibleAttribute()
    {
        return $this->isCertificateEligible();
    }


    }


