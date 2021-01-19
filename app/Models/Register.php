<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Http\Models\Register;

class Register extends Model
{
    use HasFactory;

    protected $fillable = [
        'username','date-of-birth','email','password'
    ];

    // protected $hidden = [
    //     'password','remember_token',

    // ];
}
