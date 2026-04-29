<x-app-layout>
    <style>
        .sidebar-gradient {
            background: linear-gradient(180deg, #1f2937 0%, #111827 100%);
        }
        .schedule-card {
            transition: all 0.2s;
        }
        .schedule-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .day-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
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
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('barber.raspored') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary/20 text-white border-l-4 border-primary">
                    <i class="fas fa-calendar-alt w-5"></i>
                    <span class="font-medium">Moj Raspored</span>
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
                        <h2 class="text-2xl font-bold text-gray-800">Moj Raspored</h2>
                        <p class="text-sm text-gray-500">
                            <i class="far fa-calendar"></i>
                            Upravljaj radnim vremenom
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button class="btn btn-primary btn-sm" onclick="document.getElementById('edit_schedule_modal').showModal()">
                            <i class="fas fa-edit"></i>
                            Izmeni raspored
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
                                <i class="fas fa-briefcase text-3xl"></i>
                            </div>
                            <div class="stat-title">Radni dani</div>
                            <div class="stat-value text-primary">{{ $workingDaysCount }}</div>
                            <div class="stat-desc">Ponedeljak - Subota</div>
                        </div>
                    </div>

                    <div class="stats shadow bg-white">
                        <div class="stat">
                            <div class="stat-figure text-error">
                                <i class="fas fa-bed text-3xl"></i>
                            </div>
                            <div class="stat-title">Neradni dani</div>
                            <div class="stat-value text-error">{{ $notWorkingDays }}</div>
                            <div class="stat-desc">Nedelja</div>
                        </div>
                    </div>

                    <div class="stats shadow bg-white">
                        <div class="stat">
                            <div class="stat-figure text-success">
                                <i class="fas fa-hourglass-half text-3xl"></i>
                            </div>
                            <div class="stat-title">Ukupno nedeljno</div>
                            <div class="stat-value text-success">{{ $weeklyHours }}h</div>
                            <div class="stat-desc">Prosek 7.3h dnevno</div>
                        </div>
                    </div>

                    <div class="stats shadow bg-white">
                        <div class="stat">
                            <div class="stat-figure text-info">
                                <i class="fas fa-clock text-3xl"></i>
                            </div>
                            <div class="stat-title">Najduži dan</div>
                            <div class="stat-value text-info">{{ $longestHours }}h</div>
                            <div class="stat-desc">Petak</div>
                        </div>
                    </div>
                </div>

                <!-- Weekly Schedule Overview -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Current Week Summary Card -->
                    <div class="lg:col-span-1">
                        <div class="card bg-gradient-to-br from-primary to-secondary text-white shadow-xl">
                            <div class="card-body">
                                <h3 class="card-title text-white mb-4">
                                    <i class="fas fa-calendar-week"></i>
                                    Ova nedelja
                                </h3>

                                <div class="space-y-3">
                                    <div class="bg-white/10 rounded-lg p-3 backdrop-blur">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-sm opacity-90">Planirano sati</span>
                                            <span class="font-bold text-lg">{{ $weeklyHours }}h</span>
                                        </div>
                                        <progress class="progress progress-warning bg-white/20" value="{{ $weeklyHours }}" max="80"></progress>
                                    </div>

                                    <div class="bg-white/10 rounded-lg p-3 backdrop-blur">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-sm opacity-90">Iskorišćenost</span>
                                            <span class="font-bold text-lg">89%</span>
                                        </div>
                                        <progress class="progress progress-success bg-white/20" value="89" max="100"></progress>
                                    </div>

                                    <div class="divider my-2"></div>

                                    <div class="space-y-2 text-sm">
                                        <div class="flex items-center justify-between">
                                            <span class="opacity-90">
                                                <i class="fas fa-cut mr-2"></i>
                                                Zakazano termina
                                            </span>
                                            <span class="font-bold">{{ $appointmentsForWeek->flatten()->count() }}</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="opacity-90">
                                                <i class="fas fa-dollar-sign mr-2"></i>
                                                Očekivana zarada
                                            </span>
                                            <span class="font-bold">{{ number_format($revenueForWeek, 0, ',', '.') }} din</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="opacity-90">
                                                <i class="fas fa-coffee mr-2"></i>
                                                Vreme PAUZE
                                            </span>
                                            <span class="font-bold">7h</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Weekly Schedule Grid -->
                    <div class="lg:col-span-2">
                        <div class="card bg-white shadow-xl">
                            <div class="card-body">
                                <h3 class="card-title mb-4">
                                    <i class="fas fa-calendar"></i>
                                    Nedeljni raspored
                                </h3>

                                <div class="space-y-3">
                                    @foreach ($weekDays as $days)
                                        @php
                                            $dailyApps = $appointmentsForWeek->get($days['day_number'], collect());
                                            $wh = $schedules->get($days['day_of_week']);
                                            $startTime = \Carbon\Carbon::parse($wh->start_time)->format('H:i');
                                            $endTime   = \Carbon\Carbon::parse($wh->end_time)->format('H:i');
    
                                        @endphp
                                            @if ($days['is_today'])
                                                <div class="schedule-card flex items-center gap-4 p-4 border-2 border-primary rounded-lg bg-primary/5">
                                                    <div class="flex items-center gap-3 w-32">
                                                        <div class="day-indicator bg-warning animate-pulse"></div>
                                                        <div>
                                                            <p class="font-bold text-gray-800 capitalize">{{ $days['day_name'] }}</p>
                                                            <p class="text-xs text-primary capitalize">{{ $days['day_name'] }} • Danas</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 flex items-center gap-6">
                                                        <div class="flex items-center gap-2">
                                                            <i class="fas fa-sign-in-alt text-success"></i>
                                                            <span class="font-mono font-bold">{{ $startTime }}</span>
                                                        </div>
                                                        <div class="flex-1 border-t-2 border-dashed border-primary"></div>
                                                        <div class="flex items-center gap-2">
                                                            <i class="fas fa-sign-out-alt text-error"></i>
                                                            <span class="font-mono font-bold">{{ $endTime }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="text-right min-w-[80px]">
                                                        <p class="font-bold text-primary">8h</p>
                                                        <p class="text-xs text-gray-500">{{ $dailyApps->count() }} termina</p>
                                                    </div>
                                                </div>
                                            @elseif ($days['day_of_week'] == 0)
                                                <div class="schedule-card flex items-center gap-4 p-4 border border-error/30 rounded-lg bg-error/5">
                                                    <div class="flex items-center gap-3 w-32">
                                                        <div class="day-indicator bg-error"></div>
                                                        <div>
                                                            <p class="font-bold text-gray-800">Nedelja</p>
                                                            <p class="text-xs text-gray-500">Nedelja</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 flex items-center justify-center gap-2">
                                                        <i class="fas fa-bed text-2xl text-gray-400"></i>
                                                        <span class="font-bold text-gray-500">Neradni dan</span>
                                                    </div>
                                                    <div class="text-right min-w-[80px]">
                                                        <p class="font-bold text-error">0h</p>
                                                        <p class="text-xs text-gray-500">Dan odmora</p>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="schedule-card flex items-center gap-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                                                    <div class="flex items-center gap-3 w-32">
                                                        <div class="day-indicator bg-success"></div>
                                                        <div>
                                                            <p class="font-bold text-gray-800 capitalize">{{ $days['day_name'] }}</p>
                                                            <p class="text-xs text-gray-500 capitalize">{{ $days['day_name'] }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 flex items-center gap-6">
                                                        <div class="flex items-center gap-2">
                                                            <i class="fas fa-sign-in-alt text-success"></i>
                                                            <span class="font-mono font-bold">{{ $startTime }}</span>
                                                        </div>
                                                        <div class="flex-1 border-t-2 border-dashed border-gray-300"></div>
                                                        <div class="flex items-center gap-2">
                                                            <i class="fas fa-sign-out-alt text-error"></i>
                                                            <span class="font-mono font-bold">{{ $endTime}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="text-right min-w-[80px]">
                                                        <p class="font-bold text-primary">8h</p>
                                                        <p class="text-xs text-gray-500">{{ $dailyApps->count() }} termina</p>
                                                    </div>
                                                </div>
                                            @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Schedule Details Table -->
                <div class="card bg-white shadow-xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="card-title">
                                <i class="fas fa-table"></i>
                                Detaljan pregled
                            </h3>
                            <div class="flex items-center gap-2">
                                <button class="btn btn-outline btn-sm">
                                    <i class="fas fa-download"></i>
                                    Export
                                </button>
                                <button class="btn btn-outline btn-sm">
                                    <i class="fas fa-print"></i>
                                    Print
                                </button>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="table table-zebra">
                                <thead>
                                    <tr>
                                        <th>Dan</th>
                                        <th>Status</th>
                                        <th>Početak rada</th>
                                        <th>Kraj rada</th>
                                        <th>Trajanje</th>
                                        <th>Pauza</th>
                                        <th>Neto radno vreme</th>
                                        <th>Zakazano</th>
                                        <th>Akcije</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($weekDays as $days )
                                    @php
                                        $dailyApps = $appointmentsForWeek->get($days['day_number'], collect());
                                        $wh = $schedules->get($days['day_of_week']);
                                        $startTime = \Carbon\Carbon::parse($wh->start_time)->format('H:i');
                                        $endTime   = \Carbon\Carbon::parse($wh->end_time)->format('H:i');
                                        $duration = \Carbon\Carbon::parse($wh->start_time)->diff(\Carbon\Carbon::parse($wh->end_time))->forHumans(['short' => true, 'parts' => 2]);

                                    @endphp
                                    @if ($days['is_today'])
                                        <tr class="bg-primary/5">
                                            <td>
                                                <div class="flex items-center gap-2">
                                                    <div class="day-indicator bg-warning animate-pulse"></div>
                                                    <div>
                                                        <div class="font-bold capitalize">{{ $days['day_name'] }}</div>
                                                        <div class="text-sm text-primary font-semibold">Apr 25 • Danas</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge badge-warning badge-sm">U toku</span></td>
                                            <td class="font-mono">{{ $startTime }}</td>
                                            <td class="font-mono">{{ $endTime }}</td>
                                            <td class="font-bold">{{ $duration }}</td>
                                            <td>1h</td>
                                            <td class="font-bold text-primary">7h</td>
                                            <td>
                                                <div class="badge badge-info">{{ $dailyApps->count() }} termina</div>
                                            </td>
                                            <td>
                                                <button class="btn btn-ghost btn-xs" onclick="document.getElementById('edit_day_modal').showModal()">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @elseif($days['day_of_week'] == 0)
                                        <tr class="bg-error/5">
                                            <td>
                                                <div class="flex items-center gap-2">
                                                    <div class="day-indicator bg-error"></div>
                                                    <div>
                                                        <div class="font-bold">Nedelja</div>
                                                        <div class="text-sm opacity-50">Apr 27</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge badge-error badge-sm">Neradni dan</span></td>
                                            <td class="font-mono text-gray-400">--:--</td>
                                            <td class="font-mono text-gray-400">--:--</td>
                                            <td class="font-bold text-error">0h</td>
                                            <td>0h</td>
                                            <td class="font-bold text-error">0h</td>
                                            <td>
                                                <div class="badge badge-ghost">-</div>
                                            </td>
                                            <td>
                                                <button class="btn btn-ghost btn-xs" onclick="document.getElementById('edit_day_modal').showModal()">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>
                                                <div class="flex items-center gap-2">
                                                    <div class="day-indicator bg-success"></div>
                                                    <div>
                                                        <div class="font-bold capitalize">{{ $days['day_name'] }}</div>
                                                        <div class="text-sm opacity-50">Apr 21</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge badge-success badge-sm">Radan</span></td>
                                            <td class="font-mono">{{ $startTime }}</td>
                                            <td class="font-mono">{{ $endTime }}</td>
                                            <td class="font-bold">{{ $duration}}</td>
                                            <td>1h</td>
                                            <td class="font-bold text-primary">7h</td>
                                            <td>
                                                <div class="badge badge-info">{{ $dailyApps->count() }} termina</div>
                                            </td>
                                            <td>
                                                <button class="btn btn-ghost btn-xs" onclick="document.getElementById('edit_day_modal').showModal()">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bg-base-200 font-bold">
                                        <td colspan="4">UKUPNO</td>
                                        <td class="text-primary">{{ floor($totalMinutes/60) }}h {{ floor($totalMinutes%60) }}m</td>
                                        <td>5h</td>
                                        <td class="text-primary">39h</td>
                                        <td>
                                            <div class="badge badge-primary">{{ $appointmentsForWeek->flatten()->count() }} termina</div>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Edit Schedule Modal -->
    <dialog id="edit_schedule_modal" class="modal">
        <div class="modal-box max-w-4xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg mb-4">
                <i class="fas fa-edit text-primary"></i>
                Izmeni nedeljni raspored
            </h3>

            <form class="space-y-4">
                <!-- Quick Presets -->
                <div class="alert alert-info">
                    <i class="fas fa-magic"></i>
                    <div>
                        <div class="font-semibold">Brza podešavanja</div>
                        <div class="flex gap-2 mt-2">
                            <button type="button" class="btn btn-xs btn-outline">Radni dani 9-17</button>
                            <button type="button" class="btn btn-xs btn-outline">Produženo radno vreme</button>
                            <button type="button" class="btn btn-xs btn-outline">Vikend shift</button>
                        </div>
                    </div>
                </div>

                <!-- Days Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Monday -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <label class="label cursor-pointer gap-2">
                                <input type="checkbox" class="toggle toggle-success" checked />
                                <span class="label-text font-bold">Ponedeljak</span>
                            </label>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text text-xs">Početak</span>
                                </label>
                                <input type="time" class="input input-bordered input-sm" value="09:00">
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text text-xs">Kraj</span>
                                </label>
                                <input type="time" class="input input-bordered input-sm" value="17:00">
                            </div>
                        </div>
                    </div>

                    <!-- Tuesday -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <label class="label cursor-pointer gap-2">
                                <input type="checkbox" class="toggle toggle-success" checked />
                                <span class="label-text font-bold">Utorak</span>
                            </label>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text text-xs">Početak</span>
                                </label>
                                <input type="time" class="input input-bordered input-sm" value="09:00">
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text text-xs">Kraj</span>
                                </label>
                                <input type="time" class="input input-bordered input-sm" value="17:00">
                            </div>
                        </div>
                    </div>

                    <!-- Wednesday -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <label class="label cursor-pointer gap-2">
                                <input type="checkbox" class="toggle toggle-success" checked />
                                <span class="label-text font-bold">Sreda</span>
                            </label>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text text-xs">Početak</span>
                                </label>
                                <input type="time" class="input input-bordered input-sm" value="09:00">
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text text-xs">Kraj</span>
                                </label>
                                <input type="time" class="input input-bordered input-sm" value="17:00">
                            </div>
                        </div>
                    </div>

                    <!-- Thursday -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <label class="label cursor-pointer gap-2">
                                <input type="checkbox" class="toggle toggle-success" checked />
                                <span class="label-text font-bold">Četvrtak</span>
                            </label>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text text-xs">Početak</span>
                                </label>
                                <input type="time" class="input input-bordered input-sm" value="09:00">
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text text-xs">Kraj</span>
                                </label>
                                <input type="time" class="input input-bordered input-sm" value="17:00">
                            </div>
                        </div>
                    </div>

                    <!-- Friday -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <label class="label cursor-pointer gap-2">
                                <input type="checkbox" class="toggle toggle-success" checked />
                                <span class="label-text font-bold">Petak</span>
                            </label>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text text-xs">Početak</span>
                                </label>
                                <input type="time" class="input input-bordered input-sm" value="09:00">
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text text-xs">Kraj</span>
                                </label>
                                <input type="time" class="input input-bordered input-sm" value="17:00">
                            </div>
                        </div>
                    </div>

                    <!-- Saturday -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <label class="label cursor-pointer gap-2">
                                <input type="checkbox" class="toggle toggle-success" checked />
                                <span class="label-text font-bold">Subota</span>
                            </label>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text text-xs">Početak</span>
                                </label>
                                <input type="time" class="input input-bordered input-sm" value="10:00">
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text text-xs">Kraj</span>
                                </label>
                                <input type="time" class="input input-bordered input-sm" value="14:00">
                            </div>
                        </div>
                    </div>

                    <!-- Sunday -->
                    <div class="border border-error/30 rounded-lg p-4 bg-error/5">
                        <div class="flex items-center justify-between mb-3">
                            <label class="label cursor-pointer gap-2">
                                <input type="checkbox" class="toggle toggle-error" />
                                <span class="label-text font-bold">Nedelja</span>
                            </label>
                        </div>
                        <div class="grid grid-cols-2 gap-2 opacity-50">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text text-xs">Početak</span>
                                </label>
                                <input type="time" class="input input-bordered input-sm" value="09:00" disabled>
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text text-xs">Kraj</span>
                                </label>
                                <input type="time" class="input input-bordered input-sm" value="17:00" disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-2 pt-4">
                    <button type="button" class="btn btn-ghost" onclick="document.getElementById('edit_schedule_modal').close()">
                        Otkaži
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Sačuvaj promene
                    </button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <!-- Edit Single Day Modal -->
    <dialog id="edit_day_modal" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg mb-4">
                <i class="fas fa-calendar-day text-primary"></i>
                Izmeni radni dan
            </h3>

            <form class="space-y-4">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold">Dan</span>
                    </label>
                    <input type="text" class="input input-bordered" value="Ponedeljak" readonly>
                </div>

                <div class="form-control">
                    <label class="label cursor-pointer">
                        <span class="label-text font-semibold">Radni dan</span>
                        <input type="checkbox" class="toggle toggle-success" checked />
                    </label>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Početak</span>
                        </label>
                        <input type="time" class="input input-bordered" value="09:00">
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Kraj</span>
                        </label>
                        <input type="time" class="input input-bordered" value="17:00">
                    </div>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold">Napomena</span>
                    </label>
                    <textarea class="textarea textarea-bordered" placeholder="Dodatne napomene za ovaj dan..."></textarea>
                </div>

                <div class="flex justify-end gap-2 pt-4">
                    <button type="button" class="btn btn-ghost" onclick="document.getElementById('edit_day_modal').close()">
                        Otkaži
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Sačuvaj
                    </button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</body>
</x-app-layout>