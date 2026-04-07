<x-app-layout>
<div class="drawer lg:drawer-open">
    <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex flex-col">
      <!-- Page content here -->
      {{-- Main Dashboard Content --}}
<div class="min-h-screen bg-base-200 p-6">
    <div class="mx-auto max-w-7xl space-y-6">
        
        {{-- Header --}}
        <div class="space-y-2">
            <h1 class="text-3xl font-bold">Admin Dashboard</h1>
            <p class="text-base-content/60">Prati učinak i aktivnosti svog salona</p>
        </div>

        {{-- Stats Cards --}}
        <div class="grid gap-4  md:grid-cols-2 lg:grid-cols-4">
            {{-- Total Barbers --}}
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <h2 class="card-title text-sm font-medium">Ukupno frizera</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold">{{ $totalBarbers }}</div>
                    <p class="text-xs opacity-60">Aktivni članovi tima</p>
                </div>
            </div>

            {{-- Total Sessions --}}
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <h2 class="card-title text-sm font-medium">Ukupno termina</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold">{{ $monthlyAppointments }}</div>
                    <p class="text-xs opacity-60">Ovog meseca</p>
                </div>
            </div>

            {{-- Monthly Profit --}}
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <h2 class="card-title text-sm font-medium">Mesečni profit</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold">${{ number_format($monthlyProfit) }}</div>
                    <p class="text-xs opacity-60 {{ $profitChange >= 0 ? "text-success font-bold" : "text-error font-bold" }}">{{ $profitChange >= 0 ? '↑ +' : '↓ ' }}{{ number_format($profitChange, 0) }}% od prošlog meseca</p>
                </div>
            </div>

            {{-- Last Session Time --}}
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <h2 class="card-title text-sm font-medium">Poslednji Termin</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($lastAppointment->end_time)->format('H:i')}}</div>
                    <p class="text-xs opacity-60">Poslednji zakazan termin</p>
                </div>
            </div>
        </div>

        {{-- Barbers Table & Last Session Details --}}
        <div class="grid gap-6 lg:grid-cols-3">
            {{-- Barbers Table --}}
            <div class="lg:col-span-2 min-w-0">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title">Pregled Frizera</h2>
                        <div class="overflow-x-auto w-full">
                            <table class="table table-zebra w-full min-w-[500px]">
                                <thead>
                                    <tr>
                                        <th>Ime</th>
                                        <th>Status</th>
                                        <th>Ukupno odradjenih termina</th>
                                        <th class="text-right">Ukupno prihoda</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($barbers as $barber)
                                    <tr>
                                        <td class="flex font-bold">
                                            <div class="avatar">
                                                <div class="mask mask-squircle h-12 w-12">
                                                  <img
                                                  src="{{ $barber->photo ? asset('storage/' . $barber->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($barber->name) }}"                                                    alt="Avatar Tailwind CSS Component" />
                                                </div>
                                            </div>
                                            <p class="pl-4">
                                                {{ $barber['name'] }}
                                            </p>                                            
                                        </td>
                                        <td>
                                            @if($barber->is_available == true)
                                                <span class="badge badge-success">aktivan</span>
                                            @else
                                                <span class="badge badge-ghost">neaktivan</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $barber->appointments_count }}</td>
                                        <td class="text-right font-bold">${{ number_format($barber->total_profit) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Last Session Details --}}
            <div>
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title">Detalji poslednjeg termina</h2>
                        
                        <div class="space-y-4">
                            {{-- Customer --}}
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium">Klijent</p>
                                    <p class="text-sm opacity-60">{{ $lastAppointment->client->name }}</p>
                                </div>
                            </div>

                            {{-- Barber --}}
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium">Frizer</p>
                                    <p class="text-sm opacity-60">{{ $lastAppointment->barber->name }}</p>
                                </div>
                            </div>

                            {{-- Service --}}
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium">Usluga</p>
                                    <p class="text-sm opacity-60">{{ $lastAppointment->service->name }}</p>
                                </div>
                            </div>

                            {{-- Date --}}
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium">Datum</p>
                                    <p class="text-sm opacity-60">{{ \Carbon\Carbon::parse($lastAppointment->end_time)->format('d.m.Y ') }}</p>
                                </div>
                            </div>

                            {{-- Time & Duration --}}
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium">Vreme i trajanje</p>
                                    <p class="text-sm opacity-60">
                                        {{ \Carbon\Carbon::parse($lastAppointment->start_time)->format('H:i') }} - 
                                        {{ \Carbon\Carbon::parse($lastAppointment->end_time)->format('H:i') }} 
                                        
                                        ({{ \Carbon\Carbon::parse($lastAppointment->start_time)->diff(\Carbon\Carbon::parse($lastAppointment->end_time))->forHumans(['short' => true, 'parts' => 2]) }})
                                    </p>
                                </div>
                            </div>

                            {{-- Price --}}
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium">Cena</p>
                                    <p class="text-sm opacity-60">{{ number_format($lastAppointment->price, 0, ',', '.')}} din</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Sessions Table --}}
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Nedavni termini</h2>
                
                <div class="overflow-x-auto">
                    <table class="table table-zebra">
                        <thead>
                            <tr>
                                <th>Klijent</th>
                                <th>Frizer</th>
                                <th>Usluga</th>
                                <th>Datum</th>
                                <th>Vreme & Trajanje</th>
                                <th>Status</th>
                                <th class="text-right">Cena</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                            <tr>
                                <td class="font-bold">{{ $appointment->client->name }}</td>
                                <td class="font-medium">{{ $appointment->barber->name }}</td>
                                <td> <span class="badge badge-soft badge-neutral font-bold">{{ $appointment->service->name }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($appointment->end_time)->format('d.m.Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($appointment->end_time)->format('H:i')}} ({{\Carbon\Carbon::parse($appointment->start_time)->diff(\Carbon\Carbon::parse($appointment->end_time))->forHumans(['short' => true, 'parts' => 2]) }})</td>
                                <td>
                                    @if($appointment['status'] === 'Završeno')
                                        <span class="badge badge-success font-bold">završeno</span>
                                    @elseif($appointment['status'] === 'Potvrđeno')
                                        <span class="badge badge-warning font-bold">potvrđeno</span>
                                    @else
                                        <span class="badge badge-error font-bold">otkazano</span>
                                    @endif
                                </td>
                                <td class="text-right font-bold">{{ number_format($appointment->price, '0', ',', '.') }} din</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
      <label for="my-drawer-3" class="btn drawer-button lg:hidden">
        Pogledaj Sidebar
      </label>
    </div>
    <div class="drawer-side">
      <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
      <ul class="menu bg-base-300 min-h-full w-80 p-4">
        <!-- Sidebar content here -->
        <li><a>Dashboard</a></li>
        <li><a>Usluge</a></li>
        <li><a>Frizeri</a></li>
        <li><a>Termini</a></li>

        <div class="flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <div>
                <li><a class="text-sm font-medium">Klijenti</a></li>
            </div>
        </div>  

       </ul>
    </div>
  </div>


</x-app-layout>


