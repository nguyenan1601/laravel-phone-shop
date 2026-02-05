<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneStatus extends Model
{
    use HasFactory;

    protected $fillable = ['statusName'];

    public function phones()
    {
        return $this->hasMany(Phone::class, 'status_id');
    }
}
