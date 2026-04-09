<x-app-layout>
    @php
        // Hardcoded Data - Change these values
        

        // Available clients
        $clients = [
            ['id' => 1, 'name' => 'Alex Thompson'],
            ['id' => 2, 'name' => 'Sarah Mitchell'],
            ['id' => 3, 'name' => 'Kevin Park'],
            ['id' => 4, 'name' => 'Emily Rodriguez'],
            ['id' => 5, 'name' => 'Brian Lee'],
            ['id' => 6, 'name' => 'Jessica Kim'],
            ['id' => 7, 'name' => 'Michael Brown'],
            ['id' => 8, 'name' => 'Lisa Anderson'],
        ];
        
        // Available services
        $services = [
            ['id' => 1, 'name' => 'Classic Haircut', 'price' => 30],
            ['id' => 2, 'name' => 'Premium Haircut', 'price' => 45],
            ['id' => 3, 'name' => 'Beard Trim', 'price' => 20],
            ['id' => 4, 'name' => 'Haircut & Beard Combo', 'price' => 45],
            ['id' => 5, 'name' => 'Hot Towel Shave', 'price' => 35],
        ];
        
        // Appointments

    @endphp
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
                            <h2 class="card-title text-sm font-medium">Zakazano</h2>
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
                        <form action="{{ route('admin.termini') }}" method="GET" class="flex">
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
                        
                            <div class="form-control pl-4">
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


                            <div class="form-control pl-4">
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

            {{-- Appointments Timeline/Table --}}
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title mb-4">Termini</h2>
                    
                    <div class="overflow-x-auto">
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
                                        <div class="text-sm opacity-60">{{ $appointment->start_time->format('h:i A') }} - {{ $appointment->start_time->format('h:i A') }}</div>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar placeholder">
                                                <div class="bg-neutral text-neutral-content rounded-full w-8">
                                                    <span class="text-xs">{{ substr($appointment->client->name, 0, 2) }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-medium">{{ $appointment->client->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $appointment->barber->name }}</td>
                                    <td>{{ $appointment->service->name}}</td>
                                    <td>{{ $appointment->duration }}</td>
                                    <td>{{ $appointment->price }} din</td>
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
                                                <li><a onclick="viewAppointment({{ $appointment['id'] }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    View Details
                                                </a></li>
                                                <li><a onclick="openEditModal({{ $appointment['id'] }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Edit
                                                </a></li>
                                                @if($appointment['status'] === 'pending')
                                                <li><a onclick="confirmAppointment({{ $appointment['id'] }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Confirm
                                                </a></li>
                                                @endif
                                                @if($appointment['status'] === 'confirmed')
                                                <li><a onclick="completeAppointment({{ $appointment['id'] }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Mark Complete
                                                </a></li>
                                                @endif
                                                <li><a onclick="openDeleteModal({{ $appointment['id'] }}, '{{ $appointment['client_name'] }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Cancel
                                                </a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Add/Edit Appointment Modal --}}
    <dialog id="appointmentModal" class="modal">
        <div class="modal-box w-11/12 max-w-3xl">
            <h3 class="font-bold text-lg mb-4" id="modalTitle">Zakaži novi termin</h3>
            
            <form method="dialog">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    {{-- Client Selection --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Klijent *</span>
                        </label>
                        <select class="select select-bordered" id="appointmentClient">
                            <option disabled selected>Izaberi klijenta</option>
                            @foreach($clients as $client)
                            <option value="{{ $client['id'] }}">{{ $client['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Barber Selection --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Frizer *</span>
                        </label>
                        <select class="select select-bordered" id="appointmentBarber">
                            <option disabled selected>Select a barber</option>
                            @foreach($barbers as $barber)
                            <option value="{{ $barber['id'] }}">{{ $barber['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Service Selection --}}
                    <div class="form-control md:col-span-2">
                        <label class="label">
                            <span class="label-text">Service *</span>
                        </label>
                        <select class="select select-bordered" id="appointmentService" onchange="updatePrice()">
                            <option disabled selected>Select a service</option>
                            @foreach($services as $service)
                            <option value="{{ $service['id'] }}" data-price="{{ $service['price'] }}">
                                {{ $service['name'] }} - ${{ $service['price'] }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Start Date & Time --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Start Date *</span>
                        </label>
                        <input type="date" class="input input-bordered" id="appointmentStartDate" />
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Start Time *</span>
                        </label>
                        <input type="time" class="input input-bordered" id="appointmentStartTime" />
                    </div>

                    {{-- End Date & Time --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">End Date *</span>
                        </label>
                        <input type="date" class="input input-bordered" id="appointmentEndDate" />
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">End Time *</span>
                        </label>
                        <input type="time" class="input input-bordered" id="appointmentEndTime" />
                    </div>

                    {{-- Price --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Price ($) *</span>
                        </label>
                        <input type="number" step="0.01" placeholder="0.00" class="input input-bordered" id="appointmentPrice" />
                    </div>

                    {{-- Status --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Status *</span>
                        </label>
                        <select class="select select-bordered" id="appointmentStatus">
                            <option value="pending">Pending</option>
                            <option value="confirmed" selected>Confirmed</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    {{-- Notes --}}
                    <div class="form-control md:col-span-2">
                        <label class="label">
                            <span class="label-text">Notes</span>
                        </label>
                        <textarea class="textarea textarea-bordered h-24" placeholder="Any special requests or notes..." id="appointmentNotes"></textarea>
                    </div>
                </div>

                <div class="modal-action">
                    <button type="button" class="btn btn-ghost" onclick="closeAppointmentModal()">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="saveAppointment()">Save Appointment</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    {{-- View Appointment Modal --}}
    <dialog id="viewModal" class="modal">
        <div class="modal-box w-11/12 max-w-2xl">
            <h3 class="font-bold text-lg mb-4">Appointment Details</h3>
            
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm opacity-60">Client</p>
                        <p class="font-medium" id="viewClient">-</p>
                    </div>
                    <div>
                        <p class="text-sm opacity-60">Barber</p>
                        <p class="font-medium" id="viewBarber">-</p>
                    </div>
                    <div>
                        <p class="text-sm opacity-60">Service</p>
                        <p class="font-medium" id="viewService">-</p>
                    </div>
                    <div>
                        <p class="text-sm opacity-60">Price</p>
                        <p class="font-medium" id="viewPrice">-</p>
                    </div>
                    <div>
                        <p class="text-sm opacity-60">Start Time</p>
                        <p class="font-medium" id="viewStart">-</p>
                    </div>
                    <div>
                        <p class="text-sm opacity-60">End Time</p>
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
                    <button class="btn">Close</button>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    {{-- Delete/Cancel Confirmation Modal --}}
    <dialog id="deleteModal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Cancel Appointment</h3>
            <p class="py-4">Are you sure you want to cancel the appointment for "<span id="deleteClientName" class="font-semibold"></span>"? This action cannot be undone.</p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-ghost">No, Keep It</button>
                    <button class="btn btn-error" onclick="confirmDelete()">Yes, Cancel</button>
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
            document.getElementById('modalTitle').textContent = 'Book New Appointment';
            document.getElementById('appointmentClient').value = '';
            document.getElementById('appointmentBarber').value = '';
            document.getElementById('appointmentService').value = '';
            document.getElementById('appointmentStartDate').value = '';
            document.getElementById('appointmentStartTime').value = '';
            document.getElementById('appointmentEndDate').value = '';
            document.getElementById('appointmentEndTime').value = '';
            document.getElementById('appointmentPrice').value = '';
            document.getElementById('appointmentStatus').value = 'confirmed';
            document.getElementById('appointmentNotes').value = '';
            
            currentAppointmentId = null;
            document.getElementById('appointmentModal').showModal();
        }

        // Open Edit Modal
        function openEditModal(appointmentId) {
            document.getElementById('modalTitle').textContent = 'Edit Appointment';
            
            // Example data - replace with actual data fetch
            document.getElementById('appointmentClient').value = '1';
            document.getElementById('appointmentBarber').value = '1';
            document.getElementById('appointmentService').value = '4';
            document.getElementById('appointmentStartDate').value = '2026-04-09';
            document.getElementById('appointmentStartTime').value = '09:00';
            document.getElementById('appointmentEndDate').value = '2026-04-09';
            document.getElementById('appointmentEndTime').value = '09:45';
            document.getElementById('appointmentPrice').value = '45';
            document.getElementById('appointmentStatus').value = 'confirmed';
            document.getElementById('appointmentNotes').value = 'Client prefers scissors over clipper';
            
            currentAppointmentId = appointmentId;
            document.getElementById('appointmentModal').showModal();
        }

        // Close Appointment Modal
        function closeAppointmentModal() {
            document.getElementById('appointmentModal').close();
        }

        // Save Appointment
        function saveAppointment() {
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

            // Validation
            if (!client || !barber || !service || !startDate || !startTime || !endDate || !endTime || !price) {
                alert('Please fill in all required fields');
                return;
            }

            // In a real app, you would submit this data to your Laravel backend
            console.log('Saving appointment:', {
                id: currentAppointmentId,
                client_id: client,
                barber_id: barber,
                service_id: service,
                start_time: `${startDate} ${startTime}:00`,
                end_time: `${endDate} ${endTime}:00`,
                price,
                status,
                notes
            });

            // Show success message
            alert(currentAppointmentId ? 'Appointment updated successfully!' : 'Appointment booked successfully!');
            
            // Close modal
            closeAppointmentModal();
            
            // In a real app, you would reload the page or update the table
            // location.reload();
        }

        // View Appointment Details
        function viewAppointment(appointmentId) {
            // Example data - replace with actual data fetch
            document.getElementById('viewClient').textContent = 'Alex Thompson';
            document.getElementById('viewBarber').textContent = 'Marcus Johnson';
            document.getElementById('viewService').textContent = 'Haircut & Beard Combo';
            document.getElementById('viewPrice').textContent = '$45';
            document.getElementById('viewStart').textContent = 'Apr 09, 2026 09:00 AM';
            document.getElementById('viewEnd').textContent = 'Apr 09, 2026 09:45 AM';
            document.getElementById('viewStatus').textContent = 'Confirmed';
            document.getElementById('viewNotes').textContent = 'Client prefers scissors over clipper';
            
            document.getElementById('viewModal').showModal();
        }

        // Confirm Appointment
        function confirmAppointment(appointmentId) {
            console.log('Confirming appointment:', appointmentId);
            alert('Appointment confirmed successfully!');
            // In a real app, update the status in the backend
            // location.reload();
        }

        // Complete Appointment
        function completeAppointment(appointmentId) {
            console.log('Completing appointment:', appointmentId);
            alert('Appointment marked as completed!');
            // In a real app, update the status in the backend
            // location.reload();
        }

        // Open Delete Modal
        function openDeleteModal(appointmentId, clientName) {
            deleteAppointmentId = appointmentId;
            document.getElementById('deleteClientName').textContent = clientName;
            document.getElementById('deleteModal').showModal();
        }

        // Confirm Delete
        function confirmDelete() {
            console.log('Cancelling appointment:', deleteAppointmentId);
            alert('Appointment cancelled successfully!');
            document.getElementById('deleteModal').close();
            // In a real app, update the status in the backend
            // location.reload();
        }
    </script>
</x-app-layout>
