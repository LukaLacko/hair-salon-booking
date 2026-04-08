<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();

        $avgPrice = $services->avg('price');

        $avgDuration = $services->avg('duration_minutes');
        
        return view('admin.services', compact('services', 'avgPrice', 'avgDuration'));
    }

    public function store(Request $request)
    {
        if(empty($request->name) || empty($request->price) || empty($request->duration_minutes))
        {
            return redirect()->back()->with('error', 'Molim vas popunite sva obavezna polja!');
        }

        $service = new Service();
        $service->name = $request->name;
        $service->price = $request->price;
        $service->description = $request->description;
        $service->is_active = $request->has('is_active');
        $service->duration_minutes = $request->duration_minutes;
        $service->save();

        return redirect()->route('admin.usluge')->with('success', 'Uspešno dodata usluga!');
        
    }

    public function update(Request $request, $id)
    {
        if(empty($request->name) || empty($request->price) || empty($request->duration_minutes))
        {
            return redirect()->back()->with('error', 'Molim vas popunite sva obavezna polja!');
        }

        $service = Service::findOrFail($id);

        $service->name = $request->name;
        $service->price = $request->price;
        $service->description = $request->description;
        $service->is_active = $request->has('is_active');
        $service->duration_minutes = $request->duration_minutes;
        $service->save();

        return redirect()->back()->with('success', 'Uspešno izmenjena usluga!');

        
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        $service->delete();

        return redirect()->route('admin.usluge')->with('success', 'Uspešno obrisana usluga!');
    }
}
