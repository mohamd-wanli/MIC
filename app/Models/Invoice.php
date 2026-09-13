<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use  App\Models\Scopes\DepartmentScope;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $fillable = [
        'course_id',
        'session_id',
        'Student_id',
        'course_name',
        'student_name',
        'payment_amount',
        'payment_date',
        'invoice_num',
        'payment_type',
        'department_id',
        'note',
        'session_name',
    ];

    public function getStudentIdAttribute()
    {
        return $this->attributes['Student_id'] ?? $this->attributes['student_id'] ?? null;
    }

    public function setStudentIdAttribute($value)
    {
        $this->attributes['Student_id'] = $value;
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(student::class, 'Student_id');
    }

    public function session()
{
    return $this->belongsTo(Session::class, 'session_id');
}

    public function course()
{
    return $this->belongsTo(Course::class, 'course_id');
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

    static::creating(function ($invoice) {  // Changed $user to $invoice
        if ($invoice->department_id === null && request()->user()) {
            $invoice->department_id = request()->user()->department_id;
        }
    });
}
}
