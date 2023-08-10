<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'merk',
        'type',
        'license_plate',
        'color',
        'year',
    ];

    //scope
    public function scopeSearch($query, $val)
    {
        return $query->where('merk', 'like', '%' . $val . '%')
            ->orWhere('type', 'like', '%' . $val . '%')
            ->orWhere('license_plate', 'like', '%' . $val . '%')
            ->orWhere('color', 'like', '%' . $val . '%')
            ->orWhere('year', 'like', '%' . $val . '%');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
