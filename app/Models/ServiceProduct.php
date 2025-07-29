<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceProduct extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name', 'price', 'slug', 'type', 'brand', 'device', 'model', 'short_desp', 'long_desp', 'image', 'imageAlt'
    ];

    function rel_to_brand()
    {
        return $this->belongsTo(Brand::class, 'brand');
    }
    function rel_to_device()
    {
        return $this->belongsTo(Device::class, 'device');
    }
    function rel_to_type()
    {
        return $this->belongsTo(ServiceType::class, 'type');
    }
    function rel_to_model()
    {
        return $this->belongsTo(ServiceModel::class, 'model');
    }
}
