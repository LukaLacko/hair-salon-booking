<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'bio',
        'photo',
        'is_available'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function workingHours()
    {
        return $this->hasMany(WorkingHour::class);
    }
}
