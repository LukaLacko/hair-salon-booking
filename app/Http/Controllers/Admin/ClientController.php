<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Laravel\Prompts\Clear;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');



        $clients = Client::query()
            ->when($search, function($query, $search){
                $query->where(function ($q) use ($search){
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhere('phone', 'Like', "%{$search}%")
                        ->orWhere('notes', 'LIKE', "%{$search}%");
                });
            })
            ->latest()
            ->get();
        
        $totalClients = Client::count();

        $totalClientsThisMonth = Client::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $thisMonth = ucfirst(now()->locale('sr')->translatedFormat('F'));
        $thisYear = now()->year;

        $totalWithNotes = Client::whereNotNull('notes')
            ->where('notes', '!=', '')
            ->count();

        $totalWithEmail = Client::whereNotNull('email')->count();

        return view('admin.clients', compact('clients', 'totalClients', 'thisMonth', 'thisYear', 'totalWithNotes', 'totalWithEmail', 'totalClientsThisMonth', 'search'));
    }

    public function store(Request $request)
    {
        if(empty($request->name))
        {
            return redirect()->back()->with('error', 'Morate uneti sva obavezna polja!');
        }

        $client = new Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->notes = $request->notes;
        $client->save();

        return redirect()->back()->with('success', 'Uspešno ste dodali novog klijenta!');
    }

    public function destroy($id)
    {
        $client = Client::findorFail($id);
        $client->delete();

        return redirect()->back()->with('success', 'Uspešno ste obrisali klijenta!');
    }

    public function update(Request $request, $id)
    {
        if(empty($request->name))
        {
            return redirect()->back()->with('error', 'Morate uneti sva obavezna polja!');
        }

        $client = Client::findorFail($id);
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->notes = $request->notes;
        $client->save();

        return redirect()->back()->with('success', 'Uspešno ste izmenili klijenta!');
    }
}
