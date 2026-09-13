<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sail\Console\PublishCommand;

class Payment extends Model
{
    protected $fillable=[
       'receipt_number',
        'student_id',
        'course_id',
        'payment_value',
        'collected_at',
        'surrendered_at',
        'surrendered_to',
        'entered_by',
        'payment_type',
        'payment_category',
        'note',
        'department_id',
        'discount',
    ];
       protected $casts = [
        'collected_at'   => 'date',
        'surrendered_at' => 'datetime',
        'discount' => 'decimal:2',
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }
public function scopeCoursePayments($query)
{
    return $query->where('payment_category', 'course');
}

// Scope for other payments
public function scopeOtherPayments($query)
{
    return $query->where('payment_category', '!=', 'course');
}
  public function surrenderedTo()
    {
        return $this->belongsTo(User::class, 'surrendered_to');
    }

    public function enteredBy()
    {
        return $this->belongsTo(User::class, 'entered_by');
    }


 public function scopePending($query)
    {
        return $query->whereNull('surrendered_at');
    }

    public function scopeSurrendered($query)
    {
        return $query->whereNotNull('surrendered_at');
    }



 public function getIsPendingAttribute(): bool
    {
        return is_null($this->surrendered_at);
    }

    public function getIsSurrenderedAttribute(): bool
    {
        return !is_null($this->surrendered_at);
    }

}
