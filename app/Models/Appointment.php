<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
    public function getDurationAttribute() : string
    {
        if(!$this->start_time || !$this->end_time){
            return 'N/A';
        }

        return $this->start_time->diffInMinutes($this->end_time) . ' min';
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
