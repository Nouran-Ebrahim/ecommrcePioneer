<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','email','phone','subject','message','user_id'];

    // relationship with user
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    // accessor for created at and updated at
    // public function getCreatedAtAttribute($value)
    // {
    //     return date('d-m-Y H:i:s a', strtotime($value));
    // }
    public function getUpdatedAtAttribute($value)
    {
        return date('d-m-Y H:i:s a', strtotime($value));
    }
}
