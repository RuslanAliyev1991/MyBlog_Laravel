<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Navbar extends Model
{
    use HasFactory;
    protected $table = "navbars";
    protected $fillable=
    [
        'title',
        'content',
        'slug',
        'image',
        'order'
    ];
}