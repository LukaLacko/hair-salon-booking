<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar-gradient {
            background: linear-gradient(180deg, #1f2937 0%, #111827 100%);
        }
        .client-card {
            transition: all 0.2s;
        }
        .client-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .loyalty-badge {
            font-size: 0.7rem;
            padding: 2px 6px;
        }
    </style>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 sidebar-gradient text-white flex flex-col shadow-xl hidden md:flex">
            <!-- Branded Header -->
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center shadow-lg">
                        <i class="fas fa-cut text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">Frizerski Salon</h1>
                        <p class="text-xs text-gray-400">Frizerski Portal</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <a href="{{ route('barber.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 text-gray-300 hover:text-white transition-all">
                    <i class="fas fa-home w-5"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="{{ route('barber.raspored') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 text-gray-300 hover:text-white transition-all">
                    <i class="fas fa-calendar-alt w-5"></i>
                    <span>Moj Raspored</span>
                </a>
                <a href="{{ route('barber.klijenti') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary/20 text-white border-l-4 border-primary">
                    <i class="fas fa-users w-5"></i>
                    <span>Moji Klijenti</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 text-gray-300 hover:text-white transition-all">
                    <i class="fas fa-chart-line w-5"></i>
                    <span>Učinak</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 text-gray-300 hover:text-white transition-all">
                    <i class="fas fa-clock w-5"></i>
                    <span>Radni Sati</span>
                </a>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-gray-700">
                <div class="flex items-center gap-3 px-2 py-2">
                    <div class="avatar online">
                        <div class="w-10 rounded-full">
                            <img
                            src="{{ $barber->photo ? asset('storage/' . $barber->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($barber->name) }}" alt="Avatar Tailwind CSS Component" />
                        </div>  
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-sm truncate">{{ $barber->name }}</p>
                        <p class="text-xs text-gray-400">Frizer</p>
                    </div>
                    <button class="btn btn-ghost btn-xs btn-circle">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Moji Klijenti</h2>
                        <p class="text-sm text-gray-500">
                            <i class="far fa-calendar"></i>
                            Upravljaj podacima klijenta
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="form-control">
                            <div class="input-group input-group-sm">
                                <input type="text" placeholder="Pretraži klijente..." class="input input-bordered input-sm w-64" />
                                <button class="btn btn-square btn-sm">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm" onclick="document.getElementById('add_client_modal').showModal()">
                            <i class="fas fa-user-plus"></i>
                            Dodaj Klijenta
                        </button>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="stats shadow bg-white">
                        <div class="stat">
                            <div class="stat-figure text-primary">
                                <i class="fas fa-users text-3xl"></i>
                            </div>
                            <div class="stat-title">Ukupno Klijenata</div>
                            <div class="stat-value text-primary">{{ $myTotalClients }}</div>
                            <div class="stat-desc">↗︎ {{ $newClientsThisMonthCount }} novih ovog meseca</div>
                        </div>
                    </div>

                    <div class="stats shadow bg-white">
                        <div class="stat">
                            <div class="stat-figure text-success">
                                <i class="fas fa-star text-3xl"></i>
                            </div>
                            <div class="stat-title">VIP Klijenti</div>
                            <div class="stat-value text-success">{{ $vipClients->count() }}</div>
                            <div class="stat-desc">3+ posete ovog meseca ili</div>
                            <div class="stat-desc">+15.000 din potrošeno ovog meseca</div>
                        </div>
                    </div>

                    <div class="stats shadow bg-white">
                        <div class="stat">
                            <div class="stat-figure text-info">
                                <i class="fas fa-calendar-check text-3xl"></i>
                            </div>
                            <div class="stat-title">Aktivni Ovog Meseca</div>
                            <div class="stat-value text-info">{{ $countActiveClientsThisMonth }}</div>
                            <div class="stat-desc">{{ $activeClientsPercentage }}% od ukupno klijenata</div>
                        </div>
                    </div>

                    <div class="stats shadow bg-white">
                        <div class="stat">
                            <div class="stat-figure text-warning">
                                <i class="fas fa-exclamation-triangle text-3xl"></i>
                            </div>
                            <div class="stat-title">U riziku</div>
                            <div class="stat-value text-warning">{{ $riskyClients->count() }}</div>
                            <div class="stat-desc">Bez posete poslednjih 60+ dana</div>
                        </div>
                    </div>
                </div>

                <!-- Quick Filters & Top Client -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Quick Filters -->
                    <div class="lg:col-span-2">
                        <div class="card bg-white shadow-xl">
                            <div class="card-body">
                                <h3 class="card-title mb-4">
                                    <i class="fas fa-filter"></i>
                                    Brza Pretraga
                                </h3>
                                <div class="flex flex-wrap gap-2">
                                    <button class="btn btn-sm btn-primary">
                                        <i class="fas fa-users"></i>
                                        Svi Klijenti ({{ $myTotalClients }})
                                    </button>
                                    <button class="btn btn-sm btn-outline">
                                        <i class="fas fa-star"></i>
                                        VIP ({{ $vipClients->count() }})
                                    </button>
                                    <button class="btn btn-sm btn-outline">
                                        <i class="fas fa-user-plus"></i>
                                        Novi ({{ $newClientsThisMonthCount }})
                                    </button>
                                    <button class="btn btn-sm btn-outline">
                                        <i class="fas fa-fire"></i>
                                        Aktivni ({{ $countActiveClientsThisMonth }})
                                    </button>
                                    <button class="btn btn-sm btn-outline">
                                        <i class="fas fa-clock"></i>
                                        Neaktivni ({{ $inactiveClients->count() }})
                                    </button>
                                    <button class="btn btn-sm btn-outline">
                                        <i class="fas fa-exclamation-circle"></i>
                                        U Riziku ({{ $riskyClients->count() }})
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Top Client Card -->
                    <div class="lg:col-span-1">
                        <div class="card bg-gradient-to-br from-primary to-secondary text-white shadow-xl">
                            <div class="card-body">
                                <h3 class="card-title text-white text-sm mb-3">
                                    <i class="fas fa-trophy"></i>
                                    Najbolji Klijent Ovog Meseca
                                </h3>
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="w-12 rounded-full ring ring-warning ring-offset-2">
                                            <img src="https://ui-avatars.com/api/?name=Mike+Johnson&background=FFC107&color=000" alt="Client">
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-bold">{{ $bestClientThisMonth->client?->name ?? 'Nema podataka' }}</p>
                                        @if ($bestClientThisMonth)
                                            <p class="text-xs opacity-90">{{ $bestClientThisMonth->total_visits }} visits • {{ number_format($bestClientThisMonth->total_spent, 0, ',', '.') }} din</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Client List -->
                <div class="card bg-white shadow-xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="card-title">
                                <i class="fas fa-address-book"></i>
                                Lista Klijenata
                            </h3>
                            <div class="flex items-center gap-2">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-active">
                                        <i class="fas fa-th-list"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="table table-zebra">
                                <thead>
                                    <tr>
                                        <th>Klijent</th>
                                        <th>Kontakt</th>
                                        <th>Status</th>
                                        <th>Poslednji Termin</th>
                                        <th>Ukupno Termina</th>
                                        <th>Prihod</th>
                                        <th>Sledeci Termin</th>
                                        <th>Opcije</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allClients as $appointment )
                                        @if ($vipClients->contains('client_id', $appointment->client_id))
                                             <!-- VIP Client -->
                                            <tr class="hover">
                                                <td>
                                                    <div class="flex items-center gap-3">
                                                        <div class="avatar">
                                                            <div class="w-10 rounded-full">
                                                                <img src="https://ui-avatars.com/api/?name=Mike+Johnson&background=0D8ABC&color=fff" alt="Client">
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-bold">{{ $appointment->client->name }}</div>
                                                            <div class="flex gap-1 mt-1">
                                                                <span class="badge badge-warning badge-xs loyalty-badge">
                                                                    <i class="fas fa-crown"></i> VIP
                                                                </span>
                                                                <span class="badge badge-success badge-xs loyalty-badge">Loyal</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-sm">
                                                        <div><i class="fas fa-phone text-primary"></i>{{ $appointment->client?->phone ?? "Broj nepoznat" }}</div>
                                                        <div class="text-xs text-gray-500"><i class="fas fa-envelope"></i>  {{ $appointment->client?->email ?? "Email nepoznat" }}</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success badge-sm">
                                                        <i class="fas fa-check-circle"></i> Aktivan
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="text-sm">
                                                        <div class="font-semibold">{{ \Carbon\Carbon::parse($appointment->last_visit_date)->locale('sr')->diffForHumans() }}</div>
                                                        <div class="text-xs text-gray-500">
                                                            {{ \Carbon\Carbon::parse($appointment->last_visit_date)->locale('sr')->translatedFormat('d. M Y.') }}
                                                        </div>                                                    
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="font-bold text-primary">{{ $appointment->total_visits }}</div>
                                                </td>
                                                <td>
                                                    <div class="font-bold text-success">{{ number_format($appointment->total_spent, 0, ',', '.')}} din</div>
                                                </td>
                                                <td>
                                                    <div class="text-sm">
                                                        <div class="font-semibold text-primary">{{ $appointment->client->nextAppointment?->start_time->locale('sr')->diffForHumans() ?? "Nema zakazano" }}</div>
                                                        <div class="text-xs text-gray-500">{{ $appointment->client->nextAppointment?->start_time->locale('sr')->translatedFormat('d. M Y.') ?? ""}}</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="flex gap-1">
                                                        <button class="btn btn-ghost btn-xs" onclick="document.getElementById('client_details_{{ $appointment->client_id }}').showModal()">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-ghost btn-xs">
                                                            <i class="fas fa-calendar-plus"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @elseif ($activeClients->contains('client_id', $appointment->client_id))
                                        <!-- Active Client -->
                                            <tr class="hover">
                                                <td>
                                                    <div class="flex items-center gap-3">
                                                        <div class="avatar">
                                                            <div class="w-10 rounded-full">
                                                                <img src="https://ui-avatars.com/api/?name=Sarah+Williams&background=E91E63&color=fff" alt="Client">
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-bold">{{ $appointment->client->name }}</div>
                                                            <div class="flex gap-1 mt-1">
                                                                <span class="badge badge-info badge-xs loyalty-badge">Regular</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-sm">
                                                        <div><i class="fas fa-phone text-primary"></i>{{ $appointment->client?->phone ?? "Broj nepoznat" }}</div>
                                                        <div class="text-xs text-gray-500"><i class="fas fa-envelope"></i> {{ $appointment->client?->email ?? "Email nepoznat" }}</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success badge-sm">
                                                        <i class="fas fa-check-circle"></i> Aktivan
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="text-sm">
                                                        <div class="font-semibold">{{ \Carbon\Carbon::parse($appointment->last_visit_date)->locale('sr')->diffForHumans() }}</div>
                                                        <div class="text-xs text-gray-500">
                                                            {{ \Carbon\Carbon::parse($appointment->last_visit_date)->locale('sr')->translatedFormat('d. M Y.') }}
                                                        </div>                                                    
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="font-bold text-primary">{{ $appointment->total_visits }}</div>
                                                </td>
                                                <td>
                                                    <div class="font-bold text-success">{{ number_format($appointment->total_spent, 0, ',', '.')}} din</div>
                                                </td>
                                                <td>
                                                    <div class="text-sm">
                                                        <div class="font-semibold text-primary">{{ $appointment->client->nextAppointment?->start_time->locale('sr')->diffForHumans() ?? "Nema zakazano" }}</div>
                                                        <div class="text-xs text-gray-500">{{ $appointment->client->nextAppointment?->start_time->locale('sr')->translatedFormat('d. M Y.') ?? ""}}</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="flex gap-1">
                                                        <button class="btn btn-ghost btn-xs" onclick="document.getElementById('client_details_{{ $appointment->client_id }}').showModal()">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-ghost btn-xs">
                                                            <i class="fas fa-calendar-plus"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @elseif ($newClientsThisMonth->contains('client_id', $appointment->client_id))
                                            <!-- New Client -->
                                            <tr class="hover">
                                                <td>
                                                    <div class="flex items-center gap-3">
                                                        <div class="avatar">
                                                            <div class="w-10 rounded-full">
                                                                <img src="https://ui-avatars.com/api/?name=Robert+Chen&background=9C27B0&color=fff" alt="Client">
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-bold">{{ $appointment->client->name }}</div>
                                                            <div class="flex gap-1 mt-1">
                                                                <span class="badge badge-primary badge-xs loyalty-badge">
                                                                    <i class="fas fa-star"></i> Nov
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-sm">
                                                        <div><i class="fas fa-phone text-primary"></i> {{ $appointment->client?->phone ?? "Broj nepoznat" }}</div>
                                                        <div class="text-xs text-gray-500"><i class="fas fa-envelope"></i> {{ $appointment->client?->email ?? "Email nepoznat" }}</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info badge-sm">
                                                        <i class="fas fa-sparkles"></i> Nov
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="text-sm">
                                                        <div class="font-semibold">{{ \Carbon\Carbon::parse($appointment->last_visit_date)->locale('sr')->diffForHumans() }}</div>
                                                        <div class="text-xs text-gray-500">
                                                            {{ \Carbon\Carbon::parse($appointment->last_visit_date)->locale('sr')->translatedFormat('d. M Y.') }}
                                                        </div>                                                    
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="font-bold text-primary">{{ $appointment->total_visits }}</div>
                                                </td>
                                                <td>
                                                    <div class="font-bold text-success">{{ number_format($appointment->total_spent, 0, ',', '.')}} din</div>
                                                </td>
                                                <td>
                                                    <div class="text-sm">
                                                        <div class="font-semibold text-primary">{{ $appointment->client->nextAppointment?->start_time->locale('sr')->diffForHumans() ?? "Nema zakazano" }}</div>
                                                        <div class="text-xs text-gray-500">{{ $appointment->client->nextAppointment?->start_time->locale('sr')->translatedFormat('d. M Y.') ?? ""}}</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="flex gap-1">
                                                        <button class="btn btn-ghost btn-xs" onclick="document.getElementById('client_details_{{ $appointment->client_id }}').showModal()">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-ghost btn-xs">
                                                            <i class="fas fa-calendar-plus"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @elseif($riskyClients->contains('client_id', $appointment->client_id))
                                            <!-- At Risk Client -->
                                            <tr class="hover">
                                                <td>
                                                    <div class="flex items-center gap-3">
                                                        <div class="avatar">
                                                            <div class="w-10 rounded-full">
                                                                <img src="https://ui-avatars.com/api/?name=David+Martinez&background=FF5722&color=fff" alt="Client">
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-bold">{{ $appointment->client->name }}</div>
                                                            <div class="flex gap-1 mt-1">
                                                                <span class="badge badge-warning badge-xs loyalty-badge">Rizičan</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-sm">
                                                        <div><i class="fas fa-phone text-primary"></i> {{ $appointment->client?->phone ?? "Broj nepoznat" }}</div>
                                                        <div class="text-xs text-gray-500"><i class="fas fa-envelope"></i> {{ $appointment->client?->email ?? "Email nepoznat" }}</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-warning badge-sm">
                                                        <i class="fas fa-exclamation-triangle"></i> Rizičan
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="text-sm">
                                                        <div class="font-semibold">{{ \Carbon\Carbon::parse($appointment->last_visit_date)->locale('sr')->diffForHumans() }}</div>
                                                        <div class="text-xs text-gray-500">
                                                            {{ \Carbon\Carbon::parse($appointment->last_visit_date)->locale('sr')->translatedFormat('d. M Y.') }}
                                                        </div>                                                    
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="font-bold text-primary">{{ $appointment->total_visits }}</div>
                                                </td>
                                                <td>
                                                    <div class="font-bold text-success">{{ number_format($appointment->total_spent, 0, ',', '.')}} din</div>
                                                </td>
                                                <td>
                                                    <div class="text-sm">
                                                        <div class="font-semibold text-primary">{{ $appointment->client->nextAppointment?->start_time->locale('sr')->diffForHumans() ?? "Nema zakazano" }}</div>
                                                        <div class="text-xs text-gray-500">{{ $appointment->client->nextAppointment?->start_time->locale('sr')->translatedFormat('d. M Y.') ?? "-"}}</div>                                                    
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="flex gap-1">
                                                        <button class="btn btn-ghost btn-xs" onclick="document.getElementById('client_details_{{ $appointment->client_id }}').showModal()">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-warning btn-xs">
                                                            <i class="fas fa-phone"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @elseif($inactiveClients->contains('client_id', $appointment->client_id))
                                            <!-- Inactive Client -->
                                            <tr class="hover opacity-60">
                                                <td>
                                                    <div class="flex items-center gap-3">
                                                        <div class="avatar">
                                                            <div class="w-10 rounded-full">
                                                                <img src="https://ui-avatars.com/api/?name=Tom+Anderson&background=607D8B&color=fff" alt="Client">
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-bold">{{ $appointment->client->name }}</div>
                                                            <div class="flex gap-1 mt-1">
                                                                <span class="badge badge-ghost badge-xs loyalty-badge">Neaktivan</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-sm">
                                                        <div><i class="fas fa-phone text-primary"></i> {{ $appointment->client?->phone ?? "Broj nepoznat"}}</div>
                                                        <div class="text-xs text-gray-500"><i class="fas fa-envelope"></i>{{ $appointment->client?->email ?? "Email nepoznat" }}</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-ghost badge-sm">
                                                        <i class="fas fa-circle"></i> Neaktivan
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="text-sm">
                                                        <div class="font-semibold">{{ \Carbon\Carbon::parse($appointment->last_visit_date)->locale('sr')->diffForHumans() }}</div>
                                                        <div class="text-xs text-gray-500">
                                                            {{ \Carbon\Carbon::parse($appointment->last_visit_date)->locale('sr')->translatedFormat('d. M Y.') }}
                                                        </div>                                                    
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="font-bold text-primary">{{ $appointment->total_visits }}</div>
                                                </td>
                                                <td>
                                                    <div class="font-bold text-success">{{ number_format($appointment->total_spent, 0, ',', '.')}} din</div>
                                                </td>
                                                <td>
                                                    <div class="text-sm text-gray-500">
                                                        <div>Not scheduled</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="flex gap-1">
                                                        <button class="btn btn-ghost btn-xs" onclick="document.getElementById('client_details_{{ $appointment->client_id }}').showModal()">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-ghost btn-xs">
                                                            <i class="fas fa-redo"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif

                                    @endforeach
                        <!-- Pagination -->
                        <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200">
                            <div class="text-sm text-gray-500">
                                Prikazano {{ $allClients->firstItem() }} do {{ $allClients->lastItem() }} od {{ $allClients->count() }} Klijenata
                            </div>
                            <div class="join">
                                @if ($allClients->onFirstPage())
                                    <button class="join-item btn btn-sm btn-disabled">«</button>
                                @else
                                    <a href="{{ $allClients->previousPageUrl() }}" class="join-item btn btn-sm">«</a>
                                @endif
                            
                                <button class="join-item btn btn-sm btn-active">Strana {{ $allClients->currentPage() }}</button>
                            
                                @if ($allClients->hasMorePages())
                                    <a href="{{ $allClients->nextPageUrl() }}" class="join-item btn btn-sm">»</a>
                                @else
                                    <button class="join-item btn btn-sm btn-disabled">»</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Client Details Modal -->
    @foreach ($allClients as $appointment)
    <dialog id="client_details_{{ $appointment->client_id }}" class="modal">
            
        <div class="modal-box max-w-4xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg mb-4">
                <i class="fas fa-user-circle text-primary"></i>
                Detalji Klijenta
            </h3>

            <!-- Client Header -->
            <div class="flex items-center gap-4 p-4 bg-gradient-to-r from-primary/10 to-secondary/10 rounded-lg mb-6">
                <div class="avatar">
                    <div class="w-20 rounded-full ring ring-primary ring-offset-2">
                        <img src="https://ui-avatars.com/api/?name=Mike+Johnson&background=0D8ABC&color=fff" alt="Client">
                    </div>
                </div>
                <div class="flex-1">
                    <h4 class="text-xl font-bold">{{ $appointment->client->name }}</h4>
                    <p class="text-sm text-gray-500">Klijent od {{ ucfirst($appointment->client->created_at->locale('sr')->translatedFormat('M Y')) }}</p>
                    <div class="flex gap-2 mt-2">
                    @if ($vipClients->contains('client_id', $appointment->client_id))
                        <span class="badge badge-warning">
                            <i class="fas fa-crown mr-1"></i> VIP
                        </span>
                    @elseif($newClientsThisMonth->contains('client_id', $appointment->client_id))
                        <span class="badge badge-primary">
                            <i class="fas fa-star"></i> Nov
                        </span>
                    @elseif($activeClients->contains('client_id', $appointment->client_id))
                        <span class="badge badge-success">
                            <i class="fas fa-check-circle"></i> Aktivan
                        </span>                    
                    @elseif($inactiveClients->contains('client_id', $appointment->client_id))
                        <span class="badge badge-ghost">
                            <i class="fas fa-circle"></i> Neaktivan
                        </span>
                    @elseif($riskyClients->contains('client_id', $appointment->client_id))
                        <span class="badge badge-warning">
                            <i class="fas fa-exclamation-triangle"></i> Rizičan
                        </span>

                    @endif
                        <span class="badge badge-success">Loyal Customer</span>
                    </div>
                </div>
                <div class="text-right">
                    <div class="stat-value text-primary">{{ number_format($appointment->total_spent, 0, ',', '.') }} din</div>
                    <div class="text-sm text-gray-500">Ukupna Potrošnja</div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="tabs tabs-boxed mb-4">
                <a class="tab tab-active">Overview</a>
                <a class="tab">History</a>
                <a class="tab">Notes</a>
            </div>

            <!-- Content -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Contact Info -->
                <div class="space-y-4">
                    <h5 class="font-bold text-sm text-gray-600 uppercase">Kontakt Informacije</h5>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-phone text-primary w-5"></i>
                            <div>
                                <div class="text-sm text-gray-500">Telefon</div>
                                <div class="font-semibold">{{ $appointment->client?->phone ?? "Broj nepoznat" }}</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-envelope text-primary w-5"></i>
                            <div>
                                <div class="text-sm text-gray-500">Email</div>
                                <div class="font-semibold">{{ $appointment->client?->email ?? "Email nepoznat" }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats -->
                <div class="space-y-4">
                    <h5 class="font-bold text-sm text-gray-600 uppercase">Statistika Klijenta</h5>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="stat bg-base-200 rounded-lg p-3">
                            <div class="stat-title text-xs">Ukupno Termina</div>
                            <div class="stat-value text-2xl text-primary">{{ $appointment->total_visits }}</div>
                        </div>
                        <div class="stat bg-base-200 rounded-lg p-3">
                            <div class="stat-title text-xs">Prosečna Potrošnja</div>
                            <div class="stat-value text-2xl text-success">{{ number_format($appointment->avg_spent, 0, ',', '.') }} din</div>
                        </div>
                        <div class="stat bg-base-200 rounded-lg p-3">
                            <div class="stat-title text-xs">Poslednji Termin</div>
                            <div class="stat-value text-lg">{{ \Carbon\Carbon::parse($appointment->last_visit_date)->locale('sr')->diffForHumans() }}</div>
                        </div>
                        <div class="stat bg-base-200 rounded-lg p-3">
                            <div class="stat-title text-xs">Ukupno Otkazanih</div>
                            <div class="stat-value text-2xl text-error">{{ $appointment->total_canceled }}</div>
                        </div>
                    </div>
                </div>

                <!-- Preferences -->
                <div class="space-y-4">
                    <h5 class="font-bold text-sm text-gray-600 uppercase">Napomene</h5>
                    <div class="bg-base-200 rounded-lg p-4 space-y-2">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-cut text-primary"></i>
                            <span class="text-sm">{{ $appointment->client?->notes ?? "Nema napomena" }}</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Appointments -->
                <div class="space-y-4">
                    <h5 class="font-bold text-sm text-gray-600 uppercase">Nedavni Termini</h5>
                    <div class="space-y-2">
                    @foreach ($threeAppointments as $recentAppointments)
                        @if($recentAppointments->client_id == $appointment->client_id)
                            <div class="bg-success/10 border border-success/20 rounded-lg p-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-semibold">{{ $recentAppointments->service->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $recentAppointments->start_time->locale('sr')->format('d M. Y.') }} • {{ $recentAppointments->start_time->format('H:i A') }}</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold text-success">{{ number_format($recentAppointments->price, 0, '.', ',' )}} din</div>
                                        <div class="badge badge-success badge-xs">Završeno</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-2 mt-6 pt-4 border-t border-gray-200">
                <button class="btn btn-primary flex-1">
                    <i class="fas fa-calendar-plus"></i>
                    Book Appointment
                </button>
                <button class="btn btn-outline flex-1">
                    <i class="fas fa-edit"></i>
                    Edit Client
                </button>
                <button class="btn btn-outline">
                    <i class="fas fa-envelope"></i>
                    Send Message
                </button>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
        @endforeach
    </dialog>

    <!-- Add Client Modal -->
    <dialog id="add_client_modal" class="modal">
        <div class="modal-box max-w-2xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg mb-4">
                <i class="fas fa-user-plus text-primary"></i>
                Dodaj Novog Klijenta
            </h3>

            <form class="space-y-4">
                <!-- Personal Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Ime</span>
                        </label>
                        <input type="text" placeholder="ime" class="input input-bordered" required>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Prezime</span>
                        </label>
                        <input type="text" placeholder="prezime" class="input input-bordered" required>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Telefon</span>
                        </label>
                        <input type="tel" placeholder="broj" class="input input-bordered" required>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Email</span>
                        </label>
                        <input type="email" placeholder="email" class="input input-bordered">
                    </div>
                </div>

                <!-- Notes -->
                <div class="form-control mt-3">
                    <label class="label">
                        <span class="label-text font-semibold">Client Notes</span>
                    </label>
                    <textarea class="textarea textarea-bordered h-24" placeholder="Preferencije... napomene..."></textarea>
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-2 pt-4">
                    <button type="button" class="btn btn-ghost" onclick="document.getElementById('add_client_modal').close()">
                        Nazad
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i>
                        Dodaj Klijenta
                    </button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</x-app-layout>
