<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['id', 'name', 'email', 'phone', 'subject', 'message', 'user_id'];

    // relationship with user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // accessor for created at and updated at
    // public function getCreatedAtAttribute($value)
    // {
    //     return date('d-m-Y H:i:s a', strtotime($value));
    // }
    public static function searchContacts($keyword)
    {
        return self::when($keyword != null, function ($query) use ($keyword) {
            $query->where('email', 'like', '%' . $keyword . '%');
        });

    }
    public function getUpdatedAtAttribute($value)
    {
        return date('d-m-Y H:i:s a', strtotime($value));
    }
}
