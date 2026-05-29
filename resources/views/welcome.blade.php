<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BarberShop - Book Your Next Haircut in Seconds</title>
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
        .feature-card {
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-8px);
        }
        .barber-card {
            transition: all 0.3s ease;
        }
        .barber-card:hover {
            transform: scale(1.05);
        }
        .navbar-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .step-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #1e293b;
        }
    </style>
</head>
<body class="bg-white">
    <!-- Navbar -->
    <nav class="navbar navbar-glass fixed top-0 z-50 shadow-lg">
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
                <a href="/login" class="btn btn-ghost text-slate-700">Login</a>
                <a href="/zakazivanje" class="btn btn-warning text-slate-800">
                    <i class="fas fa-calendar-check"></i>
                    Zakaži Sad
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient min-h-screen flex items-center pt-20">
        <div class="container mx-auto px-4 py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="text-white space-y-6">
                    <div class="badge badge-warning badge-lg gap-2">
                        <i class="fas fa-star"></i>
                        #1 Aplikacija za Zakazivanje
                    </div>
                    <h1 class="text-5xl lg:text-6xl font-bold leading-tight">
                        Zakaži Svoje Sledeće Šišanje <span class="text-yellow-400">Brzo</span>
                    </h1>
                    <p class="text-xl text-gray-300">
                        Nađi svog frizera, izaberi termin i to je to. Bez poziva, bez čekanja. Jednostavno online zakazivanje 24/7.                    
                    </p>
                    <div class="flex flex-wrap gap-4 pt-4">
                        <a href="/zakazivanje" class="btn btn-warning btn-lg text-slate-800">
                            <i class="fas fa-calendar-plus"></i>
                            Zakaži Svoj Termin
                        </a>
                        <a href="#how-it-works" class="btn btn-outline btn-lg text-white hover:bg-white/10">
                            <i class="fas fa-play-circle"></i>
                            Saznaj Više
                        </a>
                    </div>
                    <!-- Stats -->
                    <div class="flex flex-wrap gap-8 pt-8">
                        <div>
                            <div class="text-3xl font-bold text-yellow-400">500+</div>
                            <div class="text-sm text-gray-400">Zadovoljnih Klijenata</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-yellow-400">5+</div>
                            <div class="text-sm text-gray-400">Expert Frizera</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-yellow-400">4.9★</div>
                            <div class="text-sm text-gray-400">Prosečna Ocena</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Mockup -->
                <div class="relative">
                    <div class="relative z-10">
                        <div class="mockup-phone border-primary">
                            <div class="camera"></div>
                            <div class="display">
                                <div class="artboard artboard-demo phone-1 bg-gradient-to-b from-slate-50 to-slate-100">
                                    <!-- App Screenshot Mock -->
                                    <div class="p-4 space-y-4">
                                        <div class="flex items-center justify-between">
                                            <div class="font-bold text-slate-800">Izaberi Frizera</div>
                                            <div class="badge badge-warning">Danas</div>
                                        </div>
                                        <div class="space-y-2">
                                            @foreach($barbers as $barber)
                                              <div class="bg-white rounded-lg p-3 shadow flex items-center gap-3">
                                                <div class="avatar">
                                                    <div class="w-12 rounded-full bg-success"><img src="https://ui-avatars.com/api/?name={{ $barber->name }}}&background=1e293b&color=fbbf24&size=400&bold=true" alt="{{ $barber->name }}" class="w-full h-64 object-cover">
                                                    </div>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="font-semibold text-sm">{{ $barber->name }}</div>
                                                    <div class="text-xs text-gray-500">Frizer</div>
                                                </div>
                                                <button class="btn btn-xs btn-warning">Zakaži</button>
                                              </div>
                                            @endforeach
                                        </div>
                                        <div class="grid grid-cols-3 gap-2 pt-2">
                                            <div class="bg-warning/20 rounded p-2 text-center text-xs font-semibold">9:00 AM</div>
                                            <div class="bg-warning/20 rounded p-2 text-center text-xs font-semibold">10:00 AM</div>
                                            <div class="bg-gray-200 rounded p-2 text-center text-xs text-gray-400">11:00 AM</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Decorative Elements -->
                    <div class="absolute top-10 -right-10 w-40 h-40 bg-yellow-400/20 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-yellow-400/20 rounded-full blur-3xl"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <div class="badge badge-warning badge-lg mb-4">Jednostavan Proces</div>
                <h2 class="text-4xl lg:text-5xl font-bold text-slate-800 mb-4">
                    Kako radi?
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Zakaži svoj termin u tri jednostavna koraka. Bez muke, bez telefonskih poziva.                
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Step 1 -->
                <div class="text-center space-y-4">
                    <div class="flex justify-center">
                        <div class="step-number">1</div>
                    </div>
                    <div class="w-20 h-20 bg-slate-800 rounded-2xl flex items-center justify-center mx-auto">
                        <i class="fas fa-user-tie text-yellow-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800">Izaberi Svog Frizera</h3>
                    <p class="text-gray-600">
                        Pogledaj naš tim vrhunskih berbera i izaberi svog favorita na osnovu njihovog stila i ocena.                   
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="text-center space-y-4">
                    <div class="flex justify-center">
                        <div class="step-number">2</div>
                    </div>
                    <div class="w-20 h-20 bg-slate-800 rounded-2xl flex items-center justify-center mx-auto">
                        <i class="fas fa-cut text-yellow-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800">Izaberi Uslugu i Vreme</h3>
                    <p class="text-gray-600">
                        Izaberi željenu uslugu i pronađi termin koji ti najviše odgovara.               
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="text-center space-y-4">
                    <div class="flex justify-center">
                        <div class="step-number">3</div>
                    </div>
                    <div class="w-20 h-20 bg-slate-800 rounded-2xl flex items-center justify-center mx-auto">
                        <i class="fas fa-check-circle text-yellow-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800">Potvrdi Tvoj Termin</h3>
                    <p class="text-gray-600">
                        Proveri detalje zakazivanja i potvrdi. Odmah dobijaš potvrdu termina i podsetnike.                    
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <div class="badge badge-warning badge-lg mb-4">Zašto Izabrati Nas</div>
                <h2 class="text-4xl lg:text-5xl font-bold text-slate-800 mb-4">
                    Sve Što Vam Treba
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Moderne funkcije dizajnirane da zakazivanje i upravljanje terminima učine potpuno lakim                
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl p-8 text-white shadow-xl">
                    <div class="w-16 h-16 gold-gradient rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-clock text-slate-800 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">24/7 Online Zakazivanje</h3>
                    <p class="text-gray-300">
                        Zakaži termine bilo kad, bilo gde. Naša platforma je uvek otvorena.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl p-8 text-white shadow-xl">
                    <div class="w-16 h-16 gold-gradient rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-star text-slate-800 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Izaberi Svog Frizera</h3>
                    <p class="text-gray-300">
                       Izaberite nekog iz našeg talentovanog tima na osnovu specijalnosti, ocena i dostupnosti.                    
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl p-8 text-white shadow-xl">
                    <div class="w-16 h-16 gold-gradient rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-calendar-alt text-slate-800 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Upravljaj Terminima</h3>
                    <p class="text-gray-300">
                        Jednostavno pregledaj, promeni termin ili otkaži zakazivanje direktno sa svog uredjaja.                    
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl p-8 text-white shadow-xl">
                    <div class="w-16 h-16 gold-gradient rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-bell text-slate-800 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Pametni Podsetnici</h3>
                    <p class="text-gray-300">
                        Dobijaj automatske SMS i email podsetnike kako nikada ne bi propustio svoj termin.                    
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Barbers Section -->
    <section class="py-20 bg-gray-50" id="barbers">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <div class="badge badge-warning badge-lg mb-4">Naš Tim</div>
                <h2 class="text-4xl lg:text-5xl font-bold text-slate-800 mb-4">
                    Ovo Su Naši Profesionalni Frizeri
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Vrhunski majstori posvećeni tome da dobiješ savršenu frizuru pri svakoj poseti.               
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Barber 1 -->
                @foreach($barbers as $barber)
                  <div class="barber-card bg-white rounded-2xl overflow-hidden shadow-xl">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name={{ $barber->name }}}&background=1e293b&color=fbbf24&size=400&bold=true" alt="{{ $barber->name }}" class="w-full h-64 object-cover">
                        <div class="absolute top-4 right-4">
                            <div class="badge badge-warning gap-1">
                                <i class="fas fa-star"></i>
                                4.9
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-slate-800 mb-2">{{ $barber->name }}</h3>
                        <p class="text-gray-600 mb-4">
                            <i class="fas fa-scissors text-yellow-500 mr-2"></i>
                            Frizer • Višegodišnje Iskustvo
                        </p>
                        <p class="text-sm text-gray-500 mb-6">
                          {{ Str::limit($barber->bio, 100, '...') }}                        
                        </p>
                        <a href="/zakazivanje" class="btn btn-warning w-full text-slate-800">
                            <i class="fas fa-calendar-check"></i>
                            Zakaži Termin sa {{ explode(' ', $barber->name)[0] }}
                        </a>
                    </div>
                  </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <div class="badge badge-warning badge-lg mb-4">Testimonials</div>
                <h2 class="text-4xl lg:text-5xl font-bold text-slate-800 mb-4">
                    Šta klijenti kažu
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Nemoj samo nama verovati. Evo šta naši klijenti imaju da kažu.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Testimonial 1 -->
                <div class="bg-slate-800 rounded-2xl p-8 text-white relative">
                    <div class="absolute top-4 right-4 text-6xl text-yellow-400/20">
                        <i class="fas fa-quote-right"></i>
                    </div>
                    <div class="flex items-center gap-1 mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-300 mb-6 relative z-10">
                      "Najbolje iskustvo zakazivanja ikada! Mogu da zakažem termin i u ponoć ako poželim. Baš je lako, a frizeri stvarno znaju svoj zanat."                    
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="avatar">
                            <div class="w-12 rounded-full">
                                <img src="https://ui-avatars.com/api/?name=Nikolina+Matic&background=fbbf24&color=1e293b" alt="Nikolina Matić">
                            </div>
                        </div>
                        <div>
                            <div class="font-bold">Nikolina Matić</div>
                            <div class="text-sm text-gray-400">Klijent</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-slate-800 rounded-2xl p-8 text-white relative">
                    <div class="absolute top-4 right-4 text-6xl text-yellow-400/20">
                        <i class="fas fa-quote-right"></i>
                    </div>
                    <div class="flex items-center gap-1 mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-300 mb-6 relative z-10">
                        "Ovi podsetnici su me spasili! Stalno sam zaboravljala na termine, ali sada više ne. Aplikacija je neverovatno laka za korišćenje!"                    
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="avatar">
                            <div class="w-12 rounded-full">
                                <img src="https://ui-avatars.com/api/?name=Marija+pANTIC&background=fbbf24&color=1e293b" alt="Marija Pantić">
                            </div>
                        </div>
                        <div>
                            <div class="font-bold">Marija Pantić</div>
                            <div class="text-sm text-gray-400">Zadovoljan Klijent</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-slate-800 rounded-2xl p-8 text-white relative">
                    <div class="absolute top-4 right-4 text-6xl text-yellow-400/20">
                        <i class="fas fa-quote-right"></i>
                    </div>
                    <div class="flex items-center gap-1 mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-300 mb-6 relative z-10">
                        "Oduševljen sam što mogu sam da biram frizera i vidim slobodne termine u realnom vremenu. Nema više onog besciljnog zivkanja telefonom."                    
                      </p>
                    <div class="flex items-center gap-3">
                        <div class="avatar">
                            <div class="w-12 rounded-full">
                                <img src="https://ui-avatars.com/api/?name=David+Zaric&background=fbbf24&color=1e293b" alt="David Zarić">
                            </div>
                        </div>
                        <div>
                            <div class="font-bold">David Zarić</div>
                            <div class="text-sm text-gray-400">VIP Klijent</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="hero-gradient py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center text-white">
                <div class="badge badge-warning badge-lg mb-6">Počni Već Danas</div>
                <h2 class="text-4xl lg:text-5xl font-bold mb-6">
                    Spremni da Zakažete Svoj Sledeći Termin?
                </h2>
                <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                    Pridruži se stotinama zadovoljnih klijenata koji svoje šišanje zakazuju online. Bez poziva, bez muke.
                </p>
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="/zakazivanje" class="btn btn-warning btn-lg text-slate-800">
                        <i class="fas fa-user-plus"></i>
                          Započni - Besplatno je
                    </a>
                    <a href="#barbers" class="btn btn-outline btn-lg text-white hover:bg-white/10">
                        <i class="fas fa-users"></i>
                        Pogledaj Naše Frizere
                    </a>
                </div>
                <div class="flex items-center justify-center gap-8 mt-12 text-sm text-gray-400">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-yellow-400"></i>
                        Bez kreditne kartice
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-yellow-400"></i>
                        Potvrda stiže odmah
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-yellow-400"></i>
                        Otkaži bilo kada
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-gray-300 py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Brand -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 gold-gradient rounded-lg flex items-center justify-center">
                            <i class="fas fa-cut text-slate-800 text-lg"></i>
                        </div>
                        <span class="text-xl font-bold text-white">FrizerskiSalon</span>
                    </div>
                    <p class="text-sm text-gray-400">
                      Zakaži šišanje za nekoliko sekundi uz našu modernu platformu za online zakazivanje                    
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-bold text-white mb-4">Korisni Linkovi</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Home</a></li>
                        <li><a href="#barbers" class="hover:text-yellow-400 transition-colors">Our Barbers</a></li>
                        <li><a href="#services" class="hover:text-yellow-400 transition-colors">Services</a></li>
                        <li><a href="#book" class="hover:text-yellow-400 transition-colors">Book Now</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 class="font-bold text-white mb-4">Support</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">O Nama</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Kontakt</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">FAQ</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="font-bold text-white mb-4">Kontakt</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-center gap-2">
                            <i class="fas fa-phone text-yellow-400"></i>
                            <span>+381 63 1142 411</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-envelope text-yellow-400"></i>
                            <span>info@frizerskisalon.com</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-yellow-400"></i>
                            <span>Knez Mihaila 1, Beograd, Srbija</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-gray-400">
                        © 2026 FrizerskiSalon. Sva prava su zadržana.
                    </div>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 bg-slate-800 hover:bg-yellow-400 rounded-lg flex items-center justify-center transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-slate-800 hover:bg-yellow-400 rounded-lg flex items-center justify-center transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-slate-800 hover:bg-yellow-400 rounded-lg flex items-center justify-center transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-slate-800 hover:bg-yellow-400 rounded-lg flex items-center justify-center transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar background on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-xl');
            } else {
                navbar.classList.remove('shadow-xl');
            }
        });
    </script>
</body>
</html>
