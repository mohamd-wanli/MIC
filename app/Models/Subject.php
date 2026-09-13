<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use  App\Models\Scopes\DepartmentScope;


class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'section_id',
        'department_id'
    ];
 
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teachers_subjects');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class , 'department_id');
    }

    protected static function booted()
{
    static::addGlobalScope(new DepartmentScope);
}

protected static function boot()
{
    parent::boot();

    // تعيين department_id تلقائيًا عند إنشاء مستخدم جديد
    static::creating(function ($user) {
        // التحقق مما إذا كان المستخدم قد تم تسجيله بالفعل في الجلسة
        if ($user->department_id === null && request()->user()) {
            // تعيين department_id استنادًا إلى المستخدم المسجل
            $user->department_id = request()->user()->department_id;
        }
    });
}
}
