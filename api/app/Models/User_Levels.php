<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Levels extends Model
{
    //
    use HasFactory;

    protected $table = 'user_levels';

    protected $fillable = [
        'user_id',
        'level_id',
    ];

    //relacionamento com user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //relacionamento com levels
    public function levels()
    {
        return $this->belongsTo(Levels::class, 'level_id', 'id');
    }
}
