<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name'];

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'department_role' , 'department_id' , 'role_id');
    }
      public function courses()
    {
        return $this->hasMany(Course::class, 'dep_id');
    }

    // Get department name
    public function getDisplayNameAttribute()
    {
        return $this->name;
    }


    public function Payments(){
    return $this->hasMany(Payment::class);
}
}
