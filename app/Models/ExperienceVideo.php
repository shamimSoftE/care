<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceVideo extends Model
{
    use HasFactory;


    protected $fillable = [
        'desp',
        'link',
    ];
}
