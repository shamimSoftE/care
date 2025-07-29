<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceModel extends Model
{
    use HasFactory, SoftDeletes;
    function rel_to_device()
    {
        return $this->belongsTo(Device::class, 'device');
    }
    function rel_to_product()
    {
        return $this->hasMany(ServiceProduct::class, 'model');
    }
    protected $fillable = [
        'device',
        'name',
    ];
}
