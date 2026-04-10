@if(session('success'))
<div id="success-alert" class="alert alert-success shadow-lg mb-4">
    <span>{{ session('success') }}</span>
</div>
@endif

@if(session('error'))
<div id="error-alert" class="alert alert-error shadow-lg mb-4">
    <span>{{ session('error') }}</span>
</div>
@endif

<script>
    setTimeout(function() {
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.style.transition = 'opacity 1s';
            successAlert.style.opacity = '0';
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 1000);
        }

        const errorAlert = document.getElementById('error-alert');
        if (errorAlert) {
            errorAlert.style.transition = 'opacity 1s';
            errorAlert.style.opacity = '0';
            setTimeout(() => {
                errorAlert.style.display = 'none';
            }, 1000);
        }
    }, 3000);
</script>
<x-app-layout>
    {{-- Main Content --}}
    <div class="min-h-screen bg-base-200 p-6">
        <div class="mx-auto max-w-7xl space-y-6">
            
            {{-- Header --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="space-y-2">
                    <h1 class="text-3xl font-bold">Upravljanje Terminima</h1>
                    <p class="text-base-content/60">Zakaži i  upravljaj terminima</p>
                </div>
                <button class="btn btn-primary" onclick="openAddModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Zakaži Novi Termin
                </button>
            </div>

            {{-- Stats Cards --}}
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <h2 class="card-title text-sm font-medium">Ukupno Danas</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold">{{ $totalAppointmentsToday}}</div>
                        <p class="text-xs opacity-60">Današnji Termini</p>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <h2 class="card-title text-sm font-medium">Potvrđeno</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold">{{ $confirmedAppointments }}</div>
                        <p class="text-xs opacity-60">Potvrđeni  termini</p>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <h2 class="card-title text-sm font-medium">Na čekanju</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold">{{ $pendingAppointments }}</div>
                        <p class="text-xs opacity-60">Čekaju potvrdu</p>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <h2 class="card-title text-sm font-medium">Današnji prihod</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold">
                            {{ number_format($todaysRevenue, 0, ',', '.') }} din
                        </div>
                        <p class="text-xs opacity-60">Expected prihod</p>
                    </div>
                </div>
            </div>

            {{-- Filters --}}
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex flex-wrap gap-4">
                        <form action="{{ route('admin.termini') }}" method="GET">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Pretraga po datumu</span>
                                    </label>
                                    <input type="date" 
                                        name="date" 
                                        class="input input-bordered focus:input-primary" 
                                        value="{{ $date }}" 
                                        onchange="this.form.submit()"/>
    
                                </div>
                            
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Pretraga po frizeru</span>
                                    </label>
                                    <select name="barber_id" onchange="this.form.submit()" class="select select-bordered">
                                        <option value="" {{ $barberId == '' ? 'selected' : '' }}>Svi Frizeri</option>
                                        @foreach($barbers as $barber)
                                        <option value="{{ $barber->id }}" {{ $barberId == $barber->id ? 'selected' : '' }}>{{ $barber->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
    
    
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Pretraga po statusu</span>
                                    </label>
                                    <select name="status" onchange="this.form.submit()" class="select select-bordered">
                                        <option value="" {{ $statusName == '' ? 'selected' : '' }}>Svi Statusi</option>
                                        <option value="Na čekanju" {{ $statusName == 'Na čekanju' ? 'selected' : ''}}>Na Čekanju</option>
                                        <option value="Potvrđeno" {{ $statusName == 'Potvrđeno' ? 'selected' : ''}}>Potvrđeno</option>
                                        <option value="Završeno" {{ $statusName == 'Završeno' ? 'selected' : ''}}>Završeno</option>
                                        <option value="Otkazano" {{ $statusName == 'Otkazano' ? 'selected' : ''}}>Otkazano</option>
                                    </select>
                                </div>
                        </form>
    
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">&nbsp;</span>
                                </label>
                                <button class="">
    
                                    @if($date || $barberId || $statusName)
                                    <a href="{{ route('admin.termini') }}" class="btn btn-ghost join-item border-base-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        Prikaži sve
                                    </a>
                                    @endif
                                </button>
                            </div>
                        </div>
                            
                    </div>
                </div>
            </div>

            {{-- Appointments Timeline/Table --}}
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title mb-4">Termini</h2>
                    
                    <div class="overflow-x-auto hidden md:block">
                        <table class="table table-zebra">
                            <thead>
                                <tr>
                                    <th>Datum & Vreme</th>
                                    <th>Klijent</th>
                                    <th>Frizer</th>
                                    <th>Usluge</th>
                                    <th>Trajanje</th>
                                    <th>Cena</th>
                                    <th>Status</th>
                                    <th class="text-right">Opcije</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                <tr>
                                    <td>
                                        <div class="font-medium">{{ $appointment->start_time->format('M d, Y') }}</div>
                                        <div class="text-sm opacity-60">{{ $appointment->start_time->format('h:i A') }} - {{ $appointment->end_time?->format('h:i A') ?? 'N/A'}}</div>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar placeholder">
                                                <div class="bg-neutral text-neutral-content rounded-full w-8 h-8 flex items-center justify-center">
                                                    <span class="text-xs font-semibold uppercase leading-none">
                                                        {{ substr($appointment->client->name, 0, 2) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-medium">{{ $appointment->client->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td >{{ $appointment->barber->name }}</td>
                                    <td>{{ $appointment->service->name}}</td>
                                    <td>{{ $appointment->duration }}</td>
                                    <td>{{ number_format($appointment->price, 0, ',', '.') }} din</td>
                                    <td>
                                        @if($appointment->status === 'Potvrđeno')
                                            <span class="badge badge-success gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Potvrđeno
                                            </span>
                                        @elseif($appointment->status === 'Na čekanju')
                                            <span class="badge badge-warning gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Na čekanju
                                            </span>
                                        @elseif($appointment->status === 'Završeno')
                                            <span class="badge badge-primary gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Završeno
                                            </span>
                                        @else
                                            <span class="badge badge-error gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                Otkazano
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-end">
                                            <label tabindex="0" class="btn btn-ghost btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                </svg>
                                            </label>
                                            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                                <li><a onclick='viewAppointment(@json($appointment->load(["client", "barber", "service"])))'>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    Pogledaj detalje
                                                </a></li>
                                                <li><a onclick="openEditModal({{ json_encode($appointment) }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Izmeni
                                                </a></li>
                                                @if($appointment['status'] === 'Na čekanju')
                                                <li><a href="{{ route('admin.potvrdi', $appointment->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Potvrdi
                                                </a></li>
                                                @endif
                                                @if($appointment['status'] === 'Potvrđeno')
                                                <li><a href="{{ route('admin.završi', $appointment->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Označi završeno
                                                </a></li>
                                                @endif
                                                <li><a onclick="openDeleteModal({{ $appointment->id }}, '{{ $appointment->client->name }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Obriši
                                                </a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:hidden">
                        @foreach($appointments as $appointment)
                        <div class="card bg-base-100 shadow-lg p-4 border-l-4 border-primary">
                            <div class="flex justify-between items-start">
                                <h3 class="font-bold text-lg">{{ $appointment->barber->name }}</h3>
                                    @if($appointment->status === 'Potvrđeno')
                                        <span class="badge badge-success text-xs">{{ $appointment->status }}</span>
                                    @elseif($appointment->status === 'Na čekanju')
                                        <span class="badge badge-warning text-xs">{{ $appointment->status }}</span>
                                    @elseif($appointment->status === 'Završeno')
                                        <span class="badge badge-primary text-xs">{{ $appointment->status }}</span>
                                    @else
                                        <span class="badge badge-error text-xs">{{ $appointment->status }}</span>
                                    @endif
                            </div>
                            <p class="text-sm opacity-100 my-2">Klijent: {{ $appointment->client->name}}</p>
                            <p class="text-sm opacity-60 my-2">{{ $appointment->notes}}</p>
                            <div class="flex justify-end gap-2 mt-2">
                                <button class="btn btn-sm btn-info" onclick="openEditModal({{ json_encode($appointment) }})">Edit</button>
                                <button class="btn btn-sm btn-error" onclick="openDeleteModal({{ $appointment->id }}, '{{ $appointment->client->name }}')">Delete</button>
                                @if($appointment['status'] === 'Potvrđeno')
                                    <a href="{{ route('admin.završi', $appointment->id) }}" class="btn btn-sm btn-outline-success">Završi</a>
                                @endif
                                @if($appointment['status'] === 'Na čekanju')
                                    <a href="{{ route('admin.potvrdi', $appointment->id) }}" class="btn btn-sm btn-outline-success">Potvrdi</a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Add/Edit Appointment Modal --}}
    <dialog id="appointmentModal" class="modal">
        <div class="modal-box w-11/12 max-w-3xl">
            <h3 class="font-bold text-lg mb-4" id="modalTitle">Zakaži novi termin</h3>
            
            <form id="appointmentForm" method="POST">
                @csrf
                <div id="methodField"></div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    {{-- Client Selection --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Klijent *</span>
                        </label>
                        <select class="select select-bordered" id="appointmentClient" name="client_id">
                            <option disabled selected>Izaberi klijenta</option>
                            @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Barber Selection --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Frizer *</span>
                        </label>
                        <select class="select select-bordered" id="appointmentBarber" name="barber_id">
                            <option disabled selected>Select a barber</option>
                            @foreach($barbers as $barber)
                            <option value="{{ $barber->id }}">{{ $barber->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Service Selection --}}
                    <div class="form-control md:col-span-2">
                        <label class="label">
                            <span class="label-text">Service *</span>
                        </label>
                        <select class="select select-bordered" id="appointmentService" onchange="updatePrice()" name="service_id">
                            <option disabled selected>Select a service</option>
                            @foreach($services as $service)
                            <option value="{{ $service->id }}" data-price="{{ number_format($service->price, 0, ',', '.') }}">
                                {{ $service->name }} - ${{ number_format($service->price, 0, ',', '.')}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Start Date & Time --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Datum početka *</span>
                        </label>
                        <input type="date" class="input input-bordered" id="appointmentStartDate" name="start_date"/>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Vreme početka *</span>
                        </label>
                        <input type="time" class="input input-bordered" id="appointmentStartTime" name="start_time"/>
                    </div>

                    {{-- End Date & Time --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Datum završetka *</span>
                        </label>
                        <input type="date" class="input input-bordered" id="appointmentEndDate" name="end_date" />
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Vreme završetka *</span>
                        </label>
                        <input type="time" class="input input-bordered" id="appointmentEndTime" name="end_time" />
                    </div>

                    {{-- Price --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Cena (din) *</span>
                        </label>
                        <input type="number" step="0.01" placeholder="0.00" class="input input-bordered" id="appointmentPrice" name="price" />
                    </div>

                    {{-- Status --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Status *</span>
                        </label>
                        <select class="select select-bordered" id="appointmentStatus" name="status">
                            <option value="Na čekanju">Na čekanju</option>
                            <option value="Potvrđeno" selected>Potvrđeno</option>
                            <option value="Završeno">Završeno</option>
                            <option value="Otkazano">Otkazano</option>
                        </select>
                    </div>

                    {{-- Notes --}}
                    <div class="form-control md:col-span-2">
                        <label class="label">
                            <span class="label-text">Notes</span>
                        </label>
                        <textarea class="textarea textarea-bordered h-24" placeholder="Any special requests or notes..." id="appointmentNotes" name="notes"></textarea>
                    </div>
                </div>

                <div class="modal-action">
                    <button type="button" class="btn btn-ghost" onclick="closeAppointmentModal()">Nazad</button>
                    <button type="submit" class="btn btn-primary" onclick="saveAppointment()">Sačuvaj Termin</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>nazad</button>
        </form>
    </dialog>

    {{-- View Appointment Modal --}}
    <dialog id="viewModal" class="modal">
        <div class="modal-box w-11/12 max-w-2xl">
            <h3 class="font-bold text-lg mb-4">Detalji Termina</h3>
            
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm opacity-60">Klijent</p>
                        <p class="font-medium" id="viewClient">-</p>
                    </div>
                    <div>
                        <p class="text-sm opacity-60">Frizer</p>
                        <p class="font-medium" id="viewBarber">-</p>
                    </div>
                    <div>
                        <p class="text-sm opacity-60">Usluga</p>
                        <p class="font-medium" id="viewService">-</p>
                    </div>
                    <div>
                        <p class="text-sm opacity-60">Cena</p>
                        <p class="font-medium" id="viewPrice">-</p>
                    </div>
                    <div>
                        <p class="text-sm opacity-60">Početak</p>
                        <p class="font-medium" id="viewStart">-</p>
                    </div>
                    <div>
                        <p class="text-sm opacity-60">Završetak</p>
                        <p class="font-medium" id="viewEnd">-</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-sm opacity-60">Status</p>
                        <p class="font-medium" id="viewStatus">-</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-sm opacity-60">Notes</p>
                        <p class="font-medium" id="viewNotes">-</p>
                    </div>
                </div>
            </div>

            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">Nazad</button>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>Nazad</button>
        </form>
    </dialog>

    {{-- Delete/Cancel Confirmation Modal --}}
    <dialog id="deleteModal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Otkaži Termin</h3>
            <p class="py-4">Da li si sigruan da želiš otkazati termin za "<span id="deleteClientName" class="font-semibold"></span>"?</p>
            <div class="modal-action">
                <form method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-ghost" onclick="document.getElementById('deleteModal').close()">Ne, Ostavi</button>
                    <button class="btn btn-error" type="submit">Da, Otkaži</button>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <script>
        let currentAppointmentId = null;
        let deleteAppointmentId = null;

        // Update price when service is selected
        function updatePrice() {
            const serviceSelect = document.getElementById('appointmentService');
            const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            if (price) {
                document.getElementById('appointmentPrice').value = price;
            }
        }

        // Open Add Modal
        function openAddModal() {

            document.getElementById('modalTitle').textContent = 'Zakaži Novi Termin';

            document.getElementById('appointmentClient').value = '';
            document.getElementById('appointmentBarber').value = '';
            document.getElementById('appointmentService').value = '';
            document.getElementById('appointmentStartDate').value = '';
            document.getElementById('appointmentStartTime').value = '';
            document.getElementById('appointmentEndDate').value = '';
            document.getElementById('appointmentEndTime').value = '';
            document.getElementById('appointmentPrice').value = '';
            document.getElementById('appointmentStatus').value = 'Potvrđeno';
            document.getElementById('appointmentNotes').value = '';
            
            currentAppointmentId = null;
            document.getElementById('appointmentModal').showModal();
        }

        // Open Edit Modal
        function openEditModal(appointment) {
            console.log("Start:", appointment.start_time);
            console.log("End:", appointment.end_time);
            const form = document.getElementById('appointmentForm');
            form.action = `/admin/termini/izmeni/${appointment.id}`;
            document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';


            document.getElementById('modalTitle').textContent = 'Izmeni Termin';
            
            document.getElementById('appointmentClient').value = appointment.client_id;
            document.getElementById('appointmentBarber').value = appointment.barber_id;
            document.getElementById('appointmentService').value = appointment.service_id;

            // Obrada Start Vremena
            if (appointment.start_time) {
                // Delimo string tamo gde je slovo "T"
                const parts = appointment.start_time.split('T'); 
                
                // parts[0] je "2026-04-30" -> to HTML date voli
                document.getElementById('appointmentStartDate').value = parts[0]; 
                
                if (parts[1]) {
                    // parts[1] je "17:55:00.000000Z" -> uzimamo samo "17:55"
                    const timeOnly = parts[1].substring(0, 5);
                    document.getElementById('appointmentStartTime').value = timeOnly;
                }
            }

            // Obrada End Vremena
            if (appointment.end_time) {
                const parts = appointment.end_time.split('T');
                
                document.getElementById('appointmentEndDate').value = parts[0];
                
                if (parts[1]) {
                    const timeOnly = parts[1].substring(0, 5);
                    document.getElementById('appointmentEndTime').value = timeOnly;
                }
            } else {
                document.getElementById('appointmentEndDate').value = '';
                document.getElementById('appointmentEndTime').value = '';
            }


            document.getElementById('appointmentPrice').value = appointment.price;
            document.getElementById('appointmentStatus').value = appointment.status;
            document.getElementById('appointmentNotes').value = appointment.notes || '';
            
            currentAppointmentId = appointment.id;
            document.getElementById('appointmentModal').showModal();
        }

        // Close Appointment Modal
        function closeAppointmentModal() {
            document.getElementById('appointmentModal').close();
        }

        // Save Appointment
        function saveAppointment() {
            const form = document.getElementById('appointmentForm');
            form.action = `/admin/termini/dodaj`;
            document.getElementById('methodField').innerHTML = '';

            const client = document.getElementById('appointmentClient').value;
            const barber = document.getElementById('appointmentBarber').value;
            const service = document.getElementById('appointmentService').value;
            const startDate = document.getElementById('appointmentStartDate').value;
            const startTime = document.getElementById('appointmentStartTime').value;
            const endDate = document.getElementById('appointmentEndDate').value;
            const endTime = document.getElementById('appointmentEndTime').value;
            const price = document.getElementById('appointmentPrice').value;
            const status = document.getElementById('appointmentStatus').value;
            const notes = document.getElementById('appointmentNotes').value;

            if (!client || !barber || !service || !startDate || !startTime || !endDate || !endTime || !price) {
                alert('Please fill in all required fields');
                return;
            }

            // Show success message            
            // Close modal
            closeAppointmentModal();
            
            // In a real app, you would reload the page or update the table
            // location.reload();
        }

        // View Appointment Details
        function viewAppointment(appointment) {

            document.getElementById('viewClient').textContent = appointment.client.name ;
            document.getElementById('viewBarber').textContent = appointment.barber.name;
            document.getElementById('viewService').textContent = appointment.service.name;
            document.getElementById('viewPrice').textContent = appointment.price;
            document.getElementById('viewStart').textContent =     new Date(appointment.start_time.replace(' ', 'T')).toLocaleString('sr-RS');
            document.getElementById('viewEnd').textContent = appointment.end_time
                ? new Date(appointment.end_time.replace(' ', 'T')).toLocaleString('sr-RS')
                : 'N/A';            
            document.getElementById('viewStatus').textContent = appointment.status;
            document.getElementById('viewNotes').textContent = appointment.notes || 'Nema napomene';
            
            document.getElementById('viewModal').showModal();
        }

        // Confirm Appointment
        function confirmAppointment(appointmentId) {
            console.log('Confirming appointment:', appointmentId);
            alert('Appointment confirmed successfully!');

        }

        // Complete Appointment
        function completeAppointment(appointmentId) {
            console.log('Completing appointment:', appointmentId);
            alert('Appointment marked as completed!');

        }

        // Open Delete Modal
        function openDeleteModal(appointmentId, clientName) {
            const form = document.getElementById('deleteForm'); 
            form.action = `/admin/termini/obrisi/${appointmentId}`; 
            document.getElementById('deleteClientName').textContent = clientName;
            document.getElementById('deleteModal').showModal();
        }

    </script>
</x-app-layout>
