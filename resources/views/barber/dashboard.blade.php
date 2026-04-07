<x-app-layout>
    @php
    // Hardcoded Stats - Change these values
    $totalBarbers = 8;
    $totalSessions = 342;
    $monthlyProfit = 28750;
    $lastSessionTime = '2:30 PM';
    
    // Hardcoded Barbers Data - Change these values
    $barbers = [
        ['name' => 'Marcus Johnson', 'status' => 'active', 'sessionsToday' => 7, 'totalEarnings' => 3850],
        ['name' => 'David Chen', 'status' => 'active', 'sessionsToday' => 5, 'totalEarnings' => 3200],
        ['name' => 'James Wilson', 'status' => 'on-break', 'sessionsToday' => 3, 'totalEarnings' => 2100],
        ['name' => 'Robert Taylor', 'status' => 'active', 'sessionsToday' => 6, 'totalEarnings' => 3500],
        ['name' => 'Michael Brown', 'status' => 'inactive', 'sessionsToday' => 0, 'totalEarnings' => 0],
        ['name' => 'Christopher Lee', 'status' => 'active', 'sessionsToday' => 8, 'totalEarnings' => 4200],
        ['name' => 'Daniel Garcia', 'status' => 'active', 'sessionsToday' => 4, 'totalEarnings' => 2800],
        ['name' => 'Matthew Martinez', 'status' => 'on-break', 'sessionsToday' => 2, 'totalEarnings' => 1500],
    ];
    
    // Hardcoded Sessions Data - Change these values
    $sessions = [
        ['customerName' => 'Alex Thompson', 'barberName' => 'Marcus Johnson', 'service' => 'Haircut & Beard Trim', 'date' => 'Apr 7, 2026', 'time' => '2:30 PM', 'price' => 45, 'status' => 'completed'],
        ['customerName' => 'Sarah Mitchell', 'barberName' => 'David Chen', 'service' => 'Premium Haircut', 'date' => 'Apr 7, 2026', 'time' => '2:00 PM', 'price' => 35, 'status' => 'completed'],
        ['customerName' => 'Kevin Park', 'barberName' => 'Christopher Lee', 'service' => 'Fade & Line Up', 'date' => 'Apr 7, 2026', 'time' => '1:30 PM', 'price' => 40, 'status' => 'completed'],
        ['customerName' => 'Emily Rodriguez', 'barberName' => 'Robert Taylor', 'service' => 'Kids Haircut', 'date' => 'Apr 7, 2026', 'time' => '3:00 PM', 'price' => 25, 'status' => 'scheduled'],
        ['customerName' => 'Brian Lee', 'barberName' => 'Daniel Garcia', 'service' => 'Haircut & Shave', 'date' => 'Apr 7, 2026', 'time' => '3:30 PM', 'price' => 50, 'status' => 'scheduled'],
        ['customerName' => 'Jessica Kim', 'barberName' => 'Marcus Johnson', 'service' => 'Haircut', 'date' => 'Apr 7, 2026', 'time' => '12:00 PM', 'price' => 30, 'status' => 'cancelled'],
    ];
    
    // Hardcoded Last Session Data - Change these values
    $lastSession = [
        'customerName' => 'Alex Thompson',
        'barberName' => 'Marcus Johnson',
        'service' => 'Haircut & Beard Trim',
        'date' => 'April 7, 2026',
        'time' => '2:30 PM',
        'price' => 45,
        'duration' => '45 min'
    ];
@endphp
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
            <p class="text-base-content/60">Monitor your barbershop's performance and activities</p>
        </div>

        {{-- Stats Cards --}}
        <div class="grid gap-4  md:grid-cols-2 lg:grid-cols-4">
            {{-- Total Barbers --}}
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <h2 class="card-title text-sm font-medium">Total Barbers</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold">{{ $totalBarbers }}</div>
                    <p class="text-xs opacity-60">Active team members</p>
                </div>
            </div>

            {{-- Total Sessions --}}
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <h2 class="card-title text-sm font-medium">Total Sessions</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold">{{ $totalSessions }}</div>
                    <p class="text-xs opacity-60">This month</p>
                </div>
            </div>

            {{-- Monthly Profit --}}
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <h2 class="card-title text-sm font-medium">Monthly Profit</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold">${{ number_format($monthlyProfit) }}</div>
                    <p class="text-xs opacity-60">+12.5% from last month</p>
                </div>
            </div>

            {{-- Last Session Time --}}
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <h2 class="card-title text-sm font-medium">Last Session</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold">{{ $lastSessionTime }}</div>
                    <p class="text-xs opacity-60">Most recent appointment</p>
                </div>
            </div>
        </div>

        {{-- Barbers Table & Last Session Details --}}
        <div class="grid gap-6 lg:grid-cols-3">
            {{-- Barbers Table --}}
            <div class="lg:col-span-2 min-w-0">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title">Barbers Overview</h2>
                        <div class="overflow-x-auto w-full">
                            <table class="table table-zebra w-full min-w-[500px]">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Sessions Today</th>
                                        <th class="text-right">Total Earnings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($barbers as $barber)
                                    <tr>
                                        <td class="font-medium">{{ $barber['name'] }}</td>
                                        <td>
                                            @if($barber['status'] === 'active')
                                                <span class="badge badge-success">active</span>
                                            @elseif($barber['status'] === 'on-break')
                                                <span class="badge badge-warning whitespace-nowrap">on-break</span>
                                            @else
                                                <span class="badge badge-ghost">inactive</span>
                                            @endif
                                        </td>
                                        <td class="text-center md:text-left">{{ $barber['sessionsToday'] }}</td>
                                        <td class="text-right">${{ number_format($barber['totalEarnings']) }}</td>
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
                        <h2 class="card-title">Last Session Details</h2>
                        
                        <div class="space-y-4">
                            {{-- Customer --}}
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium">Customer</p>
                                    <p class="text-sm opacity-60">{{ $lastSession['customerName'] }}</p>
                                </div>
                            </div>

                            {{-- Barber --}}
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium">Barber</p>
                                    <p class="text-sm opacity-60">{{ $lastSession['barberName'] }}</p>
                                </div>
                            </div>

                            {{-- Service --}}
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium">Service</p>
                                    <p class="text-sm opacity-60">{{ $lastSession['service'] }}</p>
                                </div>
                            </div>

                            {{-- Date --}}
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium">Date</p>
                                    <p class="text-sm opacity-60">{{ $lastSession['date'] }}</p>
                                </div>
                            </div>

                            {{-- Time & Duration --}}
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium">Time & Duration</p>
                                    <p class="text-sm opacity-60">{{ $lastSession['time'] }} ({{ $lastSession['duration'] }})</p>
                                </div>
                            </div>

                            {{-- Price --}}
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium">Price</p>
                                    <p class="text-sm opacity-60">${{ $lastSession['price'] }}</p>
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
                <h2 class="card-title">Recent Sessions</h2>
                
                <div class="overflow-x-auto">
                    <table class="table table-zebra">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Barber</th>
                                <th>Service</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                                <th class="text-right">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sessions as $session)
                            <tr>
                                <td class="font-medium">{{ $session['customerName'] }}</td>
                                <td>{{ $session['barberName'] }}</td>
                                <td>{{ $session['service'] }}</td>
                                <td>{{ $session['date'] }} at {{ $session['time'] }}</td>
                                <td>
                                    @if($session['status'] === 'completed')
                                        <span class="badge badge-primary">completed</span>
                                    @elseif($session['status'] === 'scheduled')
                                        <span class="badge badge-secondary">scheduled</span>
                                    @else
                                        <span class="badge badge-error">cancelled</span>
                                    @endif
                                </td>
                                <td class="text-right">${{ $session['price'] }}</td>
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
        Open drawer
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
        <li><a>Klijenti</a></li>
      </ul>
    </div>
  </div>


</x-app-layout>


