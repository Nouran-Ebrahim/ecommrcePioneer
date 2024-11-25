<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Role extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded = [];
    public $translatable = ['role'];
    public function getPermessionsAttribute($value)
    {
        return json_decode($value);
    }

    public function admins()
    {
        return $this->hasMany(Admin::class , 'role_id');
    }
}
