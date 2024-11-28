<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guarded = []; //must use fillable for security
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed' // to autmaticly has the password
    ];
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function hasAccess($config_permession)
    {
        $role = $this->role;

        foreach ($role->permessions as $permessionAdmin) {
            if ($config_permession == $permessionAdmin ?? false) {
                return true;
            }
            //$config_permession == $permessionAdmin ?? false this condtion to countinue looping if the permession is not found
        }
    }

}
