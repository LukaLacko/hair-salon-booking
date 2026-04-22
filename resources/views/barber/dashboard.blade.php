<x-app-layout>
    <style>
        .sidebar-gradient {
            background: linear-gradient(180deg, #1f2937 0%, #111827 100%);
        }
        .timeline-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 3px solid white;
        }
        .timeline-line {
            width: 2px;
            background: #e5e7eb;
            margin-left: 5px;
        }
        .calendar-day {
            min-height: 100px;
            border: 1px solid #e5e7eb;
        }
        .appointment-chip {
            font-size: 0.75rem;
            padding: 2px 6px;
            border-radius: 4px;
            margin-bottom: 2px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .appointment-chip:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary/20 text-white border-l-4 border-primary">
                    <i class="fas fa-home w-5"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 text-gray-300 hover:text-white transition-all">
                    <i class="fas fa-calendar-alt w-5"></i>
                    <span>Moj Raspored</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 text-gray-300 hover:text-white transition-all">
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
                        <h2 class="text-2xl font-bold text-gray-800">Moj Dashboard</h2>
                        <p class="text-sm text-gray-500">
                            <i class="far fa-calendar"></i> 
                            {{ ucfirst(\Carbon\Carbon::now()->locale('sr')->translatedFormat('l, j. F Y.')) }}                        
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="badge badge-lg badge-success gap-2">
                            <i class="fas fa-circle text-xs"></i>
                            Dostupan
                        </div>
                        {{-- <button class="btn btn-outline btn-sm">
                            <i class="fas fa-cog"></i>
                            Podešavanja
                        </button> --}}
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
                                <i class="fas fa-calendar-check text-3xl"></i>
                            </div>
                            <div class="stat-title">Današnji Termini</div>
                            <div class="stat-value text-primary">{{ count($appointmentsToday) }}</div>
                            <div class="stat-desc">{{ $appointmentsFinishedToday }} završeno</div>
                        </div>
                    </div>
                    
                    <div class="stats shadow bg-white">
                        <div class="stat">
                            <div class="stat-figure text-success">
                                <i class="fas fa-dollar-sign text-3xl"></i>
                            </div>
                            <div class="stat-title">Današnji Prihod</div>
                            <div class="stat-value text-success">{{ number_format($todaysRevenue, 0 , ',', '.') }} din</div>
                            <div class="stat-desc">↗︎ {{ $revenueChange }}% od juče</div>
                        </div>
                    </div>
                    
                    <div class="stats shadow bg-white">
                        <div class="stat">
                            <div class="stat-figure text-info">
                                <i class="fas fa-users text-3xl"></i>
                            </div>
                            <div class="stat-title">Ova Nedelja</div>
                            <div class="stat-value text-info">{{ $appointmentsFinishedThisWeek }}</div>
                            <div class="stat-desc">Ukupno završenih termina</div>
                        </div>
                    </div>
                    
                    <div class="stats shadow bg-white">
                        <div class="stat">
                            <div class="stat-figure text-warning">
                                <i class="fas fa-star text-3xl"></i>
                            </div>
                            <div class="stat-title">Nedeljni Prihod</div>
                            <div class="stat-value text-success">{{ number_format($thisWeeksRevenue, 0, ',', '.') }} din</div>
                            <div class="stat-desc">Tvoj uspeh ove nedelje</div>
                        </div>
                    </div>
                </div>

                <!-- Up Next Card + Timeline -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Up Next Card -->
                    <div class="lg:col-span-1">
                        <div class="card bg-gradient-to-br from-primary to-secondary text-white shadow-xl">
                            @if($upNextAppointment)
                            <div class="card-body">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="card-title text-white">
                                        <i class="fas fa-clock"></i>
                                        Sledeći Termin
                                    </h3>
                                    <div class="badge badge-warning badge-lg">
                                        <i class="fas fa-hourglass-half mr-1">
                                            Za {{ $upNextAppointment->start_time->diffForHumans(['parts' => 2, 'short' => true, 'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE]) }}  
                                        </i>
                                  
                                    </div>
                                </div>
                                
                                <div class="space-y-4">
                                    <div class="flex items-center gap-4">
                                        <div class="avatar">
                                            <div class="w-16 rounded-full ring ring-white ring-offset-2">
                                                <img src="https://ui-avatars.com/api/?name=Mike+Johnson&background=fff&color=000" alt="Client">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="font-bold text-lg">{{ $upNextAppointment->client->name }}</p>
                                            <p class="text-sm opacity-90">
                                                <i class="fas fa-phone-alt mr-1"></i>
                                                {{ $upNextAppointment->client?->phone ?? "Nema broja" }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="divider my-2"></div>

                                    <div class="space-y-2 text-sm">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-cut w-5"></i>
                                            <span class="font-semibold">{{ $upNextAppointment->service->name }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <i class="far fa-clock w-5"></i>
                                            <span>{{ \Carbon\Carbon::parse($upNextAppointment->start_time)->format('H:i') }} - 
                                                {{ \Carbon\Carbon::parse($upNextAppointment->end_time)->format('H:i') }} ({{ \Carbon\Carbon::parse($upNextAppointment->start_time)->diff(\Carbon\Carbon::parse($upNextAppointment->end_time))->forHumans(['short' => true, 'parts' => 2]) }}) </span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-dollar-sign w-5"></i>
                                            <span>{{ number_format($upNextAppointment->price, 0, ',', '.')}} din</span>
                                        </div>
                                    </div>

                                    <div class="alert alert-warning bg-warning/20 border-warning/50 text-white mt-4">
                                        <i class="fas fa-info-circle"></i>
                                        <span class="text-xs">Klijentove napomene: {{ $upNextAppointment->notes? : "Nema napomena!" }}</span>
                                    </div>

                                    {{-- <div class="card-actions justify-end mt-4">
                                        <button class="btn btn-warning btn-sm">
                                            <i class="fas fa-play"></i>
                                            Start Appointment
                                        </button> 
                                         <button class="btn btn-ghost btn-sm text-white">
                                            <i class="fas fa-info-circle"></i>
                                            Detalji
                                        </button> 
                                    </div> --}}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Timeline View -->
                    <div class="lg:col-span-2">
                        <div class="card bg-white shadow-xl">
                            <div class="card-body">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="card-title">
                                        <i class="fas fa-stream"></i>
                                        Današnji Raspored
                                    </h3>
                                    <div class="text-sm text-gray-500">
                                        <i class="far fa-clock"></i>
                                        Trenutno vreme: {{ date('H:i A') }}
                                    </div>
                                </div>

                                <div class="overflow-y-auto max-h-[500px] pr-2">
                                    <div class="space-y-0">
                                        @foreach ($appointmentsToday as $appointment )
                                            @if($appointment->status == 'Završeno')
                                            <!-- Timeline Item - Completed-->                                       
                                                <div class="flex gap-4">
                                                    <div class="flex flex-col items-center">
                                                        <div class="timeline-dot bg-success"></div>
                                                        <div class="timeline-line flex-1 min-h-[80px]"></div>
                                                    </div>
                                                    <div class="flex-1 pb-6">
                                                        <div class="bg-success/10 border border-success/20 rounded-lg p-4">
                                                            <div class="flex items-start justify-between mb-2">
                                                                <div>
                                                                    <p class="font-bold text-gray-800">{{ $appointment->client->name }}</p>
                                                                    <p class="text-sm text-gray-500">
                                                                        <i class="far fa-clock"></i>
                                                                        {{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i A') }} - {{ \Carbon\Carbon::parse($appointment->end_time)->format('H:i A') }}
                                                                    </p>
                                                                </div>
                                                                <div class="badge badge-success badge-sm">Završeno</div>
                                                            </div>
                                                            <p class="text-sm text-gray-600">
                                                                <i class="fas fa-cut mr-1"></i>
                                                                {{ $appointment->service->name }} - {{ number_format($appointment->price, 0, ',', '.') }} din
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (now()->between($appointment->start_time, $appointment->end_time) && $appointment->status !== 'Završeno')
                                                <!-- Timeline Item - In Progress -->
                                                <div class="flex gap-4">
                                                    <div class="flex flex-col items-center">
                                                        <div class="timeline-dot bg-warning animate-pulse"></div>
                                                        <div class="timeline-line flex-1 min-h-[80px]"></div>
                                                    </div>
                                                    <div class="flex-1 pb-6">
                                                        <div class="bg-warning/10 border-2 border-warning rounded-lg p-4 shadow-lg">
                                                            <div class="flex items-start justify-between mb-2">
                                                                <div>
                                                                    <p class="font-bold text-gray-800">{{ $appointment->client->name }}</p>
                                                                    <p class="text-sm text-gray-500">
                                                                        <i class="far fa-clock"></i>
                                                                        11:30 AM - 12:00 PM
                                                                    </p>
                                                                </div>
                                                                <div class="badge badge-warning badge-sm gap-1">
                                                                    <span class="loading loading-spinner loading-xs"></span>
                                                                    In Progress
                                                                </div>
                                                            </div>
                                                            <p class="text-sm text-gray-600 mb-2">
                                                                <i class="fas fa-cut mr-1"></i>
                                                                Beard Trim - $20.00
                                                            </p>
                                                            <div class="flex gap-2">
                                                                <button class="btn btn-success btn-xs">
                                                                    <i class="fas fa-check"></i>
                                                                    Complete
                                                                </button>
                                                                <button class="btn btn-ghost btn-xs">
                                                                    <i class="fas fa-pause"></i>
                                                                    Pause
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($appointment->status == 'Potvrđeno')
                                                
                                                <!-- Timeline Item - Upcoming -->
                                                <div class="flex gap-4">
                                                    <div class="flex flex-col items-center">
                                                        <div class="timeline-dot bg-gray-300"></div>
                                                        <div class="timeline-line flex-1 min-h-[80px]"></div>
                                                    </div>
                                                    <div class="flex-1 pb-6">
                                                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                                            <div class="flex items-start justify-between mb-2">
                                                                <div>
                                                                    <p class="font-bold text-gray-800">{{ $appointment->client->name }}</p>
                                                                    <p class="text-sm text-gray-500">
                                                                        <i class="far fa-clock"></i>
                                                                        {{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i A') }} - {{ \Carbon\Carbon::parse($appointment->end_time)->format('H:i A') }}
                                                                    </p>
                                                                </div>
                                                                <div class="badge badge-ghost badge-sm">Sledeći</div>
                                                            </div>
                                                            <p class="text-sm text-gray-600">
                                                                <i class="fas fa-cut mr-1"></i>
                                                                {{ $appointment->service->name }} - {{ number_format($appointment->price, 0, ',', '.') }} din
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach


                                        <!-- Timeline Item - Upcoming (Next) -->
                                        <div class="flex gap-4">
                                            <div class="flex flex-col items-center">
                                                <div class="timeline-dot bg-primary"></div>
                                                <div class="timeline-line flex-1 min-h-[80px]"></div>
                                            </div>
                                            <div class="flex-1 pb-6">
                                                <div class="bg-primary/10 border-2 border-primary rounded-lg p-4">
                                                    <div class="flex items-start justify-between mb-2">
                                                        <div>
                                                            <p class="font-bold text-gray-800">Mike Johnson</p>
                                                            <p class="text-sm text-gray-500">
                                                                <i class="far fa-clock"></i>
                                                                2:00 PM - 2:45 PM
                                                            </p>
                                                        </div>
                                                        <div class="badge badge-primary badge-sm">Next</div>
                                                    </div>
                                                    <p class="text-sm text-gray-600">
                                                        <i class="fas fa-cut mr-1"></i>
                                                        Haircut & Beard Trim - $45.00
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Timeline Item - Break -->
                                        <div class="flex gap-4">
                                            <div class="flex flex-col items-center">
                                                <div class="timeline-dot bg-info"></div>
                                                <div class="timeline-line flex-1 min-h-[80px]"></div>
                                            </div>
                                            <div class="flex-1 pb-6">
                                                <div class="bg-info/10 border border-info/20 rounded-lg p-4">
                                                    <div class="flex items-start justify-between mb-2">
                                                        <div>
                                                            <p class="font-bold text-gray-800">
                                                                <i class="fas fa-coffee mr-1"></i>
                                                                Lunch Break
                                                            </p>
                                                            <p class="text-sm text-gray-500">
                                                                <i class="far fa-clock"></i>
                                                                1:00 PM - 2:00 PM
                                                            </p>
                                                        </div>
                                                        <div class="badge badge-info badge-sm">Break</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Timeline Item - Last -->
                                        <div class="flex gap-4">
                                            <div class="flex flex-col items-center">
                                                <div class="timeline-dot bg-gray-300"></div>
                                            </div>
                                            <div class="flex-1">
                                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                                    <div class="flex items-start justify-between mb-2">
                                                        <div>
                                                            <p class="font-bold text-gray-800">Lisa Thompson</p>
                                                            <p class="text-sm text-gray-500">
                                                                <i class="far fa-clock"></i>
                                                                5:00 PM - 6:00 PM
                                                            </p>
                                                        </div>
                                                        <div class="badge badge-ghost badge-sm">Upcoming</div>
                                                    </div>
                                                    <p class="text-sm text-gray-600">
                                                        <i class="fas fa-cut mr-1"></i>
                                                        Color & Style - $85.00
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Calendar View -->
                <div class="card bg-white shadow-xl">
                    <div class="card-body">
                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6 gap-4">
                            <h3 class="card-title">
                                <i class="fas fa-calendar-alt"></i>
                                Weekly Calendar
                            </h3>
                            <div class="flex items-center gap-2">
                                <button class="btn btn-outline btn-sm">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <span class="text-sm font-semibold px-4">April 17 - 23, 2026</span>
                                <button class="btn btn-outline btn-sm">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                                <button class="btn btn-primary btn-sm ml-4">
                                    <i class="fas fa-calendar-day"></i>
                                    Today
                                </button>
                            </div>
                        </div>

                        <!-- Calendar Grid -->
                        <div class="overflow-x-auto">
                            <div class="min-w-[800px]">
                                <!-- Days Header -->
                                <div class="grid grid-cols-7 gap-px bg-gray-200 rounded-t-lg overflow-hidden">
                                    <div class="bg-gray-100 p-3 text-center font-semibold text-sm">
                                        <div class="text-gray-600">MON</div>
                                        <div class="text-lg">17</div>
                                    </div>
                                    <div class="bg-gray-100 p-3 text-center font-semibold text-sm">
                                        <div class="text-gray-600">TUE</div>
                                        <div class="text-lg">18</div>
                                    </div>
                                    <div class="bg-gray-100 p-3 text-center font-semibold text-sm">
                                        <div class="text-gray-600">WED</div>
                                        <div class="text-lg">19</div>
                                    </div>
                                    <div class="bg-gray-100 p-3 text-center font-semibold text-sm">
                                        <div class="text-gray-600">THU</div>
                                        <div class="text-lg">20</div>
                                    </div>
                                    <div class="bg-primary/10 p-3 text-center font-semibold text-sm border-2 border-primary">
                                        <div class="text-primary">FRI</div>
                                        <div class="text-lg text-primary">21</div>
                                        <div class="badge badge-primary badge-xs">Today</div>
                                    </div>
                                    <div class="bg-gray-100 p-3 text-center font-semibold text-sm">
                                        <div class="text-gray-600">SAT</div>
                                        <div class="text-lg">22</div>
                                    </div>
                                    <div class="bg-gray-100 p-3 text-center font-semibold text-sm">
                                        <div class="text-gray-600">SUN</div>
                                        <div class="text-lg">23</div>
                                    </div>
                                </div>

                                <!-- Calendar Days -->
                                <div class="grid grid-cols-7 gap-px bg-gray-200 rounded-b-lg overflow-hidden">
                                    <!-- Monday -->
                                    <div class="calendar-day bg-white p-2">
                                        <div class="space-y-1">
                                            <div class="appointment-chip bg-success/20 text-success" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">9:00 AM</div>
                                                <div class="truncate">Sarah W.</div>
                                            </div>
                                            <div class="appointment-chip bg-primary/20 text-primary" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">11:00 AM</div>
                                                <div class="truncate">John D.</div>
                                            </div>
                                            <div class="appointment-chip bg-info/20 text-info" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">2:00 PM</div>
                                                <div class="truncate">Mike R.</div>
                                            </div>
                                            <div class="text-xs text-gray-500 text-center mt-2">+2 more</div>
                                        </div>
                                    </div>

                                    <!-- Tuesday -->
                                    <div class="calendar-day bg-white p-2">
                                        <div class="space-y-1">
                                            <div class="appointment-chip bg-success/20 text-success" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">10:00 AM</div>
                                                <div class="truncate">Emma L.</div>
                                            </div>
                                            <div class="appointment-chip bg-primary/20 text-primary" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">1:00 PM</div>
                                                <div class="truncate">Chris P.</div>
                                            </div>
                                            <div class="appointment-chip bg-warning/20 text-warning" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">3:30 PM</div>
                                                <div class="truncate">Alex K.</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Wednesday -->
                                    <div class="calendar-day bg-white p-2">
                                        <div class="space-y-1">
                                            <div class="appointment-chip bg-success/20 text-success" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">9:30 AM</div>
                                                <div class="truncate">David M.</div>
                                            </div>
                                            <div class="appointment-chip bg-info/20 text-info" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">12:00 PM</div>
                                                <div class="truncate">Tom S.</div>
                                            </div>
                                            <div class="appointment-chip bg-primary/20 text-primary" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">4:00 PM</div>
                                                <div class="truncate">Lisa B.</div>
                                            </div>
                                            <div class="text-xs text-gray-500 text-center mt-2">+1 more</div>
                                        </div>
                                    </div>

                                    <!-- Thursday -->
                                    <div class="calendar-day bg-white p-2">
                                        <div class="space-y-1">
                                            <div class="appointment-chip bg-success/20 text-success" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">8:00 AM</div>
                                                <div class="truncate">Mark H.</div>
                                            </div>
                                            <div class="appointment-chip bg-primary/20 text-primary" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">10:30 AM</div>
                                                <div class="truncate">Nina F.</div>
                                            </div>
                                            <div class="appointment-chip bg-warning/20 text-warning" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">2:30 PM</div>
                                                <div class="truncate">Paul G.</div>
                                            </div>
                                            <div class="appointment-chip bg-info/20 text-info" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">5:00 PM</div>
                                                <div class="truncate">Rachel V.</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Friday (Today) -->
                                    <div class="calendar-day bg-primary/5 p-2 border-2 border-primary">
                                        <div class="space-y-1">
                                            <div class="appointment-chip bg-success/30 text-success border border-success" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">9:00 AM</div>
                                                <div class="truncate">Sarah W.</div>
                                            </div>
                                            <div class="appointment-chip bg-success/30 text-success border border-success" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">10:00 AM</div>
                                                <div class="truncate">Robert C.</div>
                                            </div>
                                            <div class="appointment-chip bg-warning/30 text-warning border border-warning" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">11:30 AM</div>
                                                <div class="truncate">David M.</div>
                                            </div>
                                            <div class="appointment-chip bg-primary/30 text-primary border-2 border-primary" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">2:00 PM</div>
                                                <div class="truncate">Mike J.</div>
                                            </div>
                                            <div class="text-xs text-primary font-semibold text-center mt-2">+4 more</div>
                                        </div>
                                    </div>

                                    <!-- Saturday -->
                                    <div class="calendar-day bg-white p-2">
                                        <div class="space-y-1">
                                            <div class="appointment-chip bg-gray-200 text-gray-600" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">9:00 AM</div>
                                                <div class="truncate">Steve J.</div>
                                            </div>
                                            <div class="appointment-chip bg-gray-200 text-gray-600" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">11:00 AM</div>
                                                <div class="truncate">Karen M.</div>
                                            </div>
                                            <div class="appointment-chip bg-gray-200 text-gray-600" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">1:00 PM</div>
                                                <div class="truncate">Ben T.</div>
                                            </div>
                                            <div class="appointment-chip bg-gray-200 text-gray-600" onclick="document.getElementById('appointment_modal').showModal()">
                                                <div class="font-semibold">3:00 PM</div>
                                                <div class="truncate">Amy W.</div>
                                            </div>
                                            <div class="text-xs text-gray-500 text-center mt-2">+3 more</div>
                                        </div>
                                    </div>

                                    <!-- Sunday -->
                                    <div class="calendar-day bg-gray-50 p-2">
                                        <div class="flex items-center justify-center h-full">
                                            <div class="text-center text-gray-400">
                                                <i class="fas fa-ban text-2xl mb-2"></i>
                                                <div class="text-xs">Day Off</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Calendar Legend -->
                        <div class="flex flex-wrap items-center gap-4 mt-6 pt-4 border-t border-gray-200">
                            <div class="text-sm font-semibold text-gray-600">Legend:</div>
                            <div class="flex items-center gap-2 text-sm">
                                <div class="w-4 h-4 rounded bg-success/20 border border-success"></div>
                                <span>Completed</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <div class="w-4 h-4 rounded bg-warning/20 border border-warning"></div>
                                <span>In Progress</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <div class="w-4 h-4 rounded bg-primary/20 border border-primary"></div>
                                <span>Next Up</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <div class="w-4 h-4 rounded bg-gray-200"></div>
                                <span>Scheduled</span>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Appointment Details Modal -->
    <dialog id="appointment_modal" class="modal">
        <div class="modal-box max-w-2xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg mb-4">
                <i class="fas fa-calendar-check text-primary"></i>
                Appointment Details
            </h3>
            
            <div class="space-y-4">
                <!-- Client Info -->
                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                    <div class="avatar">
                        <div class="w-16 rounded-full">
                            <img src="https://ui-avatars.com/api/?name=Mike+Johnson&background=0D8ABC&color=fff" alt="Client">
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-lg">Mike Johnson</p>
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-phone-alt mr-1"></i>
                            (555) 123-4567
                        </p>
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-envelope mr-1"></i>
                            mike.johnson@email.com
                        </p>
                    </div>
                    <div class="badge badge-primary badge-lg">Regular Client</div>
                </div>

                <!-- Appointment Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">
                                <i class="fas fa-cut mr-1"></i>
                                Service
                            </span>
                        </label>
                        <input type="text" value="Haircut & Beard Trim" class="input input-bordered" readonly>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">
                                <i class="fas fa-dollar-sign mr-1"></i>
                                Price
                            </span>
                        </label>
                        <input type="text" value="$45.00" class="input input-bordered" readonly>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">
                                <i class="far fa-clock mr-1"></i>
                                Start Time
                            </span>
                        </label>
                        <input type="text" value="2:00 PM" class="input input-bordered" readonly>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">
                                <i class="fas fa-hourglass-half mr-1"></i>
                                Duration
                            </span>
                        </label>
                        <input type="text" value="45 minutes" class="input input-bordered" readonly>
                    </div>
                </div>

                <!-- Notes -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold">
                            <i class="fas fa-sticky-note mr-1"></i>
                            Notes
                        </span>
                    </label>
                    <textarea class="textarea textarea-bordered h-20" readonly>Client prefers short on sides, longer on top. Last visit was 6 weeks ago.</textarea>
                </div>

                <!-- Quick Actions -->
                <div class="flex flex-wrap gap-2 pt-4">
                    <button class="btn btn-success flex-1">
                        <i class="fas fa-check"></i>
                        Mark Complete
                    </button>
                    <button class="btn btn-warning flex-1">
                        <i class="fas fa-clock"></i>
                        Reschedule
                    </button>
                    <button class="btn btn-error flex-1">
                        <i class="fas fa-times"></i>
                        Cancel
                    </button>
                </div>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

</body>
    <script>
        // Auto-refresh current time
        setInterval(() => {
            const timeElements = document.querySelectorAll('[data-current-time]');
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
            timeElements.forEach(el => el.textContent = timeString);
        }, 60000);

        // Scroll timeline to current time
        window.addEventListener('load', () => {
            const inProgressItem = document.querySelector('.timeline-dot.bg-warning');
            if (inProgressItem) {
                inProgressItem.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    </script>
</x-app-layout>




