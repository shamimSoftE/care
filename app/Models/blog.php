<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class blog extends Model
{
    use HasFactory,SoftDeletes;

    function rel_to_user()
    {
        return $this->belongsTo(User::class, 'addedBy');
    }
    function rel_to_category()
    {
        return $this->belongsTo(category::class, 'category');
    }

    protected $fillable = [
        'title',
        'category',
        'short_desp',
        'long_desp',
        'imageAlt',
        'image',
        'date',
        'type',
        'publishDate',
        'slug',
        'addedBy',
    ];
}
