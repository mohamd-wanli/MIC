<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stucourse extends Model
{
    use SoftDeletes;

    protected $table = 'stucourse';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'student_id',
         'course_id',
         'page_number',
         'general_number',
         'grade',
         'coursegrade',
         'result',
         'year_number',
         'serial_number',
         'printed_at',
         'note',




        ];
}
