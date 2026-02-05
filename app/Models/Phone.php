<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'price',
        'description',
        'color',
        'storage',
        'stockQuantity',
        'imgUrl',
        'specifications',
        'status_id'
    ];

    protected $casts = [
        'specifications' => 'array',
    ];

    public function status()
    {
        return $this->belongsTo(PhoneStatus::class, 'status_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
