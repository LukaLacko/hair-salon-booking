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
    <div class="min-h-screen bg-base-200 p-4 md:p-6">
        <div class="mx-auto max-w-7xl space-y-6">
            
            {{-- Header --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="space-y-2">
                    <h1 class="text-2xl md:text-3xl font-bold">Upravljanje Klijentima</h1>
                    <p class="text-base-content/60">Upravljaj svojim kiljentima i informacijama.</p>
                </div>
                <button class="btn btn-primary w-full md:w-auto" onclick="openAddModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Dodaj novog Klijenta
                </button>
            </div>

            {{-- Stats Cards --}}
            <div class="grid gap-4 grid-cols-2 lg:grid-cols-4">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body p-4 md:p-6">
                        <div class="flex items-center justify-between">
                            <h2 class="card-title text-xs md:text-sm font-medium">Ukupno Klijenata</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="text-xl md:text-2xl font-bold">{{ $totalClients }}</div>
                        <p class="text-xs opacity-60">Evidentiranih klijenta</p>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body p-4 md:p-6">
                        <div class="flex items-center justify-between">
                            <h2 class="card-title text-xs md:text-sm font-medium">Novih Ovog Meseca</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <div class="text-xl md:text-2xl font-bold">
                            {{ $totalClientsThisMonth }}
                        </div>
                        <p class="text-xs opacity-60">Od {{ $thisMonth }} 1, {{ $thisYear }}</p>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body p-4 md:p-6">
                        <div class="flex items-center justify-between">
                            <h2 class="card-title text-xs md:text-sm font-medium">Sa Napomenama</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="text-xl md:text-2xl font-bold">
                            {{ $totalWithNotes }}
                        </div>
                        <p class="text-xs opacity-60">Klijenti sa napomenama</p>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body p-4 md:p-6">
                        <div class="flex items-center justify-between">
                            <h2 class="card-title text-xs md:text-sm font-medium">Sa Nalogom</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div class="text-xl md:text-2xl font-bold">
                            {{ $totalWithEmail }}
                        </div>
                        <p class="text-xs opacity-60">Sa emailom</p>
                    </div>
                </div>
            </div>

            {{-- Search and Filter --}}
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body p-4 md:p-6">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="form-control flex-1">
                            <div class="input-group">
                                <input type="text" placeholder="Search clients by name, email, or phone..." class="input input-bordered w-full" id="searchInput" onkeyup="searchClients()" />
                                <button class="btn btn-square">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-ghost" onclick="clearSearch()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reset
                        </button>
                    </div>
                </div>
            </div>

            {{-- Clients Table - Desktop View --}}
            <div class="card bg-base-100 shadow-xl hidden md:block">
                <div class="card-body">
                    <h2 class="card-title mb-4">Svi Klijenti</h2>
                    
                    <div class="overflow-x-auto">
                        <table class="table table-zebra" id="clientsTable">
                            <thead>
                                <tr>
                                    <th>Klijent</th>
                                    <th>Kontakt</th>
                                    <th>Napomena</th>
                                    <th>Klijent od</th>
                                    <th class="text-right">Opcije</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                <tr class="client-row">
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar placeholder">
                                                <div class="bg-neutral text-neutral-content rounded-full w-8 h-8 flex items-center justify-center">
                                                    <span class="text-xs font-semibold uppercase leading-none">
                                                        {{ substr($client->name, 0, 2) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-bold">{{ $client->name }}</div>
                                                <div class="text-sm opacity-50">ID: #{{ str_pad($client->id, 4, '0', STR_PAD_LEFT) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2 text-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                                {{ $client->email }}
                                            </div>
                                            <div class="flex items-center gap-2 text-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                                {{ $client->phone }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if(!empty($client->notes))
                                            <div class="max-w-xs truncate" title="{{ $client['notes'] }}">
                                                {{ $client->notes }}
                                            </div>
                                        @else
                                            <span class="text-sm opacity-50">Nema napomena</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $client->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="text-right">
                                        <div class="flex gap-2 justify-end">
                                            <button class="btn btn-sm btn-info" onclick='openEditModal(@json($client))'>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Izmeni
                                            </button>
                                            <button class="btn btn-sm btn-error" onclick="openDeleteModal({{ $client['id'] }}, '{{ $client['name'] }}')">
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
                </div>
            </div>

            {{-- Clients Cards - Mobile View --}}
            <div class="grid gap-4 md:hidden" id="clientsCards">
                @foreach($clients as $client)
                <div class="card bg-base-100 shadow-xl client-card">
                    <div class="card-body">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-3">
                                <div class="avatar placeholder">
                                    <div class="bg-neutral text-neutral-content rounded-full w-8 h-8 flex items-center justify-center">
                                        <span class="text-xs font-semibold uppercase leading-none">
                                            {{ substr($client->name, 0, 2) }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="font-bold">{{ $client['name'] }}</h3>
                                    <p class="text-xs opacity-50">ID: #{{ str_pad($client->id, 4, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="divider my-2"></div>

                        <div class="space-y-2">
                            <div class="flex items-center gap-2 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="break-all">{{ $client->email }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                {{ $client->phone }}
                            </div>
                            @if(!empty($client->notes))
                            <div class="flex items-start gap-2 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="opacity-70">{{ $client->notes }}</span>
                            </div>
                            @endif
                            <div class="flex items-center gap-2 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Klijent od {{ $client->created_at->format('M d, Y') }}
                            </div>
                        </div>

                        <div class="card-actions justify-end mt-4">
                            <button class="btn btn-sm btn-info flex-1" onclick='openEditModal(@json($client))'>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Izmeni
                            </button>
                            <button class="btn btn-sm btn-error flex-1" onclick="openDeleteModal({{ $client['id'] }}, '{{ $client['name'] }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Obriši
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>

    {{-- Add/Edit Client Modal --}}
    <dialog id="clientModal" class="modal">
        <div class="modal-box w-11/12 max-w-2xl">
            <h3 class="font-bold text-lg mb-4" id="modalTitle">Dodaj Novog Klijenta</h3>
            
            <form method="POST" id="clientForm">
                @csrf
                <div id="methodField"></div>
                <div class="space-y-4">
                    
                    {{-- Name --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Ime i Prezime * </span>
                        </label>
                        <input type="text" placeholder="npr. Milan Ivanović" class="input input-bordered" name="name" id="clientName" required />
                        <label class="label hidden" id="nameError">
                            <span class="label-text-alt text-error"></span>
                        </label>
                    </div>

                    {{-- Email --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Email Adresa:</span>
                        </label>
                        <input type="email" placeholder="npr.  milan@gmail.com" class="input input-bordered" name="email" id="clientEmail" required />
                        <label class="label">
                            <span class="label-text-alt text-sm">Opciono</span>
                        </label>
                        <label class="label hidden" id="emailError">
                            <span class="label-text-alt text-error"></span>
                        </label>
                    </div>

                    {{-- Phone --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Broj Telefona: </span>
                        </label>
                        <input type="tel" placeholder="npr. 062------" class="input input-bordered" name="phone" id="clientPhone" required />
                        <label class="label">
                            <span class="label-text-alt text-sm">Opciono</span>
                        </label>
                        <label class="label hidden" id="phoneError">
                            <span class="label-text-alt text-error"></span>
                        </label>
                    </div>

                    {{-- Notes --}}
                    <div class="form-control flex">
                        <label class="label">
                            <span class="label-text">Napomene: </span>
                        </label>
                        <div class="flex-column">
                            <textarea class="textarea textarea-bordered h-24" placeholder="Specijalne napomene o klijentu (dodatni podaci, šta mu smeta...)" name="notes" id="clientNotes"></textarea>
                        <label class="label">
                            <span class="label-text-alt text-sm">(Opciono - Dodaj relevantne informacije)</span>
                        </label>
                        </div>

                    </div>
                </div>

                <div class="modal-action">
                    <button type="button" class="btn btn-ghost" onclick="closeClientModal()">Nazad</button>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Sačuvaj Klijenta
                    </button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>nazad</button>
        </form>
    </dialog>

    {{-- Delete Confirmation Modal --}}
    <dialog id="deleteModal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg text-error">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                Potvrdi Brisanje
            </h3>
            <p class="py-4">
                Da li si siguran da želiš obrisati ovog klijenta<strong>"<span id="deleteClientName"></span>"</strong>?
                <br><br>
                <span class="text-warning">⚠️ Napomena: Brisanje klijenta može uticati na statistiku. Savetujemo brisanje samo na lični zahtev klijenta.</span>
            </p>
            <div class="modal-action">
                <form method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-ghost" onclick="document.getElementById('deleteModal').close()">Nazad</button>
                    <button class="btn btn-error" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Da, Obriši Klijenta
                    </button>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>nazad</button>
        </form>
    </dialog>

    <script>
        let currentClientId = null;
        let deleteClientId = null;


        // Open Add Modal
        function openAddModal() {
            document.getElementById('modalTitle').textContent = 'Dodaj Novog Klijenta';
            document.getElementById('clientName').value = '';
            document.getElementById('clientEmail').value = '';
            document.getElementById('clientPhone').value = '';
            document.getElementById('clientNotes').value = '';
            currentClientId = null;
            document.getElementById('clientModal').showModal();
        }

        // Open Edit Modal
        function openEditModal(client) {
            const form = document.getElementById('clientForm');
            form.action = `/admin/klijenti/izmeni/${client.id}`;
            document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';

            document.getElementById('modalTitle').textContent = 'Izmeni Klijenta';
            document.getElementById('clientName').value = client.name;
            document.getElementById('clientEmail').value = client.email;
            document.getElementById('clientPhone').value = client.phone;
            document.getElementById('clientNotes').value = client.notes || '';
            currentClientId = client.id;
            document.getElementById('clientModal').showModal();
        }

        // Close Client Modal
        function closeClientModal() {
            document.getElementById('clientModal').close();
        }

        // Save Client with Validation
        function saveClient() {
            const form = document.getElementById('clientForm');
            form.action = `/admin/klijenti/dodaj`;
            document.getElementById('methodField').innerHTML = '';

            const name = document.getElementById('clientName').value.trim();
            const email = document.getElementById('clientEmail').value.trim();
            const phone = document.getElementById('clientPhone').value.trim();
            const notes = document.getElementById('clientNotes').value.trim();
            
            // Close modal
            closeClientModal();
            

        }

        // Open Delete Modal
        function openDeleteModal(clientId, clientName) {
            const form = document.getElementById('deleteForm');
            form.action = `/admin/klijenti/obrisi/${clientId}`;
            document.getElementById('deleteClientName').textContent = clientName;
            document.getElementById('deleteModal').showModal();
        }

        // Confirm Delete
        function confirmDelete() {
        
            
            // Close modal
            document.getElementById('deleteModal').close();

        }
    </script>
</x-app-layout>
