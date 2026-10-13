<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>RestoPOS - Layar Kasir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#10B981',
                        'primary-hover': '#059669',
                        'primary-light': '#ECFDF5',
                        'primary-subtle': '#D1FAE5',
                        surface: '#F9FAFB',
                        charcoal: '#1F2937',
                        muted: '#6B7280',
                        borderline: '#E5E7EB'
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .material-symbols-outlined.fill {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #E5E7EB;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #D1D5DB;
        }
    </style>
</head>
<body class="bg-surface text-charcoal h-screen w-screen overflow-hidden flex flex-col antialiased select-none">
    <!-- TOP HEADER (Full Width) -->
    <header class="h-18 px-6 bg-white border-b border-borderline shadow-sm flex items-center justify-between shrink-0 z-20">
        <!-- Left: RestoPOS Brand -->
        <div class="flex items-center gap-3 w-64 shrink-0">
            <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-white shadow-sm shadow-emerald-500/20 shrink-0">
                <span class="material-symbols-outlined text-[22px]">restaurant</span>
            </div>
            <div class="flex items-center tracking-tight text-xl">
                <span class="text-charcoal font-bold font-sans">Resto</span>
                <span class="text-primary font-bold font-sans">POS</span>
            </div>
            <span class="text-xs px-2.5 py-0.5 rounded-full bg-primary-light text-primary font-semibold border border-primary/20 ml-1">Kasir</span>
        </div>

        <!-- Right: Date, Cashier Profile, & Back to Dashboard CTA -->
        <div class="flex items-center gap-4 shrink-0">
            <!-- Date -->
            <div class="hidden lg:flex items-center gap-2 text-xs font-semibold text-muted px-3 py-1.5 bg-surface rounded-lg border border-borderline">
                <span class="material-symbols-outlined text-[18px] text-muted">calendar_today</span>
                <span>Senin, 12 Oktober 2026</span>
            </div>

            <!-- Divider -->
            <div class="h-6 w-px bg-borderline hidden lg:block"></div>

            <!-- User Profile -->
            <div class="relative group flex items-center gap-2.5 cursor-pointer">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-full bg-blue-100 border border-blue-200 text-blue-700 font-bold flex items-center justify-center text-sm shrink-0">
                        {{ strtoupper(substr(auth()->user()->name ?? 'K', 0, 1)) }}
                    </div>
                    <div class="hidden md:block text-left">
                        <div class="text-xs font-bold text-charcoal leading-tight">{{ auth()->user()->name ?? 'Kasir' }}</div>
                        <div class="text-[11px] font-medium text-muted leading-tight">{{ ucfirst(auth()->user()->role ?? 'Kasir') }}</div>
                    </div>
                    <span class="material-symbols-outlined text-[18px] text-muted">expand_more</span>
                </div>

                <!-- Dropdown Menu Popover -->
                <div class="absolute right-0 top-full mt-2 w-52 bg-white rounded-xl shadow-lg border border-borderline p-1.5 z-50 text-left hidden group-hover:block hover:block">
                    @if (auth()->user()?->role === 'manager')
                        <a class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold text-charcoal hover:bg-surface transition" href="{{ url('/manager') }}">
                            <span class="material-symbols-outlined text-[18px] text-muted">dashboard</span>
                            <span>Kembali ke Dashboard</span>
                        </a>
                        <div class="h-px bg-borderline my-1"></div>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold text-red-600 hover:bg-rose-50 transition text-left">
                            <span class="material-symbols-outlined text-[18px] text-red-600">logout</span>
                            <span>Log out</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT SPLIT (70% Menu Catalog, 30% Order Ticket Cart) -->
    <main class="flex-1 flex overflow-hidden">
        <!-- LEFT AREA: MENU CATALOG (70%) -->
        <section class="flex-1 lg:w-[70%] bg-surface flex flex-col overflow-hidden border-r border-borderline">
            <!-- Search Bar -->
            <div class="px-8 pt-6 pb-2 shrink-0">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-muted">
                        <span class="material-symbols-outlined text-[20px]">search</span>
                    </div>
                    <input class="w-full pl-10 pr-12 py-2.5 bg-white border border-borderline rounded-xl text-sm font-medium text-charcoal placeholder-muted focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition duration-150 shadow-sm" placeholder="Cari menu makanan atau minuman..." type="text">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <kbd class="hidden sm:inline-flex items-center px-1.5 py-0.5 text-[10px] font-semibold text-muted bg-surface border border-borderline rounded">ESC</kbd>
                    </div>
                </div>
            </div>

            <!-- Category Tabs Bar -->
            <div class="px-8 pb-4 shrink-0 flex items-center justify-between pt-2">
                <div class="flex items-center gap-2 overflow-x-auto pb-1 max-w-full">
                    <!-- Active Tab: Semua -->
                    <button class="px-5 py-2.5 rounded-xl bg-primary text-white font-bold text-xs tracking-wide shadow-sm shadow-emerald-500/20 flex items-center gap-2 transition">
                        <span class="material-symbols-outlined text-[18px]">restaurant_menu</span>
                        <span>Semua</span>
                        <span class="bg-white/20 text-white text-[11px] px-1.5 py-0.2 rounded-full font-bold">18</span>
                    </button>
                    <!-- Inactive Tab: Makanan Utama -->
                    <button class="px-5 py-2.5 rounded-xl bg-white border border-borderline hover:border-gray-300 text-charcoal hover:text-black font-semibold text-xs tracking-wide shadow-sm transition flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-muted">lunch_dining</span>
                        <span>Makanan Utama</span>
                    </button>
                    <!-- Inactive Tab: Minuman -->
                    <button class="px-5 py-2.5 rounded-xl bg-white border border-borderline hover:border-gray-300 text-charcoal hover:text-black font-semibold text-xs tracking-wide shadow-sm transition flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-muted">local_cafe</span>
                        <span>Minuman</span>
                    </button>
                    <!-- Inactive Tab: Camilan -->
                    <button class="px-5 py-2.5 rounded-xl bg-white border border-borderline hover:border-gray-300 text-charcoal hover:text-black font-semibold text-xs tracking-wide shadow-sm transition flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-muted">bakery_dining</span>
                        <span>Camilan</span>
                    </button>
                </div>
            </div>

            <!-- Menu Grid (Scrollable, 3 or 4 columns) -->
            <div class="flex-1 overflow-y-auto px-8 pb-8 pt-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
                    <!-- Card 1: Nasi Goreng Spesial -->
                    <div class="bg-white rounded-2xl border border-borderline overflow-hidden shadow-sm hover:shadow-md hover:border-primary/40 transition duration-150 flex flex-col cursor-pointer group">
                        <div class="h-40 w-full bg-gradient-to-br from-amber-50 to-orange-100 flex items-center justify-center relative overflow-hidden">
                            <div class="w-20 h-20 rounded-full bg-white/80 shadow-inner flex items-center justify-center text-amber-600 group-hover:scale-105 transition duration-200">
                                <span class="material-symbols-outlined text-[48px]">ramen_dining</span>
                            </div>
                            <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-charcoal text-[11px] font-bold px-2.5 py-0.5 rounded-full border border-gray-200">Makanan Utama</span>
                            <button class="absolute bottom-3 right-3 w-8 h-8 rounded-full bg-white shadow-md flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition">
                                <span class="material-symbols-outlined text-[20px]">add</span>
                            </button>
                        </div>
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-charcoal text-base group-hover:text-primary transition leading-snug">Nasi Goreng Spesial</h3>
                                <p class="text-xs text-muted mt-0.5">Telur mata sapi, ayam suwir, acar</p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-borderline/60 flex items-center justify-between">
                                <span class="text-base font-extrabold text-charcoal">Rp 35.000</span>
                                <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">Tersedia</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Ayam Bakar Madu -->
                    <div class="bg-white rounded-2xl border border-borderline overflow-hidden shadow-sm hover:shadow-md hover:border-primary/40 transition duration-150 flex flex-col cursor-pointer group">
                        <div class="h-40 w-full bg-gradient-to-br from-red-50 to-amber-100 flex items-center justify-center relative overflow-hidden">
                            <div class="w-20 h-20 rounded-full bg-white/80 shadow-inner flex items-center justify-center text-red-600 group-hover:scale-105 transition duration-200">
                                <span class="material-symbols-outlined text-[48px]">skillet</span>
                            </div>
                            <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-charcoal text-[11px] font-bold px-2.5 py-0.5 rounded-full border border-gray-200">Makanan Utama</span>
                            <button class="absolute bottom-3 right-3 w-8 h-8 rounded-full bg-white shadow-md flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition">
                                <span class="material-symbols-outlined text-[20px]">add</span>
                            </button>
                        </div>
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-charcoal text-base group-hover:text-primary transition leading-snug">Ayam Bakar Madu</h3>
                                <p class="text-xs text-muted mt-0.5">Paha ayam bumbu madu & sambal terasi</p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-borderline/60 flex items-center justify-between">
                                <span class="text-base font-extrabold text-charcoal">Rp 42.000</span>
                                <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">Tersedia</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Mie Goreng Seafood -->
                    <div class="bg-white rounded-2xl border border-borderline overflow-hidden shadow-sm hover:shadow-md hover:border-primary/40 transition duration-150 flex flex-col cursor-pointer group">
                        <div class="h-40 w-full bg-gradient-to-br from-yellow-50 to-orange-100 flex items-center justify-center relative overflow-hidden">
                            <div class="w-20 h-20 rounded-full bg-white/80 shadow-inner flex items-center justify-center text-amber-700 group-hover:scale-105 transition duration-200">
                                <span class="material-symbols-outlined text-[48px]">set_meal</span>
                            </div>
                            <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-charcoal text-[11px] font-bold px-2.5 py-0.5 rounded-full border border-gray-200">Makanan Utama</span>
                            <button class="absolute bottom-3 right-3 w-8 h-8 rounded-full bg-white shadow-md flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition">
                                <span class="material-symbols-outlined text-[20px]">add</span>
                            </button>
                        </div>
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-charcoal text-base group-hover:text-primary transition leading-snug">Mie Goreng Seafood</h3>
                                <p class="text-xs text-muted mt-0.5">Udang, cumi segar, dan sawi hijau</p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-borderline/60 flex items-center justify-between">
                                <span class="text-base font-extrabold text-charcoal">Rp 38.000</span>
                                <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">Tersedia</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Es Teh Manis Jumbo -->
                    <div class="bg-white rounded-2xl border border-borderline overflow-hidden shadow-sm hover:shadow-md hover:border-primary/40 transition duration-150 flex flex-col cursor-pointer group">
                        <div class="h-40 w-full bg-gradient-to-br from-emerald-50 to-teal-100 flex items-center justify-center relative overflow-hidden">
                            <div class="w-20 h-20 rounded-full bg-white/80 shadow-inner flex items-center justify-center text-teal-600 group-hover:scale-105 transition duration-200">
                                <span class="material-symbols-outlined text-[48px]">local_cafe</span>
                            </div>
                            <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-charcoal text-[11px] font-bold px-2.5 py-0.5 rounded-full border border-gray-200">Minuman</span>
                            <button class="absolute bottom-3 right-3 w-8 h-8 rounded-full bg-white shadow-md flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition">
                                <span class="material-symbols-outlined text-[20px]">add</span>
                            </button>
                        </div>
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-charcoal text-base group-hover:text-primary transition leading-snug">Es Teh Manis Jumbo</h3>
                                <p class="text-xs text-muted mt-0.5">Teh melati wangi dengan es kristal</p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-borderline/60 flex items-center justify-between">
                                <span class="text-base font-extrabold text-charcoal">Rp 8.000</span>
                                <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">Tersedia</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card 5: Kopi Susu Aren -->
                    <div class="bg-white rounded-2xl border border-borderline overflow-hidden shadow-sm hover:shadow-md hover:border-primary/40 transition duration-150 flex flex-col cursor-pointer group">
                        <div class="h-40 w-full bg-gradient-to-br from-amber-100 to-amber-200/60 flex items-center justify-center relative overflow-hidden">
                            <div class="w-20 h-20 rounded-full bg-white/80 shadow-inner flex items-center justify-center text-amber-800 group-hover:scale-105 transition duration-200">
                                <span class="material-symbols-outlined text-[48px]">coffee</span>
                            </div>
                            <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-charcoal text-[11px] font-bold px-2.5 py-0.5 rounded-full border border-gray-200">Minuman</span>
                            <button class="absolute bottom-3 right-3 w-8 h-8 rounded-full bg-white shadow-md flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition">
                                <span class="material-symbols-outlined text-[20px]">add</span>
                            </button>
                        </div>
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-charcoal text-base group-hover:text-primary transition leading-snug">Kopi Susu Aren</h3>
                                <p class="text-xs text-muted mt-0.5">Espresso robusta & gula aren murni</p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-borderline/60 flex items-center justify-between">
                                <span class="text-base font-extrabold text-charcoal">Rp 22.000</span>
                                <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">Tersedia</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6: Pisang Goreng Keju -->
                    <div class="bg-white rounded-2xl border border-borderline overflow-hidden shadow-sm hover:shadow-md hover:border-primary/40 transition duration-150 flex flex-col cursor-pointer group">
                        <div class="h-40 w-full bg-gradient-to-br from-yellow-100 to-amber-200/50 flex items-center justify-center relative overflow-hidden">
                            <div class="w-20 h-20 rounded-full bg-white/80 shadow-inner flex items-center justify-center text-amber-700 group-hover:scale-105 transition duration-200">
                                <span class="material-symbols-outlined text-[48px]">bakery_dining</span>
                            </div>
                            <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-charcoal text-[11px] font-bold px-2.5 py-0.5 rounded-full border border-gray-200">Camilan</span>
                            <button class="absolute bottom-3 right-3 w-8 h-8 rounded-full bg-white shadow-md flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition">
                                <span class="material-symbols-outlined text-[20px]">add</span>
                            </button>
                        </div>
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-charcoal text-base group-hover:text-primary transition leading-snug">Pisang Goreng Keju</h3>
                                <p class="text-xs text-muted mt-0.5">Pisang raja renyah, taburan keju cheddar</p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-borderline/60 flex items-center justify-between">
                                <span class="text-base font-extrabold text-charcoal">Rp 20.000</span>
                                <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">Tersedia</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- RIGHT AREA: ORDER CART / TICKET (30%) -->
        <aside class="w-full lg:w-[30%] max-w-md bg-white flex flex-col h-full shadow-lg z-10 shrink-0">
            <!-- Top Cart Header -->
            <div class="p-5 border-b border-borderline shrink-0 space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-primary-light text-primary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px]">receipt_long</span>
                        </div>
                        <h2 class="text-lg font-extrabold text-charcoal leading-tight">Pesanan Baru</h2>
                    </div>
                    <button class="text-xs font-semibold text-rose-500 hover:text-rose-700 hover:bg-rose-50 px-2.5 py-1.5 rounded-lg transition duration-150">
                        Hapus Semua
                    </button>
                </div>
                <div class="relative w-full">
                    <input class="w-full px-3 py-2 bg-surface border border-gray-200 rounded-lg text-xs font-medium text-charcoal placeholder-muted focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition duration-150" placeholder="Masukkan nama pelanggan..." type="text">
                </div>
                <div class="flex items-center gap-2 pt-1">
                    <button type="button" class="flex-1 py-2 rounded-lg bg-primary text-white text-xs font-semibold flex items-center justify-center gap-1.5 shadow-sm transition">
                        <span class="material-symbols-outlined text-[16px]">restaurant</span>
                        <span>Dine In</span>
                    </button>
                    <button type="button" class="flex-1 py-2 rounded-lg bg-white border border-gray-200 text-charcoal hover:bg-surface text-xs font-medium flex items-center justify-center gap-1.5 transition">
                        <span class="material-symbols-outlined text-[16px] text-muted">takeout_dining</span>
                        <span>Take Away</span>
                    </button>
                </div>
            </div>

            <!-- Item List (Scrollable) -->
            <div class="flex-1 overflow-y-auto p-5 space-y-3.5">
                <!-- Cart Item 1: Nasi Goreng Spesial -->
                <div class="p-3.5 rounded-xl border border-borderline/80 bg-surface/50 hover:bg-surface transition">
                    <div class="flex items-start justify-between">
                        <div class="pr-2">
                            <h4 class="font-bold text-charcoal text-sm leading-tight">Nasi Goreng Spesial</h4>
                            <p class="text-xs text-muted mt-0.5">Rp 35.000 / porsi</p>
                        </div>
                        <span class="font-extrabold text-charcoal text-sm">Rp 70.000</span>
                    </div>
                    <div class="mt-3 flex items-center justify-between pt-2 border-t border-borderline/40">
                        <div class="flex items-center gap-2">
                            <button class="w-7 h-7 rounded-lg border border-borderline bg-white hover:bg-gray-100 text-charcoal font-bold flex items-center justify-center transition">
                                <span class="material-symbols-outlined text-[16px]">remove</span>
                            </button>
                            <span class="w-6 text-center font-bold text-charcoal text-sm">2</span>
                            <button class="w-7 h-7 rounded-lg bg-primary-light hover:bg-primary-subtle text-primary border border-primary/20 font-bold flex items-center justify-center transition">
                                <span class="material-symbols-outlined text-[16px]">add</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Cart Item 2: Ayam Bakar Madu -->
                <div class="p-3.5 rounded-xl border border-borderline/80 bg-surface/50 hover:bg-surface transition">
                    <div class="flex items-start justify-between">
                        <div class="pr-2">
                            <h4 class="font-bold text-charcoal text-sm leading-tight">Ayam Bakar Madu</h4>
                            <p class="text-xs text-muted mt-0.5">Rp 42.000 / porsi</p>
                        </div>
                        <span class="font-extrabold text-charcoal text-sm">Rp 42.000</span>
                    </div>
                    <div class="mt-3 flex items-center justify-between pt-2 border-t border-borderline/40">
                        <div class="flex items-center gap-2">
                            <button class="w-7 h-7 rounded-lg border border-borderline bg-white hover:bg-gray-100 text-charcoal font-bold flex items-center justify-center transition">
                                <span class="material-symbols-outlined text-[16px]">remove</span>
                            </button>
                            <span class="w-6 text-center font-bold text-charcoal text-sm">1</span>
                            <button class="w-7 h-7 rounded-lg bg-primary-light hover:bg-primary-subtle text-primary border border-primary/20 font-bold flex items-center justify-center transition">
                                <span class="material-symbols-outlined text-[16px]">add</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Cart Item 3: Es Teh Manis Jumbo -->
                <div class="p-3.5 rounded-xl border border-borderline/80 bg-surface/50 hover:bg-surface transition">
                    <div class="flex items-start justify-between">
                        <div class="pr-2">
                            <h4 class="font-bold text-charcoal text-sm leading-tight">Es Teh Manis Jumbo</h4>
                            <p class="text-xs text-muted mt-0.5">Rp 8.000 / gelas</p>
                        </div>
                        <span class="font-extrabold text-charcoal text-sm">Rp 16.000</span>
                    </div>
                    <div class="mt-3 flex items-center justify-between pt-2 border-t border-borderline/40">
                        <div class="flex items-center gap-2">
                            <button class="w-7 h-7 rounded-lg border border-borderline bg-white hover:bg-gray-100 text-charcoal font-bold flex items-center justify-center transition">
                                <span class="material-symbols-outlined text-[16px]">remove</span>
                            </button>
                            <span class="w-6 text-center font-bold text-charcoal text-sm">2</span>
                            <button class="w-7 h-7 rounded-lg bg-primary-light hover:bg-primary-subtle text-primary border border-primary/20 font-bold flex items-center justify-center transition">
                                <span class="material-symbols-outlined text-[16px]">add</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Calculation & CTA (Sticky at bottom of cart) -->
            <div class="p-5 border-t border-borderline bg-white shrink-0 shadow-sm space-y-4">
                <div class="space-y-2 text-xs font-medium text-muted">
                    <div class="flex justify-between items-center">
                        <span>Subtotal (5 item)</span>
                        <span class="text-charcoal font-bold">Rp 128.000</span>
                    </div>
                    <div class="pt-3 border-t border-borderline flex justify-between items-baseline">
                        <span class="text-sm font-bold text-charcoal">Total Akhir</span>
                        <span class="text-2xl font-extrabold text-charcoal tracking-tight">Rp 126.500</span>
                    </div>
                </div>

                <!-- Payment Method Quick Pill -->
                <div class="grid grid-cols-2 gap-2 text-xs font-bold">
                    <button class="py-2.5 px-3 rounded-lg border border-primary bg-primary-light text-primary flex items-center justify-center gap-1.5 shadow-sm transition">
                        <span class="material-symbols-outlined text-[18px]">payments</span>
                        <span>Tunai</span>
                    </button>
                    <button class="py-2.5 px-3 rounded-lg border border-borderline bg-surface hover:bg-gray-100 text-charcoal flex items-center justify-center gap-1.5 transition">
                        <span class="material-symbols-outlined text-[18px] text-muted">qr_code_scanner</span>
                        <span>QRIS</span>
                    </button>
                </div>

                <!-- Massive Prominent CTA Button -->
                <button class="w-full py-4 px-6 rounded-xl bg-primary hover:bg-primary-hover text-white font-extrabold text-base tracking-wide shadow-lg shadow-emerald-500/25 flex items-center justify-center gap-2.5 transition active:scale-[0.99] cursor-pointer">
                    <span class="material-symbols-outlined text-[22px]">point_of_sale</span>
                    <span>Bayar — Rp 126.500</span>
                </button>
            </div>
        </aside>
    </main>
</body>
</html>
