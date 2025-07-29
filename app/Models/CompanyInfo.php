<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'satisfaction',
        'experience',
        'customers',
        'repaired',

        'name',
        'email',
        'hotline',
        'whatsapp',
        'address',
        'shop_floor',
        'description',
        'map',
        'facebook',
        'instagram',
        'tiktok',
        'youtube',
        'logo',
        'favicon',
    ];
}
