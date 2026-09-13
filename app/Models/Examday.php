<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use  App\Models\Scopes\DepartmentScope;


class Examday extends Model
{
    use HasFactory;
    protected $table = 'exam_days';
    protected $fillable = [
        'day_of_session',
        'session_scheduled_date',
        'session_request_date',
        'mater',
        'number_of_sessions',
        'session_time',
        'Status',
        'Value_Status',
        'teacher_name',
        'assigned_qa',
        'department_id'
    ];


    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class, 'exam_day_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
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
