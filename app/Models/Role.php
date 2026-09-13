<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_role' , 'department_id' , 'role_id');
    }
}
