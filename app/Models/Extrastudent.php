<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Extrastudent extends Model
{
    use HasFactory;
    protected $table = 'extra_student';
    protected $fillable = [
        'student_id',
        'engish_firstname',
        'engish_fathername',
        'english_lastname',

        'gender',
        'date_of_birth',
        'email',
        'telephone',
        'mobile',
        'address',
        'nationality',
        'notes',
        'mothername',
        'print_date',
        'cultural_level',
        'birth_date',

    ];


    public function student(): BelongsTo
    {
        return $this->belongsTo(student::class, 'student_id');
    }
     // Get age from the new `birth_date` column
    public function getAgeAttribute()
    {
        if (empty($this->birth_date)) {
            return null;
        }

        try {
            return Carbon::parse($this->birth_date)->age;
        } catch (\Exception $e) {
            return null;
        }
    }

    // Check eligibility (age >= 15)
    public function isCertificateEligible()
    {
        $age = $this->age;
        return $age !== null && $age >= 15;
    }

    // Display the full birth info: place + date (if you have both)
    public function getFullBirthInfoAttribute()
    {
        $parts = [];
        if ($this->birth_place) {
            $parts[] = $this->birth_place;
        }
        if ($this->birth_date) {
            $parts[] = Carbon::parse($this->birth_date)->format('d/m/Y');
        }
        return implode(' - ', $parts) ?: '—';
    }

}
