<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment - BarberShop</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        }
        .gold-gradient {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        }
        .barber-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .barber-card:hover {
            transform: translateY(-4px);
        }
        .barber-card.selected {
            border: 3px solid #fbbf24;
            box-shadow: 0 0 20px rgba(251, 191, 36, 0.3);
        }
        .service-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .service-card:hover {
            transform: translateY(-4px);
        }
        .service-card.selected {
            border: 3px solid #fbbf24;
            background: #fffbeb;
        }
        .time-slot {
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .time-slot:hover {
            transform: scale(1.05);
        }
        .time-slot.selected {
            background: #fbbf24 !important;
            color: #1e293b !important;
            font-weight: bold;
        }
        .time-slot.disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }
        .step-indicator {
            position: relative;
        }
        .step-indicator::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 100%;
            width: 100%;
            height: 2px;
            background: #e5e7eb;
            transform: translateY(-50%);
            z-index: -1;
        }
        .step-indicator.active {
            background: #fbbf24;
            color: #1e293b;
            font-weight: bold;
        }
        .step-indicator.completed {
            background: #10b981;
            color: white;
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
            <div class="flex-none gap-2">
                <a href="/" class="btn btn-ghost text-slate-700">
                    <i class="fas fa-arrow-left"></i>
                    Nazad
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Progress Steps -->
        <div class="mb-8">
            <ul class="steps steps-horizontal w-full">
                <li class="step step-warning" data-step="1">Izaberi Frizera</li>
                <li class="step" data-step="2">Izaberi Uslugu</li>
                <li class="step" data-step="3">Izaberi Datum i Vreme</li>
                <li class="step" data-step="4">Potvrdi Termin</li>
            </ul>
        </div>

        <!-- Booking Card -->
        <div class="card bg-white shadow-2xl">
            <div class="card-body p-6 lg:p-10">
                <!-- Step 1: Choose Barber -->
                <div id="step-1" class="booking-step">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl lg:text-4xl font-bold text-slate-800 mb-2">
                            Izaberi Svog Frizera
                        </h2>
                        <p class="text-gray-600">
                            Izaberi svog majstora iz našeg tima vrhunskih frizera
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        <!-- Barber 1 -->
                        @foreach($barbers as $barber)
                            <div class="barber-card group bg-white border-2 border-gray-200 rounded-xl overflow-hidden" onclick="selectBarber({{ $barber->id }}, '{{ $barber->name }}')">
                                <div class="relative">
                                    <img src="https://ui-avatars.com/api/?name={{ $barber->name }}&background=1e293b&color=fbbf24&size=400&bold=true" alt="John Doe" class="w-full h-48 object-cover">
                                    <div class="absolute top-3 right-3">
                                        <div class="badge badge-warning gap-1">
                                            <i class="fas fa-star"></i>
                                            4.9
                                        </div>
                                    </div>
                                    <div class="absolute top-3 left-3 hidden barber-check-{{ $barber->id }}">
                                        <div class="w-8 h-8 bg-warning rounded-full flex items-center justify-center">
                                            <i class="fas fa-check text-slate-800"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <h3 class="text-xl font-bold text-slate-800 mb-1">{{ $barber->name }}</h3>
                                    <p class="text-sm text-gray-600 mb-3">
                                        <i class="fas fa-scissors text-yellow-500 mr-1"></i>
                                        Frizer • 10 years
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $barber->bio }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-end">
                        <button id="next-step-1" class="btn btn-warning btn-lg text-slate-800" disabled onclick="nextStep(2)">
                            Nastavi
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Select Service -->
                <div id="step-2" class="booking-step hidden">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl lg:text-4xl font-bold text-slate-800 mb-2">
                            Izberi Uslugu
                        </h2>
                        <p class="text-gray-600">
                            Izaberi uslugu koju želiš da zakažeš
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Service 1 -->
                        @foreach($services as $service)
                            <div class="service-card bg-white border-2 border-gray-200 rounded-xl p-6" onclick="selectService({{ $service->id }}, '{{ $service->name }}', {{ $service->duration_minutes }}, {{ $service->price }})">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-slate-800 mb-2">{{ $service->name }}</h3>
                                        <p class="text-sm text-gray-600 mb-3">
                                            {{ $service->description }}
                                        </p>
                                        <div class="flex items-center gap-4 text-sm text-gray-500">
                                            <div>
                                                <i class="far fa-clock text-warning"></i>
                                                {{ $service->duration_minutes }} min
                                            </div>
                                            <div class="font-bold text-2xl text-slate-800">{{ number_format($service->price, 0, ',', '.') }} din</div>
                                        </div>
                                    </div>
                                    <div class="w-16 h-16 bg-slate-800 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-cut text-yellow-400 text-2xl"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-between">
                        <button class="btn btn-ghost btn-lg" onclick="prevStep(1)">
                            <i class="fas fa-arrow-left"></i>
                            Nazad
                        </button>
                        <button id="next-step-2" class="btn btn-warning btn-lg text-slate-800" disabled onclick="nextStep(3)">
                            Nastavi
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Pick Date & Time -->
                <div id="step-3" class="booking-step hidden">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl lg:text-4xl font-bold text-slate-800 mb-2">
                            Izaberi Datum i Vreme
                        </h2>
                        <p class="text-gray-600">
                            Izaberi datum i vreme koji ti najviše odgovaraju                        
                        </p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                        <!-- Calendar -->
                        <div>
                            <h3 class="font-bold text-lg text-slate-800 mb-4">Izberi Datum</h3>
                            <div class="bg-slate-800 rounded-xl p-6 text-white">
                                <div class="flex items-center justify-between mb-6">
                                    <button class="btn btn-ghost btn-sm text-white">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <div class="font-bold text-lg">April 2026</div>
                                    <button class="btn btn-ghost btn-sm text-white">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>

                                <div class="grid grid-cols-7 gap-2 mb-2">
                                    <div class="text-center text-xs text-gray-400">Sun</div>
                                    <div class="text-center text-xs text-gray-400">Mon</div>
                                    <div class="text-center text-xs text-gray-400">Tue</div>
                                    <div class="text-center text-xs text-gray-400">Wed</div>
                                    <div class="text-center text-xs text-gray-400">Thu</div>
                                    <div class="text-center text-xs text-gray-400">Fri</div>
                                    <div class="text-center text-xs text-gray-400">Sat</div>
                                </div>

                                <div class="grid grid-cols-7 gap-2">
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600"></div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600"></div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600"></div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600"></div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600"></div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600"></div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">1</div>

                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">2</div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">3</div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">4</div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">5</div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">6</div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">7</div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">8</div>

                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">9</div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">10</div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">11</div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">12</div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">13</div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">14</div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">15</div>

                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">16</div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">17</div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">18</div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">19</div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">20</div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">21</div>
                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">22</div>

                                    <div class="aspect-square flex items-center justify-center text-sm text-gray-600">23</div>
                                    <button class="aspect-square bg-yellow-400 text-slate-800 font-bold rounded-lg hover:bg-yellow-300" onclick="selectDate('Apr 24, 2026')">24</button>
                                    <button class="aspect-square bg-white/10 hover:bg-white/20 rounded-lg" onclick="selectDate('Apr 25, 2026')">25</button>
                                    <button class="aspect-square bg-white/10 hover:bg-white/20 rounded-lg" onclick="selectDate('Apr 26, 2026')">26</button>
                                    <button class="aspect-square bg-white/10 hover:bg-white/20 rounded-lg" onclick="selectDate('Apr 27, 2026')">27</button>
                                    <button class="aspect-square bg-white/10 hover:bg-white/20 rounded-lg" onclick="selectDate('Apr 28, 2026')">28</button>
                                    <button class="aspect-square bg-white/10 hover:bg-white/20 rounded-lg" onclick="selectDate('Apr 29, 2026')">29</button>

                                    <button class="aspect-square bg-white/10 hover:bg-white/20 rounded-lg" onclick="selectDate('Apr 30, 2026')">30</button>
                                </div>
                            </div>
                        </div>

                        <!-- Time Slots -->
                        <div>
                            <h3 class="font-bold text-lg text-slate-800 mb-4">Dostupni termini</h3>
                            <div class="space-y-4">
                                <div>
                                    <div class="text-sm text-gray-600 mb-2 font-semibold">Ujutru</div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <button class="time-slot bg-slate-800 text-white py-3 rounded-lg text-sm" onclick="selectTime('9:00 AM')">9:00 AM</button>
                                        <button class="time-slot bg-slate-800 text-white py-3 rounded-lg text-sm" onclick="selectTime('9:30 AM')">9:30 AM</button>
                                        <button class="time-slot bg-slate-800 text-white py-3 rounded-lg text-sm" onclick="selectTime('10:00 AM')">10:00 AM</button>
                                        <button class="time-slot bg-slate-800 text-white py-3 rounded-lg text-sm" onclick="selectTime('10:30 AM')">10:30 AM</button>
                                        <button class="time-slot bg-slate-800 text-white py-3 rounded-lg text-sm disabled" disabled>11:00 AM</button>
                                        <button class="time-slot bg-slate-800 text-white py-3 rounded-lg text-sm" onclick="selectTime('11:30 AM')">11:30 AM</button>
                                    </div>
                                </div>

                                <div>
                                    <div class="text-sm text-gray-600 mb-2 font-semibold">Popodne</div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <button class="time-slot bg-slate-800 text-white py-3 rounded-lg text-sm" onclick="selectTime('12:00 PM')">12:00 PM</button>
                                        <button class="time-slot bg-slate-800 text-white py-3 rounded-lg text-sm disabled" disabled>12:30 PM</button>
                                        <button class="time-slot bg-slate-800 text-white py-3 rounded-lg text-sm" onclick="selectTime('1:00 PM')">1:00 PM</button>
                                        <button class="time-slot bg-slate-800 text-white py-3 rounded-lg text-sm" onclick="selectTime('1:30 PM')">1:30 PM</button>
                                        <button class="time-slot bg-slate-800 text-white py-3 rounded-lg text-sm" onclick="selectTime('2:00 PM')">2:00 PM</button>
                                        <button class="time-slot bg-slate-800 text-white py-3 rounded-lg text-sm" onclick="selectTime('2:30 PM')">2:30 PM</button>
                                        <button class="time-slot bg-slate-800 text-white py-3 rounded-lg text-sm" onclick="selectTime('3:00 PM')">3:00 PM</button>
                                        <button class="time-slot bg-slate-800 text-white py-3 rounded-lg text-sm disabled" disabled>3:30 PM</button>
                                        <button class="time-slot bg-slate-800 text-white py-3 rounded-lg text-sm" onclick="selectTime('4:00 PM')">4:00 PM</button>
                                    </div>
                                </div>

                                <div>
                                    <div class="text-sm text-gray-600 mb-2 font-semibold">Uvece</div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <button class="time-slot bg-slate-800 text-white py-3 rounded-lg text-sm" onclick="selectTime('4:30 PM')">4:30 PM</button>
                                        <button class="time-slot bg-slate-800 text-white py-3 rounded-lg text-sm" onclick="selectTime('5:00 PM')">5:00 PM</button>
                                        <button class="time-slot bg-slate-800 text-white py-3 rounded-lg text-sm" onclick="selectTime('5:30 PM')">5:30 PM</button>
                                        <button class="time-slot bg-slate-800 text-white py-3 rounded-lg text-sm disabled" disabled>6:00 PM</button>
                                        <button class="time-slot bg-slate-800 text-white py-3 rounded-lg text-sm" onclick="selectTime('6:30 PM')">6:30 PM</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <button class="btn btn-ghost btn-lg" onclick="prevStep(2)">
                            <i class="fas fa-arrow-left"></i>
                            Nazad
                        </button>
                        <button id="next-step-3" class="btn btn-warning btn-lg text-slate-800" disabled onclick="nextStep(4)">
                            Nastavi
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 4: Confirm Booking -->
                <div id="step-4" class="booking-step hidden">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl lg:text-4xl font-bold text-slate-800 mb-2">
                            Potvrdi Svoj Termin
                        </h2>
                        <p class="text-gray-600">
                            Pregledaj detalje svog termina i zakaži
                        </p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                        <!-- Booking Summary -->
                        <div class="space-y-6">
                            <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl p-6 text-white">
                                <h3 class="font-bold text-lg mb-4">Detalji Termina</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 bg-yellow-400 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-user-tie text-slate-800"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-400">Frizer</div>
                                            <div id="summary-barber" class="font-semibold">-</div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 bg-yellow-400 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-cut text-slate-800"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-400">Usluga</div>
                                            <div id="summary-service" class="font-semibold">-</div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 bg-yellow-400 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-calendar text-slate-800"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-400">Datum</div>
                                            <div id="summary-date" class="font-semibold">-</div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 bg-yellow-400 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-clock text-slate-800"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-400">Vreme</div>
                                            <div id="summary-time" class="font-semibold">-</div>
                                        </div>
                                    </div>

                                    <div class="divider"></div>

                                    <div class="flex items-center justify-between">
                                        <div class="text-lg">Ukupno</div>
                                        <div id="summary-price" class="text-3xl font-bold text-yellow-400">$0</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Info Form -->
                        <div>
                            <h3 class="font-bold text-lg text-slate-800 mb-4">Tvoje Informacije</h3>
                            <form class="space-y-4">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-semibold">Puno Ime i Prezime</span>
                                    </label>
                                    <input type="text" placeholder="Ime Prezime" class="input input-bordered" required>
                                </div>

                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-semibold">Email</span>
                                    </label>
                                    <input type="email" placeholder="primer@gmail.com" class="input input-bordered" required>
                                </div>

                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-semibold">Broj Telefona</span>
                                    </label>
                                    <input type="tel" placeholder="062-1121-521" class="input input-bordered" required>
                                </div>

                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-semibold">Dodatna napomena ili zahtev (Opciono)</span>
                                    </label>
                                    <textarea class="textarea textarea-bordered h-24" placeholder="Napomene ili zahtevi za vašeg frizera..."></textarea>
                                </div>

                                <div class="form-control">
                                    <label class="label cursor-pointer justify-start gap-3">
                                        <input type="checkbox" class="checkbox checkbox-warning" required />
                                        <span class="label-text">Prihvatam uslove korišćenja</span>
                                    </label>
                                </div>

                                <div class="form-control">
                                    <label class="label cursor-pointer justify-start gap-3">
                                        <input type="checkbox" class="checkbox checkbox-warning" />
                                        <span class="label-text">Posalji mi notifikacije pre termina</span>
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <button class="btn btn-ghost btn-lg" onclick="prevStep(3)">
                            <i class="fas fa-arrow-left"></i>
                            Nazad
                        </button>
                        <button class="btn btn-warning btn-lg text-slate-800" onclick="document.getElementById('success_modal').showModal()">
                            <i class="fas fa-check-circle"></i>
                            Zakaži Termin
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <dialog id="success_modal" class="modal">
        <div class="modal-box max-w-md text-center">
            <div class="mb-6">
                <div class="w-20 h-20 gold-gradient rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check text-slate-800 text-4xl"></i>
                </div>
                <h3 class="font-bold text-2xl text-slate-800 mb-2">Booking Confirmed!</h3>
                <p class="text-gray-600">
                    Your appointment has been successfully booked. We've sent a confirmation email to your inbox.
                </p>
            </div>

            <div class="bg-slate-50 rounded-lg p-4 mb-6">
                <div class="text-sm text-gray-600 mb-2">Booking Reference</div>
                <div class="text-2xl font-bold text-slate-800">#BK-2026-04-001</div>
            </div>

            <div class="space-y-3">
                <a href="#" class="btn btn-warning w-full text-slate-800">
                    <i class="fas fa-calendar-check"></i>
                    View My Appointments
                </a>
                <button class="btn btn-ghost w-full" onclick="location.reload()">
                    <i class="fas fa-plus"></i>
                    Book Another Appointment
                </button>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <script>
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

        function selectBarber(id, name) {
            // Remove all selections
            document.querySelectorAll('.barber-card').forEach(card => {
                card.classList.remove('selected');
            });
            document.querySelectorAll('[class^="barber-check-"]').forEach(check => {
                check.classList.add('hidden');
            });

            // Add selection
            event.currentTarget.classList.add('selected');
            document.querySelector('.barber-check-' + id).classList.remove('hidden');

            // Update data
            bookingData.barberId = id;
            bookingData.barberName = name;

            // Enable next button
            document.getElementById('next-step-1').disabled = false;
        }

        function selectService(id, name, duration, price) {
            // Remove all selections
            document.querySelectorAll('.service-card').forEach(card => {
                card.classList.remove('selected');
            });

            // Add selection
            event.currentTarget.classList.add('selected');

            // Update data
            bookingData.serviceId = id;
            bookingData.serviceName = name;
            bookingData.servicePrice = price;
            bookingData.serviceDuration = duration;

            // Enable next button
            document.getElementById('next-step-2').disabled = false;
        }

        function selectDate(date) {
            bookingData.date = date;
            checkDateTime();
        }

        function selectTime(time) {
            // Remove all selections
            document.querySelectorAll('.time-slot:not(.disabled)').forEach(slot => {
                slot.classList.remove('selected');
            });

            // Add selection
            event.currentTarget.classList.add('selected');

            bookingData.time = time;
            checkDateTime();
        }

        function checkDateTime() {
            if (bookingData.date && bookingData.time) {
                document.getElementById('next-step-3').disabled = false;
            }
        }

        function nextStep(step) {
            // Hide all steps
            document.querySelectorAll('.booking-step').forEach(s => {
                s.classList.add('hidden');
            });

            // Show current step
            document.getElementById('step-' + step).classList.remove('hidden');

            // Update progress
            document.querySelectorAll('.step').forEach((s, index) => {
                if (index < step) {
                    s.classList.add('step-warning');
                } else {
                    s.classList.remove('step-warning');
                }
            });

            // Update summary if on step 4
            if (step === 4) {
                document.getElementById('summary-barber').textContent = bookingData.barberName;
                document.getElementById('summary-service').textContent = bookingData.serviceName;
                document.getElementById('summary-date').textContent = bookingData.date;
                document.getElementById('summary-time').textContent = bookingData.time;
                document.getElementById('summary-price').textContent = bookingData.servicePrice + ' din';
            }

            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function prevStep(step) {
            nextStep(step);
        }
    </script>
</body>
</html>
