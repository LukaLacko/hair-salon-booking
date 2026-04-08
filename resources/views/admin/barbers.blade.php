<x-app-layout>
    {{-- @php
        // Hardcoded Barbers Data - Change these values
        $barbers = [
            [
                'id' => 1,
                'user_id' => 101,
                'name' => 'Marcus Johnson',
                'bio' => 'Master barber with 10+ years of experience. Specializes in classic cuts and modern fades.',
                'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=300&fit=crop',
                'is_available' => true,
                'working_hours' => [
                    ['day_of_week' => 'Monday', 'start_time' => '09:00', 'end_time' => '18:00', 'is_day_off' => false],
                    ['day_of_week' => 'Tuesday', 'start_time' => '09:00', 'end_time' => '18:00', 'is_day_off' => false],
                    ['day_of_week' => 'Wednesday', 'start_time' => '09:00', 'end_time' => '18:00', 'is_day_off' => false],
                    ['day_of_week' => 'Thursday', 'start_time' => '09:00', 'end_time' => '18:00', 'is_day_off' => false],
                    ['day_of_week' => 'Friday', 'start_time' => '09:00', 'end_time' => '18:00', 'is_day_off' => false],
                    ['day_of_week' => 'Saturday', 'start_time' => '10:00', 'end_time' => '16:00', 'is_day_off' => false],
                    ['day_of_week' => 'Sunday', 'start_time' => '', 'end_time' => '', 'is_day_off' => true],
                ]
            ],
            [
                'id' => 2,
                'user_id' => 102,
                'name' => 'David Chen',
                'bio' => 'Award-winning stylist known for creative designs and attention to detail.',
                'photo' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300&h=300&fit=crop',
                'is_available' => true,
                'working_hours' => [
                    ['day_of_week' => 'Monday', 'start_time' => '10:00', 'end_time' => '19:00', 'is_day_off' => false],
                    ['day_of_week' => 'Tuesday', 'start_time' => '10:00', 'end_time' => '19:00', 'is_day_off' => false],
                    ['day_of_week' => 'Wednesday', 'start_time' => '10:00', 'end_time' => '19:00', 'is_day_off' => false],
                    ['day_of_week' => 'Thursday', 'start_time' => '10:00', 'end_time' => '19:00', 'is_day_off' => false],
                    ['day_of_week' => 'Friday', 'start_time' => '10:00', 'end_time' => '19:00', 'is_day_off' => false],
                    ['day_of_week' => 'Saturday', 'start_time' => '', 'end_time' => '', 'is_day_off' => true],
                    ['day_of_week' => 'Sunday', 'start_time' => '', 'end_time' => '', 'is_day_off' => true],
                ]
            ],
            [
                'id' => 3,
                'user_id' => 103,
                'name' => 'James Wilson',
                'bio' => 'Traditional barber specializing in hot towel shaves and classic gentleman cuts.',
                'photo' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=300&h=300&fit=crop',
                'is_available' => false,
                'working_hours' => [
                    ['day_of_week' => 'Monday', 'start_time' => '08:00', 'end_time' => '17:00', 'is_day_off' => false],
                    ['day_of_week' => 'Tuesday', 'start_time' => '08:00', 'end_time' => '17:00', 'is_day_off' => false],
                    ['day_of_week' => 'Wednesday', 'start_time' => '08:00', 'end_time' => '17:00', 'is_day_off' => false],
                    ['day_of_week' => 'Thursday', 'start_time' => '08:00', 'end_time' => '17:00', 'is_day_off' => false],
                    ['day_of_week' => 'Friday', 'start_time' => '08:00', 'end_time' => '17:00', 'is_day_off' => false],
                    ['day_of_week' => 'Saturday', 'start_time' => '09:00', 'end_time' => '15:00', 'is_day_off' => false],
                    ['day_of_week' => 'Sunday', 'start_time' => '', 'end_time' => '', 'is_day_off' => true],
                ]
            ],
            [
                'id' => 4,
                'user_id' => 104,
                'name' => 'Christopher Lee',
                'bio' => 'Young and talented barber bringing fresh perspective to modern hairstyles.',
                'photo' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=300&h=300&fit=crop',
                'is_available' => true,
                'working_hours' => [
                    ['day_of_week' => 'Monday', 'start_time' => '11:00', 'end_time' => '20:00', 'is_day_off' => false],
                    ['day_of_week' => 'Tuesday', 'start_time' => '11:00', 'end_time' => '20:00', 'is_day_off' => false],
                    ['day_of_week' => 'Wednesday', 'start_time' => '', 'end_time' => '', 'is_day_off' => true],
                    ['day_of_week' => 'Thursday', 'start_time' => '11:00', 'end_time' => '20:00', 'is_day_off' => false],
                    ['day_of_week' => 'Friday', 'start_time' => '11:00', 'end_time' => '20:00', 'is_day_off' => false],
                    ['day_of_week' => 'Saturday', 'start_time' => '11:00', 'end_time' => '20:00', 'is_day_off' => false],
                    ['day_of_week' => 'Sunday', 'start_time' => '12:00', 'end_time' => '18:00', 'is_day_off' => false],
                ]
            ],
        ];
    @endphp --}}
    {{-- Main Content --}}
    <div class="min-h-screen bg-base-200 p-6">
        <div class="mx-auto max-w-7xl space-y-6">
            
            {{-- Header --}}
            <div class="flex items-center justify-between">
                <div class="space-y-2">
                    <h1 class="text-3xl font-bold">Upravljanje Frizerima</h1>
                    <p class="text-base-content/60">Upravljaj svojim timom frizera</p>
                </div>
                <button class="btn btn-primary" onclick="openAddModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Dodaj novog Frizer
                </button>
            </div>

            {{-- Stats Cards --}}
            <div class="grid gap-4 md:grid-cols-4">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <h2 class="card-title text-sm font-medium">Ukuono Frizera</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold">{{ $totalBarbers }}</div>
                        <p class="text-xs opacity-60">Članovi Tima</p>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <h2 class="card-title text-sm font-medium">Dostupni</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold">{{ collect($barbers)->where('is_available', true)->count() }}</div>
                        <p class="text-xs opacity-60">Trenutno dostupni</p>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <h2 class="card-title text-sm font-medium">Na Pauzi</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold">{{ collect($barbers)->where('is_available', false)->count() }}</div>
                        <p class="text-xs opacity-60">Nedostupni</p>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <h2 class="card-title text-sm font-medium">Prosek radnih dana</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold">
                            {{ $avgDaysOff }}
                        </div>
                        <p class="text-xs opacity-60">Dana u nedelji</p>
                    </div>
                </div>
            </div>

            {{-- Barbers Grid --}}
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($barbers as $barber)
                <div class="card bg-base-100 shadow-xl">
                    <figure class="px-10 pt-10">
                        <div class="avatar">
                            <div class="w-32 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img src="{{ $barber->photo ? asset('storage/' . $barber->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($barber->name) }}" alt="Avatar Tailwind CSS Component" />
                            </div>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h2 class="card-title">{{ $barber['name'] }}</h2>
                        
                        @if($barber['is_available'])
                            <div class="badge badge-success gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Dostupan
                            </div>
                        @else
                            <div class="badge badge-warning gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Na Pauzi
                            </div>
                        @endif

                        <p class="text-sm opacity-70 mt-2">{{ $barber['bio'] }}</p>
                        
                        {{-- Working Days Summary --}}
                        <div class="divider">Radni Dani</div>
                        <div class="flex flex-wrap gap-1 justify-center">
                            @foreach($barber['workingHours'] as $hours)
                                @if(!$hours['is_day_off'])
                                    <div class="badge badge-outline badge-sm">
                                        {{ mb_substr($hours->day_name, 0, 3) }}
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="card-actions justify-center mt-4 w-full">
                            <button class="btn btn-info btn-sm flex-1" onclick='openEditModal({!! json_encode($barber) !!}, {!! json_encode($barber->workingHours) !!})'>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Izmeni
                            </button>
                            <button class="btn btn-error btn-sm flex-1" onclick="openDeleteModal({{ $barber['id'] }}, '{{ $barber['name'] }}')">
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

{{-- Add/Edit Barber Modal --}}
<dialog id="barberModal" class="modal">
    <div class="modal-box w-11/12 max-w-4xl max-h-[90vh] overflow-y-auto">
        <h3 class="font-bold text-lg mb-4" id="modalTitle">Dodaj novog Frizera</h3>
        
        <form id="barberForm" method="POST" action="">
            @csrf
            <div id="methodField"></div>

            <div class="space-y-4">
                <div class="bg-base-200 p-4 rounded-lg space-y-4">
                    <h4 class="font-semibold text-md">Osnovne Informacije</h4>
                    
                    <div class="form-control">
                        <label class="label"><span class="label-text">User ID</span></label>
                        <input type="number" class="input input-bordered" id="barberUserId" name="user_id" required/>
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Ime i Prezime</span></label>
                        <input type="text" class="input input-bordered" id="barberName" name="name" required/>
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Bio</span></label>
                        <textarea class="textarea textarea-bordered h-24" id="barberBio" name="bio"></textarea>
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Ime Slike</span></label>
                        <input type="text" class="input input-bordered" id="barberPhoto" name="photo"/>
                    </div>

                    <div class="form-control">
                        <label class="label cursor-pointer justify-start gap-4">
                            <input type="checkbox" class="toggle toggle-success" id="barberAvailable" name="is_active" value="1" checked/>
                            <span class="label-text">Frizer je Aktivan</span>
                        </label>
                    </div>
                </div>

                {{-- Radno vreme --}}
                <div class="bg-base-200 p-4 rounded-lg space-y-4">
                    <h4 class="font-semibold text-md">Radni Sati</h4>
                    
                    @php
                        $daysOfWeek = [
                            0 => 'Nedelja',
                            1 => 'Ponedeljak',
                            2 => 'Utorak',
                            3 => 'Sreda',
                            4 => 'Četvrtak',
                            5 => 'Petak',
                            6 => 'Subota'
                        ];
                    @endphp

                    @foreach($daysOfWeek as $index => $dayName)
                    <div class="border border-base-300 p-3 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-3 items-center">
                            <div class="font-medium">{{ $dayName }}</div>
                            
                            <div class="form-control">
                                <label class="label"><span class="label-text text-xs">Početak</span></label>
                                <input type="time" class="input input-bordered input-sm" 
                                    name="working_hours[{{ $index }}][start_time]"
                                    id="start_{{ $index }}"/>
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text text-xs">Kraj</span></label>
                                <input type="time" class="input input-bordered input-sm" 
                                    name="working_hours[{{ $index }}][end_time]"
                                    id="end_{{ $index }}"/>
                            </div>

                            <div class="form-control">
                                <label class="label cursor-pointer justify-start gap-2">
                                    <input type="checkbox" class="checkbox checkbox-sm" 
                                        name="working_hours[{{ $index }}][is_day_off]"
                                        id="dayoff_{{ $index }}" 
                                        value="1"
                                        onchange="toggleDayOff({{ $index }})"/>
                                    <span class="label-text text-xs">Slobodan dan</span>
                                </label>
                                {{-- Skriveno polje da znamo koji je dan --}}
                                <input type="hidden" name="working_hours[{{ $index }}][day_of_week]" value="{{ $index }}"/>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="modal-action">
                <button type="button" class="btn btn-ghost" onclick="closeBarberModal()">Nazad</button>
                <button type="submit" class="btn btn-primary">Sačuvaj Frizera</button>
            </div>
        </form>
    </div>
</dialog>

{{-- Delete Modal --}}
<dialog id="deleteModal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Potvrdi Brisanje</h3>
        <p class="py-4">Da li želiš da obrišeš frizera "<span id="deleteBarberName" class="font-semibold"></span>"?</p>
        <div class="modal-action">
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-ghost" 
                    onclick="document.getElementById('deleteModal').close()">Nazad</button>
                <button type="submit" class="btn btn-error">Obriši</button>
            </form>
        </div>
    </div>
</dialog>

<script>
    function toggleDayOff(index) {
        const dayOff = document.getElementById(`dayoff_${index}`);
        const start = document.getElementById(`start_${index}`);
        const end = document.getElementById(`end_${index}`);
        
        if (dayOff.checked) {
            start.disabled = true;
            end.disabled = true;
            start.value = '';
            end.value = '';
        } else {
            start.disabled = false;
            end.disabled = false;
        }
    }

    function openAddModal() {
        const form = document.getElementById('barberForm');
        form.action = "/admin/frizeri/dodaj";
        document.getElementById('methodField').innerHTML = '';
        document.getElementById('modalTitle').textContent = 'Dodaj novog Frizera';
        
        // Reset polja
        document.getElementById('barberUserId').value = '';
        document.getElementById('barberName').value = '';
        document.getElementById('barberBio').value = '';
        document.getElementById('barberPhoto').value = '';
        document.getElementById('barberAvailable').checked = true;
        
        // Reset radnog vremena
        for(let i = 0; i <= 6; i++) {
            document.getElementById(`start_${i}`).value = '';
            document.getElementById(`end_${i}`).value = '';
            document.getElementById(`dayoff_${i}`).checked = false;
            document.getElementById(`start_${i}`).disabled = false;
            document.getElementById(`end_${i}`).disabled = false;
        }
        
        document.getElementById('barberModal').showModal();
    }

    function openEditModal(barber, workingHours) {
        const form = document.getElementById('barberForm');
        console.log("Podaci stigli:", barber);
        console.log("Sati stigli:", workingHours);
        
        // Promeni akciju na update rutu
        form.action = `/admin/frizeri/izmeni/${barber.id}`;
        document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        document.getElementById('modalTitle').textContent = 'Izmeni Frizera';
        
        // Popuni polja sa podacima frizera
        document.getElementById('barberUserId').value = barber.user_id;
        document.getElementById('barberName').value = barber.name;
        document.getElementById('barberBio').value = barber.bio || '';
        document.getElementById('barberPhoto').value = barber.photo || '';
        document.getElementById('barberAvailable').checked = barber.is_active == 1;
        
        // Popuni radno vreme
        workingHours.forEach(wh => {
            const i = wh.day_of_the_week;
            document.getElementById(`start_${i}`).value = wh.start_time || '';
            document.getElementById(`end_${i}`).value = wh.end_time || '';
            document.getElementById(`dayoff_${i}`).checked = wh.is_day_off == 1;
            toggleDayOff(i);
        });
        
        document.getElementById('barberModal').showModal();
    }

    function closeBarberModal() {
        document.getElementById('barberModal').close();
    }

    function openDeleteModal(barberId, barberName) {
        document.getElementById('deleteBarberName').textContent = barberName;
        document.getElementById('deleteForm').action = `/admin/frizeri/obrisi/${barberId}`;
        document.getElementById('deleteModal').showModal();
    }
</script>
</x-app-layout>