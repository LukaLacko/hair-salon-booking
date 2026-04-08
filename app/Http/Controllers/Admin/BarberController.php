<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barber;
use App\Models\WorkingHour;
use Illuminate\Queue\Worker;

class BarberController extends Controller
{
    public function index()
    {
        $barbers = Barber::with('workingHours')->get();
        $totalBarbers = $barbers->count();

        $avgDaysOff = WorkingHour::where('is_day_off', true)
        ->count() / Barber::count();        

        return view('admin.barbers', compact('barbers', 'totalBarbers', 'avgDaysOff'));
    }

    public function store(Request $request)
    {
        if(empty($request->name) || empty($request->user_id))
        {
            return redirect()->back()->with('error', 'Molim vas popunite sva obavezna polja!');
        }

        $barber = new Barber();
        $barber->user_id = $request->user_id;
        $barber->name = $request->name;
        $barber->bio = $request->bio;
        $barber->photo = $request->photo;
        $barber->is_available = $request->has('is_active');
        $barber->save();

        foreach($request->working_hours as $wh){
            WorkingHour::create([
                'barber_id' => $barber->id,
                'day_of_the_week' => $wh['day_of_week'],
                'start_time' => $wh['is_day_off'] ?? false ? null : $wh ['start_time'],
                'end_time' => $wh['is_day_off'] ?? false ? null : $wh['end_time'],
                'is_day_off' => isset($wh['is_day_off']),
            ]);
        }

        return redirect()->back()->with('success', 'Uspešno ste dodali novog frizera.');

    }

    public function update(Request $request, $id)
{
    // 1. Validacija (bolje je koristiti $request->validate)
    if(empty($request->name) || empty($request->user_id)) {
        return redirect()->back()->with('error', 'Molim vas popunite sva obavezna polja!');
    }

    $barber = Barber::findOrFail($id);
    
    // 2. Ažuriranje osnovnih podataka
    $barber->update([
        'user_id' => $request->user_id,
        'name' => $request->name,
        'bio' => $request->bio,
        'photo' => $request->photo,
        'is_available' => $request->has('is_active'),
    ]);

    // 3. Ažuriranje radnog vremena
    foreach($request->working_hours as $index => $wh) {
        $barber->workingHours()->updateOrCreate(
            [
                // Po ovome tražimo postojeći zapis u bazi
                'day_of_the_week' => $wh['day_of_week'],
            ],
            [
                // Ovo su podaci koje unosimo ili menjamo
                'start_time' => isset($wh['is_day_off']) ? null : $wh['start_time'],
                'end_time'   => isset($wh['is_day_off']) ? null : $wh['end_time'],
                'is_day_off' => isset($wh['is_day_off']),
            ]
        );
    }

    return redirect()->back()->with('success', 'Frizer i radno vreme su uspešno sačuvani!');
}


    public function destroy($id)
    {
        $barber = Barber::findOrFail($id);

        $barber->delete();

        return redirect()->back()->with('success', 'Uspešno ste obrisali frizera.');
    }   
}
