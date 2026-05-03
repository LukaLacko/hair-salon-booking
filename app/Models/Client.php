<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{


    use SoftDeletes;
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function nextAppointment()
    {
        return $this->hasOne(Appointment::class)
            ->where('start_time', '>', now())
            ->where('status', 'Potvrđeno')
            ->orderBy('start_time', 'asc');
    }
}
