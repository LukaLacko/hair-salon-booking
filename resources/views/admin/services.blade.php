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
        <div class="flex items-center justify-between">
            <div class="space-y-2">
                <h1 class="text-3xl font-bold">Upravljanje Uslugama</h1>
                <p class="text-base-content/60">Upravljaj uslugama i cenama svog salona</p>
            </div>
            <button class="btn btn-primary" onclick="openAddModal()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Dodaj novu Uslugu
            </button>
        </div>

        {{-- Stats Cards --}}
        <div class="grid gap-4 md:grid-cols-4">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <h2 class="card-title text-sm font-medium">Ukupno Usluga</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold">{{ count($services) }}</div>
                    <p class="text-xs opacity-60">Dostupno usluga</p>
                </div>
            </div>

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <h2 class="card-title text-sm font-medium">Aktivne Usluge</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold">{{ collect($services)->where('is_active', true)->count() }}</div>
                    <p class="text-xs opacity-60">Trenutno aktivne</p>
                </div>
            </div>

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <h2 class="card-title text-sm font-medium">Prosečna Cena</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold">{{ number_format($avgPrice, 0, ',', '.') }} din</div>
                    <p class="text-xs opacity-60">Prosečna cena usluge</p>
                </div>
            </div>

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <h2 class="card-title text-sm font-medium">Prosečno trajanje</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold">{{ round(collect($services)->avg('duration_minutes')) }} min</div>
                    <p class="text-xs opacity-60">Prosečno trajanje</p>
                </div>
            </div>
        </div>

        {{-- Services Table --}}
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title mb-4">Sve Usluge</h2>
                
                <div class="overflow-x-auto hidden md:block">
                    <table class="table table-zebra ">
                        <thead>
                            <tr>
                                <th>Naizv Usluge</th>
                                <th>Cena</th>
                                <th>Trajanje</th>
                                <th>Status</th>
                                <th>Opis</th>
                                <th class="text-right">Opcije</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                            <tr>
                                <td class="font-bold">{{ $service['name'] }}</td>
                                <td><span class="badge badge-success">{{ $service['price'] }} din</span></td>
                                <td>{{ $service['duration_minutes'] }} min</td>
                                <td>
                                    @if($service['is_active'])
                                        <span class="badge badge-info gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Aktivno
                                        </span>
                                    @else
                                        <span class="badge badge-ghost gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Neaktivno
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="max-w-xs truncate">{{ $service['description'] }}</div>
                                </td>
                                <td class="text-right">
                                    <div class="flex gap-2 justify-end">
                                        <button class="btn btn-sm btn-info" onclick="openEditModal({{ json_encode($service) }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Izmeni
                                        </button>
                                        <button class="btn btn-sm btn-error" onclick="openDeleteModal({{ $service->id }}, '{{ $service['name'] }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Obriši
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="grid grid-cols-1 gap-4 md:hidden">
                    @foreach($services as $service)
                    <div class="card bg-base-100 shadow-lg p-4 border-l-4 border-primary">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-lg">{{ $service['name'] }}</h3>
                            <span class="badge badge-success text-xs">{{ $service['price'] }} din</span>
                        </div>
                        <p class="text-sm opacity-70 my-2">{{ $service['description'] }}</p>
                        <div class="flex justify-end gap-2 mt-2">
                            <button class="btn btn-sm btn-info" onclick="openEditModal({{ json_encode($service) }})">Edit</button>
                            <button class="btn btn-sm btn-error" onclick="openDeleteModal({{ $service->id }}, '{{ $service['name'] }}')">Delete</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Add/Edit Service Modal --}}
<dialog id="serviceModal" class="modal">
    <div class="modal-box w-11/12 max-w-2xl">
        <h3 class="font-bold text-lg mb-4" id="modalTitle">Dodaj novu Uslugu</h3>
        
        <form id="realServiceForm" method="POST" action="/usluge">
            @csrf
            <div id="methodContainer"></div>

            <div class="space-y-4">
                <div class="form-control">
                    <label class="label"><span class="label-text">Naziv Usluge</span></label>
                    <input type="text" class="input input-bordered" id="ServiceName" name="name" required/>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="form-control">
                        <label class="label"><span class="label-text">Cena (din)</span></label>
                        <input type="number" step="0.01" class="input input-bordered" id="ServicePrice" name="price" required/>
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Trajanje (minuti)</span></label>
                        <input type="number" class="input input-bordered" id="ServiceDuration" name="duration_minutes" required/>
                    </div>
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text">Opis</span></label>
                    <textarea class="textarea textarea-bordered h-24" id="ServiceDescription" name="description"></textarea>
                </div>

                <div class="form-control">
                    <label class="label cursor-pointer justify-start gap-4">
                        <input type="checkbox" class="toggle toggle-success" id="ServiceActive" name="is_active" value="1" checked />
                        <span class="label-text">Usluga je Aktivna</span>
                    </label>
                </div>
            </div>

            <div class="modal-action">
                <button type="button" class="btn btn-ghost" onclick="closeServiceModal()">Nazad</button>
                <button type="submit" class="btn btn-primary">Sačuvaj Uslugu</button>
            </div>
        </form>
    </div>
</dialog>

<dialog id="deleteModal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Potvrdi Brisanje</h3>
        <p class="py-4">Da li želiš da obrišeš uslugu "<span class="font-bold" id="deleteServiceName"></span>"?</p>
        <div class="modal-action">
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-ghost" onclick="document.getElementById('deleteModal').close()">Nazad</button>
                <button type="submit" class="btn btn-error">Obriši</button>
            </form>
        </div>
    </div>
</dialog>

<script>
    let currentServiceId = null;

    function openAddModal() {
        const form = document.getElementById('realServiceForm');
        const methodContainer = document.getElementById('methodContainer');
        
        document.getElementById('modalTitle').textContent = 'Dodaj novu Uslugu';
        
        // Reset akcije i metoda
        form.action = '/admin/usluge/dodaj'; 
        methodContainer.innerHTML = ''; 
        
        // Manualni reset svih polja
        document.getElementById('ServiceName').value = '';
        document.getElementById('ServicePrice').value = '';
        document.getElementById('ServiceDuration').value = '';
        document.getElementById('ServiceDescription').value = '';
        
        // FIX za Toggle: Prvo setujemo vrednost, pa otvaramo
        const activeCheckbox = document.getElementById('ServiceActive');
        activeCheckbox.checked = true;

        currentServiceId = null;
        document.getElementById('serviceModal').showModal();
    }

    function openEditModal(service) {
        const form = document.getElementById('realServiceForm');
        const methodContainer = document.getElementById('methodContainer');
        
        document.getElementById('modalTitle').textContent = 'Izmeni Uslugu';
        
        // Putanja mora da se poklapa sa web.php (dodaj /admin ako je u grupi)
        form.action = `/admin/usluge/izmeni/${service.id}`; 
        methodContainer.innerHTML = '<input type="hidden" name="_method" value="PUT">';
        
        // Popunjavanje text polja
        document.getElementById('ServiceName').value = service.name;
        document.getElementById('ServicePrice').value = service.price;
        document.getElementById('ServiceDuration').value = service.duration_minutes;
        document.getElementById('ServiceDescription').value = service.description || '';
        
        // FIX za Toggle: Eksplicitna provera
        // Koristimo == 1 jer Laravel šalje 1/0, a ne true/false
        const isActive = (service.is_active == 1);
        const activeCheckbox = document.getElementById('ServiceActive');
        
        activeCheckbox.checked = isActive;

        currentServiceId = service.id;
        document.getElementById('serviceModal').showModal();
    }

    function closeServiceModal() {
        document.getElementById('serviceModal').close();
    }

    function openDeleteModal(serviceId, ServiceName) {
        const deleteForm = document.getElementById('deleteForm');
        document.getElementById('deleteServiceName').textContent = ServiceName;
        deleteForm.action = `/admin/usluge/obrisi/${serviceId}`; 
        document.getElementById('deleteModal').showModal();
    }
</script>
</x-app-layout>