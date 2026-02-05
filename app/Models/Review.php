<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'phone_id',
        'rating',
        'description',
        'reviewDate'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function phone()
    {
        return $this->belongsTo(Phone::class);
    }
}
