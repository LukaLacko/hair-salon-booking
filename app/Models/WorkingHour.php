<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    protected $fillable = [
        'barber_id',
        'day_of_the_week',
        'start_time',
        'end_time',
        'is_day_off'
    ];

    public function getDayNameAttribute()
{
    $days = [
        0 => 'Nedelja',
        1 => 'Ponedeljak',
        2 => 'Utorak',
        3 => 'Sreda',
        4 => 'Četvrtak',
        5 => 'Petak',
        6 => 'Subota'
    ];

    return $days[$this->day_of_the_week] ?? 'Nepoznato';
}
    public function barber()
    {
        return $this->belongsTo(Barber::class); 
    }

}
