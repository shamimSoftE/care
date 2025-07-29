<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermAndPrivacy extends Model
{
    use HasFactory;
    protected $fillable = [
        'term' ,
        'privacy',
    ];
}
