<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable , HasRoles;

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
     public function getDepartmentNameAttribute()
    {
        return $this->department?->name;
    }
    public function isAdmin()
    {
        return $this->hasRole('Admin');
    }
     public function scopeForDepartment($query, $departmentId = null)
    {
        if ($departmentId) {
            return $query->where('department_id', $departmentId);
        }
        return $query;
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     // تعيين department_id تلقائيًا عند إنشاء مستخدم جديد
    //     static::creating(function ($user) {
    //         // التحقق مما إذا كان المستخدم قد تم تسجيله بالفعل في الجلسة
    //         if ($user->department_id === null && request()->user()) {
    //             // تعيين department_id استنادًا إلى المستخدم المسجل
    //             $user->department_id = request()->user()->department_id;
    //         }
    //     });
    // }



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'roles_name',
        'Status',
        'department_id',
         'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'roles_name' => 'array',
        ];
    }
}
