<!DOCTYPE html>
<html lang="sr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zakaži Termin - Frizerski Salon</title>
    
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-gradient { background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); }
        .gold-gradient { background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); }

        .barber-card, .service-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .barber-card:hover, .service-card:hover {
            transform: translateY(-4px);
        }
        .barber-card.selected {
            border: 3px solid #fbbf24;
            box-shadow: 0 0 20px rgba(251, 191, 36, 0.3);
        }
        .service-card.selected {
            border: 3px solid #fbbf24;
            background: #fffbeb;
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="navbar bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex-1">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 gold-gradient rounded-lg flex items-center justify-center shadow-lg">
                        <i class="fas fa-cut text-slate-800 text-lg"></i>
                    </div>
                    <span class="text-xl font-bold text-slate-800">FrizerskiSalon</span>
                </div>
            </div>
            <div class="flex-none">
                <a href="/" class="btn btn-ghost text-slate-700">
                    <i class="fas fa-arrow-left"></i> Nazad
                </a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Progress Steps -->
        <div class="mb-8">
            <ul class="steps steps-horizontal w-full">
                <li id="progress-step-1" class="step step-warning">Izaberi Frizera</li>
                <li id="progress-step-2" class="step">Izaberi Uslugu</li>
                <li id="progress-step-3" class="step">Izaberi Datum i Vreme</li>
                <li id="progress-step-4" class="step">Potvrdi Termin</li>
            </ul>
        </div>

        <div class="card bg-white shadow-2xl">
            <div class="card-body p-6 lg:p-10">
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <!-- Step 1 -->
                <div id="step-1" class="booking-step">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl lg:text-4xl font-bold text-slate-800 mb-2">Izaberi Svog Frizera</h2>
                        <p class="text-gray-600">Izaberi majstora iz našeg tima</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        @foreach($barbers as $barber)
                            <div class="barber-card bg-white border-2 border-gray-200 rounded-xl overflow-hidden shadow-sm"
                                 data-barber-id="{{ $barber->id }}"
                                 data-barber-name="{{ $barber->name }}">
                                <div class="relative">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($barber->name) }}&background=1e293b&color=fbbf24&size=400&bold=true" 
                                         alt="{{ $barber->name }}" class="w-full h-48 object-cover">
                                    <div class="absolute top-3 right-3">
                                        <div class="badge badge-warning gap-1">
                                            <i class="fas fa-star"></i> 4.9
                                        </div>
                                    </div>
                                    <div class="absolute top-3 left-3 barber-check hidden">
                                        <div class="w-8 h-8 bg-warning rounded-full flex items-center justify-center shadow-md">
                                            <i class="fas fa-check text-slate-800"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <h3 class="text-xl font-bold text-slate-800">{{ $barber->name }}</h3>
                                    <p class="text-sm text-gray-600">Frizer • 10 godina iskustva</p>
                                    <p class="text-xs text-gray-500 mt-2">{{ $barber->bio ?? 'Profesionalac sa dugogodišnjim iskustvom.' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-end">
                        <button id="next-step-1" class="btn btn-warning btn-lg text-slate-800" disabled onclick="nextStep(2)">
                            Nastavi <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2 -->
                <div id="step-2" class="booking-step hidden">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl lg:text-4xl font-bold text-slate-800 mb-2">Izaberi Uslugu</h2>
                        <p class="text-gray-600">Odaberi uslugu koju želiš</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        @foreach($services as $service)
                            <div class="service-card bg-white border-2 border-gray-200 rounded-xl p-6 shadow-sm"
                                 data-service-id="{{ $service->id }}"
                                 data-service-name="{{ $service->name }}"
                                 data-duration="{{ $service->duration_minutes }}"
                                 data-price="{{ $service->price }}">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-slate-800">{{ $service->name }}</h3>
                                        <p class="text-gray-600 mt-1">{{ $service->description }}</p>
                                        <div class="flex items-center gap-4 mt-4">
                                            <div class="text-sm font-medium text-gray-500">
                                                <i class="far fa-clock text-warning mr-1"></i> {{ $service->duration_minutes }} min
                                            </div>
                                            <div class="font-bold text-2xl text-slate-800">
                                                {{ number_format($service->price, 0, ',', '.') }} din
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-16 h-16 bg-slate-800 rounded-xl flex items-center justify-center shrink-0 ml-4">
                                        <i class="fas fa-cut text-yellow-400 text-3xl"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-between">
                        <button class="btn btn-ghost btn-lg" onclick="prevStep(1)">
                            <i class="fas fa-arrow-left"></i> Nazad
                        </button>
                        <button id="next-step-2" class="btn btn-warning btn-lg text-slate-800" disabled onclick="nextStep(3)">
                            Nastavi <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 3 -->
                <div id="step-3" class="booking-step hidden">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl lg:text-4xl font-bold text-slate-800 mb-2">Izaberi Datum i Vreme</h2>
                        <p class="text-gray-600">Izaberi kombinaciju koja ti najviše odgovara</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                        
                        <!-- Kalendar -->
                        <div>
                            <h3 class="font-bold text-lg text-slate-800 mb-4">Izaberi Datum</h3>
                            <div class="bg-slate-900 rounded-xl p-6 text-white shadow-xl border border-slate-800">
                                <!-- Navigacija kroz mesece -->
                                <div class="flex justify-between items-center mb-6">
                                    <button type="button" onclick="changeMonth(-1)" class="btn btn-circle btn-sm btn-ghost text-white hover:bg-white/10">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <div id="current-month-year" class="font-bold text-md text-warning uppercase tracking-wider">
                                        <!-- Generiše JS (npr. JUN 2026) -->
                                    </div>
                                    <button type="button" onclick="changeMonth(1)" class="btn btn-circle btn-sm btn-ghost text-white hover:bg-white/10">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                                
                                <!-- Nazivi dana u nedelji -->
                                <div class="grid grid-cols-7 gap-2 text-center text-xs font-bold text-gray-400 mb-2">
                                    <div>Pon</div><div>Uto</div><div>Sre</div><div>Čet</div><div>Pet</div><div>Sub</div><div>Ned</div>
                                </div>
                        
                                <!-- Mreža dana koju puni JS -->
                                <div id="kalendar-dani" class="grid grid-cols-7 gap-2 text-center">
                                    <!-- JavaScript ubacuje dugmiće ovde -->
                                </div>
                            </div>
                        </div>

                        <!-- Vremenski slotovi -->
                        <div>
                            <h3 class="font-bold text-lg text-slate-800 mb-4">Dostupni termini</h3>
                            <div class="space-y-4">
                                
                                <div>
                                    <div class="text-xs text-gray-500 mb-2 font-bold uppercase tracking-wider">Ujutru</div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <label class="cursor-pointer">
                                            <input type="radio" name="time" value="09:00" class="peer hidden" onchange="selectTime(this.value)">
                                            <div class="bg-slate-800 text-white py-3 rounded-lg text-sm text-center font-medium transition-all hover:bg-slate-700 peer-checked:bg-warning peer-checked:text-slate-800 peer-checked:font-bold shadow-sm">09:00</div>
                                        </label>
                                        <label class="cursor-pointer">
                                            <input type="radio" name="time" value="09:30" class="peer hidden" onchange="selectTime(this.value)">
                                            <div class="bg-slate-800 text-white py-3 rounded-lg text-sm text-center font-medium transition-all hover:bg-slate-700 peer-checked:bg-warning peer-checked:text-slate-800 peer-checked:font-bold shadow-sm">09:30</div>
                                        </label>
                                        <label class="cursor-pointer">
                                            <input type="radio" name="time" value="10:00" class="peer hidden" onchange="selectTime(this.value)">
                                            <div class="bg-slate-800 text-white py-3 rounded-lg text-sm text-center font-medium transition-all hover:bg-slate-700 peer-checked:bg-warning peer-checked:text-slate-800 peer-checked:font-bold shadow-sm">10:00</div>
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <div class="text-xs text-gray-500 mb-2 font-bold uppercase tracking-wider">Popodne</div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <label class="cursor-pointer">
                                            <input type="radio" name="time" value="13:00" class="peer hidden" onchange="selectTime(this.value)">
                                            <div class="bg-slate-800 text-white py-3 rounded-lg text-sm text-center font-medium transition-all hover:bg-slate-700 peer-checked:bg-warning peer-checked:text-slate-800 peer-checked:font-bold shadow-sm">13:00</div>
                                        </label>
                                        <label class="cursor-pointer">
                                            <input type="radio" name="time" value="14:30" class="peer hidden" onchange="selectTime(this.value)">
                                            <div class="bg-slate-800 text-white py-3 rounded-lg text-sm text-center font-medium transition-all hover:bg-slate-700 peer-checked:bg-warning peer-checked:text-slate-800 peer-checked:font-bold shadow-sm">14:30</div>
                                        </label>
                                        <label class="cursor-pointer">
                                            <input type="radio" name="time" value="15:30" class="peer hidden" onchange="selectTime(this.value)">
                                            <div class="bg-slate-800 text-white py-3 rounded-lg text-sm text-center font-medium transition-all hover:bg-slate-700 peer-checked:bg-warning peer-checked:text-slate-800 peer-checked:font-bold shadow-sm">15:30</div>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <button type="button" class="btn btn-ghost btn-lg" onclick="prevStep(2)">
                            <i class="fas fa-arrow-left"></i> Nazad
                        </button>
                        <button id="next-step-3" class="btn btn-warning btn-lg text-slate-800" disabled onclick="nextStep(4)">
                            Nastavi <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 4 -->
                <div id="step-4" class="booking-step hidden">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-slate-800">Potvrdi Termin</h2>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Summary -->
                        <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl p-6 text-white shadow-xl">
                            <h3 class="font-bold text-lg mb-4 text-warning tracking-wide">Detalji Termina</h3>
                            <div class="space-y-4">
                                <div class="flex gap-4 items-center">
                                    <div class="w-12 h-12 bg-white/10 rounded-lg flex items-center justify-center text-warning text-lg shrink-0">
                                        <i class="fas fa-user-tie"></i>                                    
                                    </div>
                                    <div>
                                        <div class="text-gray-400 text-xs uppercase font-bold tracking-wider">Frizer</div>
                                        <div id="summary-barber" class="font-semibold text-lg text-slate-100">-</div>
                                    </div>
                                </div>
                                <div class="flex gap-4 items-center">
                                    <div class="w-12 h-12 bg-white/10 rounded-lg flex items-center justify-center text-warning text-lg shrink-0">
                                        <i class="fas fa-cut"></i>
                                    </div>
                                    <div>
                                        <div class="text-gray-400 text-xs uppercase font-bold tracking-wider">Usluga</div>
                                        <div id="summary-service" class="font-semibold text-lg text-slate-100">-</div>
                                    </div>
                                </div>
                                <div class="flex gap-4 items-center">
                                    <div class="w-12 h-12 bg-white/10 rounded-lg flex items-center justify-center text-warning text-lg shrink-0">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <div>
                                        <div class="text-gray-400 text-xs uppercase font-bold tracking-wider">Datum</div>
                                        <div id="summary-date" class="font-semibold text-lg text-slate-100">-</div>
                                    </div>
                                </div>
                                <div class="flex gap-4 items-center">
                                    <div class="w-12 h-12 bg-white/10 rounded-lg flex items-center justify-center text-warning text-lg shrink-0">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <div class="text-gray-400 text-xs uppercase font-bold tracking-wider">Vreme</div>
                                        <div id="summary-time" class="font-semibold text-lg text-slate-100">-</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 pt-6 border-t border-slate-700/50">
                                <div class="flex justify-between items-center text-lg">
                                    <span class="text-gray-300">Ukupno za uplatu:</span>
                                    <span id="summary-price" class="font-extrabold text-3xl text-warning tracking-tight">0 din</span>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Form -->
                        <div>
                            <h3 class="font-bold text-lg mb-4 text-slate-800">Tvoji Podaci</h3>
                            <form id="booking-form" class="space-y-4" onsubmit="event.preventDefault();">
                                @csrf
                                <input type="hidden" name="barber_id" id="input-barber-id">
                                <input type="hidden" name="service_id" id="input-service-id">
                                <input type="hidden" name="start_time" id="input-start-time">
                                <input type="hidden" name="name" id="input-name">
                                <input type="hidden" name="phone" id="input-phone">
                                <input type="hidden" name="email" id="input-email">

                                <div class="form-control">
                                    <label class="label"><span class="label-text font-semibold text-slate-700">Puno ime i prezime</span></label>
                                    <input type="text" id="client-name" placeholder="Ime Prezime" class="input input-bordered w-full focus:border-warning" required>
                                </div>
                                <div class="form-control">
                                    <label class="label"><span class="label-text font-semibold text-slate-700">Broj telefona</span></label>
                                    <input type="tel" id="client-phone" placeholder="062-1121-521" class="input input-bordered w-full focus:border-warning" required>
                                </div>
                                <div class="form-control">
                                    <label class="label"><span class="label-text font-semibold text-slate-700">Email (opciono)</span></label>
                                    <input type="email" id="client-email" placeholder="primer@gmail.com" class="input input-bordered w-full focus:border-warning">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button class="btn btn-ghost btn-lg" onclick="prevStep(3)">Nazad</button>
                        <button onclick="submitBooking()" class="btn btn-warning btn-lg text-slate-800 font-bold shadow-lg shadow-amber-500/20">
                            <i class="fas fa-check-circle"></i> Zakaži Termin
                        </button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <dialog id="success_modal" class="modal">
        <div class="modal-box text-center p-8">
            <div class="w-20 h-20 gold-gradient rounded-full mx-auto flex items-center justify-center mb-4 shadow-lg shadow-amber-500/30">
                <i class="fas fa-check text-4xl text-slate-800"></i>
            </div>
            <h3 class="text-2xl font-bold mb-2 text-slate-800">Termin uspešno zakazan!</h3>
            <p class="text-gray-600">Uspešno ste rezervisali termin. Detalje možete pogledati ispod.</p>
            <div class="mt-6">
                <button onclick="location.reload()" class="btn btn-warning w-full text-slate-800 font-bold">
                    Zakaži još jedan termin
                </button>
            </div>
        </div>
    </dialog>

    <script>
        // Glavni globalni objekat stanja
        let bookingData = {
            barberId: null,
            barberName: '',
            serviceId: null,
            serviceName: '',
            servicePrice: 0,
            serviceDuration: 0,
            date: '',
            time: ''
        };
    
        let selectedDateElement = null;
    
        // === Korak 1: Izbor frizera ===
        document.querySelectorAll('.barber-card').forEach(card => {
            card.addEventListener('click', function () {
                document.querySelectorAll('.barber-card').forEach(c => c.classList.remove('selected'));
                document.querySelectorAll('.barber-check').forEach(c => c.classList.add('hidden'));
    
                this.classList.add('selected');
                this.querySelector('.barber-check').classList.remove('hidden');
    
                bookingData.barberId = this.dataset.barberId;
                bookingData.barberName = this.dataset.barberName;
    
                document.getElementById('next-step-1').disabled = false;
            });
        });
    
        // === Korak 2: Izbor usluge ===
        document.querySelectorAll('.service-card').forEach(card => {
            card.addEventListener('click', function () {
                document.querySelectorAll('.service-card').forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
    
                bookingData.serviceId = this.dataset.serviceId;
                bookingData.serviceName = this.dataset.serviceName;
                bookingData.servicePrice = parseFloat(this.dataset.price);
                bookingData.serviceDuration = parseInt(this.dataset.duration);
    
                document.getElementById('next-step-2').disabled = false;
            });
        });
    
        // === Korak 3: Izbor datuma ===
        function selectDate(btn) {
            if (selectedDateElement) {
                selectedDateElement.classList.remove('bg-warning', 'text-slate-900', 'font-bold');
                selectedDateElement.classList.add('bg-white/5', 'text-white');
            }
    
            btn.classList.remove('bg-white/5', 'text-white');
            btn.classList.add('bg-warning', 'text-slate-900', 'font-bold');
            selectedDateElement = btn;
    
            bookingData.date = btn.dataset.date;
            checkDateTime();
        }
    
        // === Korak 3: Izbor vremena ===
        function selectTime(time) {
            bookingData.time = time;
            checkDateTime();
        }
    
        // Provera uslova za Korak 3
        function checkDateTime() {
            const nextBtn = document.getElementById('next-step-3');
            if (bookingData.date && bookingData.time) {
                nextBtn.disabled = false;
            } else {
                nextBtn.disabled = true;
            }
        }
    
        // === Navigacija kroz korake ===
        function nextStep(step) {
            document.querySelectorAll('.booking-step').forEach(s => s.classList.add('hidden'));
            document.getElementById(`step-${step}`).classList.remove('hidden');
    
            // Dinamičko ažuriranje progress bar-a
            document.querySelectorAll('.steps .step').forEach((s, i) => {
                if (i < step) {
                    s.classList.add('step-warning');
                } else {
                    s.classList.remove('step-warning');
                }
            });
    
            if (step === 4) {
                updateSummary();
            }
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    
        function prevStep(step) {
            nextStep(step);
        }
    
        // === Ažuriranje rezimea (Korak 4) ===
        function updateSummary() {
            document.getElementById('summary-barber').textContent = bookingData.barberName || '-';
            document.getElementById('summary-service').textContent = bookingData.serviceName || '-';
            document.getElementById('summary-time').textContent   = (bookingData.time || '-') + ' h';
            
            // Formatiranje cene na srpski način (sa tačkom za hiljade)
            const formattedPrice = new Intl.NumberFormat('sr-RS').format(bookingData.servicePrice || 0);
            document.getElementById('summary-price').textContent  = formattedPrice + ' din';

            // Pretvaranje YYYY-MM-DD u lepi DD.MM.YYYY format za klijenta
            if (bookingData.date) {
                const parts = bookingData.date.split('-');
                document.getElementById('summary-date').textContent = `${parts[2]}.${parts[1]}.${parts[0]}.`;
            } else {
                document.getElementById('summary-date').textContent = '-';
            }
        }
    
        // === Slanje na Laravel backend ===
        async function submitBooking() {
            const name  = document.getElementById('client-name').value.trim();
            const phone = document.getElementById('client-phone').value.trim();
            const email = document.getElementById('client-email').value.trim();
    
            if (!name || !phone) {
                alert('Molimo popunite sva obavezna polja (Ime i Broj telefona).');
                return;
            }
    
            if (!bookingData.barberId || !bookingData.serviceId || !bookingData.date || !bookingData.time) {
                alert('Nedostaju ključni podaci o terminu. Molimo vratite se nazad i izaberite ponovo.');
                return;
            }
    
            // Kombinovanje u format koji Carbon u Laravelu odmah prepoznaje (YYYY-MM-DD HH:mm)
            const startTime = `${bookingData.date} ${bookingData.time}`;
    
            // Punjenje skrivenih polja forme
            document.getElementById('input-barber-id').value = bookingData.barberId;
            document.getElementById('input-service-id').value = bookingData.serviceId;
            document.getElementById('input-start-time').value = startTime;
            document.getElementById('input-name').value = name;
            document.getElementById('input-phone').value = phone;
            document.getElementById('input-email').value = email;
    
            const formData = new FormData(document.getElementById('booking-form'));
    
            try {
                const response = await fetch('/zakazivanje', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                });
    
                if (!response.ok) {
                    throw new Error('Mrežna greška ili problem sa serverom.');
                }

                const result = await response.json();
    
                if (result.success) {
                    document.getElementById('success_modal').showModal();
                } else {
                    alert(result.message || 'Došlo je do greške prilikom rezervacije.');
                }
            } catch (e) {
                alert('Došlo je do neočekivane greške. Molimo pokušajte ponovo.');
                console.error(e);
            }
        }
        // Postavljamo trenutnu godinu i mesec na bazi današnjeg datuma
let currentDate = new Date();
let currentYear = currentDate.getFullYear();
let currentMonth = currentDate.getMonth(); // 0 = Januar, 11 = Decembar

// Pokreni generisanje kalendara odmah po učitavanju stranice
document.addEventListener("DOMContentLoaded", () => {
    renderCalendar();
});

function renderCalendar() {
    const calendarDays = document.getElementById("kalendar-dani");
    const monthYearLabel = document.getElementById("current-month-year");
    
    // Nazivi meseci za prikaz
    const months = [
        "Januar", "Februar", "Mart", "April", "Maj", "Jun", 
        "Jul", "Avgust", "Septembar", "Oktobar", "Novembar", "Decembar"
    ];
    
    monthYearLabel.textContent = `${months[currentMonth]} ${currentYear}`;
    calendarDays.innerHTML = ""; // Resetuj mrežu

    // Prvi dan u mesecu i ukupan broj dana
    const firstDayIndex = new Date(currentYear, currentMonth, 1).getDay();
    const totalDays = new Date(currentYear, currentMonth + 1, 0).getDate();
    
    // Prilagođavanje jer JS računa nedelju kao 0 (0=Ned, 1=Pon, 2=Uto...)
    // Mi želimo da ponedeljak bude prvi (0=Pon, 1=Uto... 6=Ned)
    let startOffset = firstDayIndex === 0 ? 6 : firstDayIndex - 1;

    // 1. Kreiranje praznih polja za dane iz prethodnog meseca
    for (let x = 0; x < startOffset; x++) {
        const emptyDiv = document.createElement("div");
        calendarDays.appendChild(emptyDiv);
    }

    // Današnji datum za poređenje (poništavamo vreme na 00:00:00 radi tačnog poređenja)
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    // 2. Generisanje dana tekućeg meseca
    for (let day = 1; day <= totalDays; day++) {
        const btn = document.createElement("button");
        btn.type = "button";
        btn.className = "datum-btn aspect-square rounded-lg text-sm font-semibold transition-all";
        btn.textContent = day;

        // Kreiranje punog YYYY-MM-DD formata za data-date atribut
        const formatDay = String(day).padStart(2, '0');
        const formatMonth = String(currentMonth + 1).padStart(2, '0');
        const dateString = `${currentYear}-${formatMonth}-${formatDay}`;
        btn.dataset.date = dateString;

        // Objekat datuma za ovaj konkretan dugmić
        const buttonDate = new Date(currentYear, currentMonth, day);
        buttonDate.setHours(0, 0, 0, 0);

        // PROVERA: Da li je dan u prošlosti?
        if (buttonDate < today) {
            btn.className += " text-gray-600 opacity-20 cursor-not-allowed";
            btn.disabled = true;
        } else {
            // Dan je aktuelan/u budućnosti
            btn.className += " bg-white/5 text-white hover:bg-white/20 hover:scale-105 active:scale-95";
            
            // Ako je ovaj datum već bio izabran pa se korisnik šetao kroz mesece, ostavi ga selektovanim
            if (bookingData.date === dateString) {
                btn.classList.remove('bg-white/5', 'text-white');
                btn.classList.add('bg-warning', 'text-slate-900', 'font-bold');
                selectedDateElement = btn;
            }

            btn.onclick = function() { selectDate(this); };
        }

        calendarDays.appendChild(btn);
    }
}

    function changeMonth(direction) {
        currentMonth += direction;

        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        } else if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }

        const realToday = new Date();
        if (new Date(currentYear, currentMonth, 1) < new Date(realToday.getFullYear(), realToday.getMonth(), 1)) {
            currentMonth = realToday.getMonth();
            currentYear = realToday.getFullYear();
            return;
        }

        renderCalendar();
    }
    </script>
</body>
</html>