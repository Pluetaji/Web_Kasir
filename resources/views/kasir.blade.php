<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <header class="h-20 px-8 py-4 bg-white border-b border-borderline shadow-sm flex items-center justify-between shrink-0 z-20">
        <!-- Left: RestoPOS Brand -->
        <div class="flex items-center gap-3.5 shrink-0">
            <div class="w-11 h-11 rounded-xl bg-primary flex items-center justify-center text-white shadow-sm shadow-emerald-500/20 shrink-0">
                <span class="material-symbols-outlined text-[24px]">restaurant</span>
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
            <div class="hidden lg:flex items-center gap-2 text-xs font-semibold text-muted px-3.5 py-2 bg-surface rounded-lg border border-borderline">
                <span class="material-symbols-outlined text-[18px] text-muted">calendar_today</span>
                <span>{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}</span>
            </div>

            <!-- Divider -->
            <div class="h-7 w-px bg-borderline hidden lg:block"></div>

            <!-- User Profile -->
            <div id="profile-btn" class="relative flex items-center gap-3 cursor-pointer py-1">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-100 border border-blue-200 text-blue-700 font-bold flex items-center justify-center text-sm shrink-0">
                        {{ strtoupper(substr(auth()->user()->name ?? 'K', 0, 1)) }}
                    </div>
                    <div class="hidden md:block text-left">
                        <div class="text-xs font-bold text-charcoal leading-tight">{{ auth()->user()->name ?? 'Kasir' }}</div>
                        <div class="text-[11px] font-medium text-muted leading-tight mt-0.5">{{ ucfirst(auth()->user()->role ?? 'Kasir') }}</div>
                    </div>
                    <span class="material-symbols-outlined text-[18px] text-muted">expand_more</span>
                </div>

                <!-- Dropdown Menu Popover -->
                <div id="profile-dropdown" class="hidden absolute right-0 top-full mt-2 w-52 bg-white rounded-xl shadow-lg border border-borderline p-1.5 z-50 text-left">
                    @if (auth()->user()?->role === 'manager')
                        <a class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold text-charcoal hover:bg-surface transition" href="{{ url('/manager') }}">
                            <span class="material-symbols-outlined text-[18px] text-muted">dashboard</span>
                            <span>Kembali ke Dashboard</span>
                        </a>
                        <div class="h-px bg-borderline my-1"></div>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold text-red-600 hover:bg-rose-50 transition text-left cursor-pointer">
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
                    <input id="searchMenuInput" class="w-full pl-10 pr-12 py-2.5 bg-white border border-borderline rounded-xl text-sm font-medium text-charcoal placeholder-muted focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition duration-150 shadow-sm" placeholder="Cari menu makanan atau minuman..." type="text">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <kbd class="hidden sm:inline-flex items-center px-1.5 py-0.5 text-[10px] font-semibold text-muted bg-surface border border-borderline rounded">ESC</kbd>
                    </div>
                </div>
            </div>

            <!-- Category Tabs Bar -->
            <div class="px-8 pb-4 shrink-0 flex items-center justify-between pt-2">
                <div class="flex items-center gap-2 overflow-x-auto pb-1 max-w-full" id="categoryFilterContainer">
                    <!-- Static Active Tab: Semua -->
                    <button type="button" 
                            onclick="filterByCategory('all', this)"
                            class="category-btn px-5 py-2.5 rounded-xl bg-primary text-white font-bold text-xs tracking-wide shadow-sm shadow-emerald-500/20 flex items-center gap-2 transition cursor-pointer" 
                            data-category-id="all">
                        <span class="material-symbols-outlined text-[18px]">restaurant_menu</span>
                        <span>Semua</span>
                        <span class="bg-white/20 text-white text-[11px] px-1.5 py-0.2 rounded-full font-bold">{{ $products->count() }}</span>
                    </button>
                    <!-- Dynamic Categories -->
                    @foreach ($categories as $category)
                        <button type="button" 
                                onclick="filterByCategory('{{ $category->id }}', this)"
                                class="category-btn px-5 py-2.5 rounded-xl bg-white border border-borderline hover:border-gray-300 text-charcoal hover:text-black font-semibold text-xs tracking-wide shadow-sm transition flex items-center gap-2 cursor-pointer" 
                                data-category-id="{{ $category->id }}">
                            <span class="material-symbols-outlined text-[18px] text-muted">category</span>
                            <span>{{ $category->name }}</span>
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Menu Grid (Scrollable, 3 or 4 columns) -->
            <div class="flex-1 overflow-y-auto px-8 pb-8 pt-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5" id="productGrid">
                    @forelse ($products as $product)
                        @php
                            $imgSrc = null;
                            if ($product->image) {
                                $imgSrc = str_starts_with($product->image, 'http')
                                    ? $product->image
                                    : asset('storage/' . $product->image);
                            }
                        @endphp
                        <div class="product-card bg-white rounded-2xl border border-borderline overflow-hidden shadow-sm hover:shadow-md hover:border-primary/40 transition duration-150 flex flex-col cursor-pointer group"
                             data-category-id="{{ $product->category_id }}"
                             data-id="{{ $product->id }}"
                             data-name="{{ $product->name }}"
                             data-price="{{ $product->price }}">
                            <div class="h-40 w-full bg-slate-50 flex items-center justify-center relative overflow-hidden">
                                @if ($imgSrc)
                                    <img src="{{ $imgSrc }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-200">
                                @else
                                    <div class="w-20 h-20 rounded-full bg-white/80 shadow-inner flex items-center justify-center text-slate-400 group-hover:scale-105 transition duration-200">
                                        <span class="material-symbols-outlined text-[48px]">restaurant</span>
                                    </div>
                                @endif
                                <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-charcoal text-[11px] font-bold px-2.5 py-0.5 rounded-full border border-gray-200 shadow-xs">
                                    {{ $product->category->name ?? 'Menu' }}
                                </span>
                                <button type="button" 
                                        class="add-to-cart-btn absolute bottom-3 right-3 w-8 h-8 rounded-full bg-white shadow-md flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition cursor-pointer"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        data-price="{{ $product->price }}">
                                    <span class="material-symbols-outlined text-[20px] pointer-events-none">add</span>
                                </button>
                            </div>
                            <div class="p-4 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-bold text-charcoal text-base group-hover:text-primary transition leading-snug">{{ $product->name }}</h3>
                                    <p class="text-xs text-muted mt-0.5 line-clamp-1">{{ $product->description ?: 'Menu pilihan lezat' }}</p>
                                </div>
                                <div class="mt-4 pt-3 border-t border-borderline/60 flex items-center justify-between">
                                    <span class="text-base font-extrabold text-charcoal">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">Tersedia</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center text-muted flex flex-col items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-4xl text-slate-300">restaurant_menu</span>
                            <p class="font-bold text-sm text-charcoal">Belum ada menu yang aktif</p>
                            <p class="text-xs text-muted">Aktifkan menu produk di dashboard manajer untuk menampilkannya di layar kasir.</p>
                        </div>
                    @endforelse

                    <!-- Filter/Search No Match State -->
                    <div id="noResultsMessage" class="hidden col-span-full py-16 text-center text-muted flex flex-col items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-4xl text-slate-300">search_off</span>
                        <p class="font-bold text-sm text-charcoal">Menu tidak ditemukan</p>
                        <p class="text-xs text-muted">Tidak ada produk yang cocok dengan kategori atau kata kunci pencarian.</p>
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
                    <button id="btn-clear-cart" type="button" class="text-xs font-semibold text-rose-500 hover:text-rose-700 hover:bg-rose-50 px-2.5 py-1.5 rounded-lg transition duration-150 cursor-pointer">
                        Hapus Semua
                    </button>
                </div>
                <div class="relative w-full">
                    <input id="customer-name" name="customer_name" class="w-full px-3 py-2 bg-surface border border-gray-200 rounded-lg text-xs font-medium text-charcoal placeholder-muted focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition duration-150" placeholder="Masukkan nama pelanggan..." type="text">
                    <p id="name-warning" class="text-red-500 text-xs mt-1 hidden">* Nama pelanggan wajib diisi sebelum melakukan pembayaran.</p>
                </div>
                <div class="flex items-center gap-2 pt-1">
                    <button id="btn-dine-in" type="button" class="flex-1 py-2 rounded-lg bg-primary text-white text-xs font-semibold flex items-center justify-center gap-1.5 shadow-sm transition cursor-pointer">
                        <span class="material-symbols-outlined text-[16px]">restaurant</span>
                        <span>Dine In</span>
                    </button>
                    <button id="btn-take-away" type="button" class="flex-1 py-2 rounded-lg bg-white border border-gray-200 text-charcoal hover:bg-surface text-xs font-medium flex items-center justify-center gap-1.5 transition cursor-pointer">
                        <span class="material-symbols-outlined text-[16px] text-muted">takeout_dining</span>
                        <span>Take Away</span>
                    </button>
                </div>
            </div>

            <!-- Item List (Scrollable) -->
            <div id="cart-items-container" class="flex-1 overflow-y-auto p-5 space-y-3.5">
                <!-- Dynamically populated via renderCart() -->
            </div>

            <!-- Bottom Calculation & CTA (Sticky at bottom of cart) -->
            <div class="p-5 border-t border-borderline bg-white shrink-0 shadow-sm space-y-4">
                <div class="space-y-2 text-xs font-medium text-muted">
                    <div class="flex justify-between items-center">
                        <span id="cart-subtotal-label">Subtotal (0 item)</span>
                        <span id="cart-subtotal" class="text-charcoal font-bold">Rp 0</span>
                    </div>
                    <div class="pt-3 border-t border-borderline flex justify-between items-baseline">
                        <span class="text-sm font-bold text-charcoal">Total Akhir</span>
                        <span id="cart-total" class="text-2xl font-extrabold text-charcoal tracking-tight">Rp 0</span>
                    </div>
                </div>

                <!-- Payment Method Quick Pill -->
                <div class="grid grid-cols-2 gap-2 text-xs font-bold">
                    <button id="btn-tunai" type="button" class="py-2.5 px-3 rounded-lg border border-primary bg-primary-light text-primary flex items-center justify-center gap-1.5 shadow-sm transition cursor-pointer">
                        <span class="material-symbols-outlined text-[18px]">payments</span>
                        <span>Tunai</span>
                    </button>
                    <button id="btn-qris" type="button" class="py-2.5 px-3 rounded-lg border border-borderline bg-surface hover:bg-gray-100 text-charcoal flex items-center justify-center gap-1.5 transition cursor-pointer">
                        <span class="material-symbols-outlined text-[18px] text-muted">qr_code_scanner</span>
                        <span>QRIS</span>
                    </button>
                </div>

                <!-- Massive Prominent CTA Button -->
                <button id="btn-main-pay" type="button" class="w-full py-4 px-6 rounded-xl bg-primary hover:bg-primary-hover text-white font-extrabold text-base tracking-wide shadow-lg shadow-emerald-500/25 flex items-center justify-center gap-2.5 transition active:scale-[0.99] cursor-pointer">
                    <span class="material-symbols-outlined text-[22px]">point_of_sale</span>
                    <span id="payment-total-btn">Bayar — Rp 0</span>
                </button>
            </div>
        </aside>
    </main>

    <!-- ========================================== -->
    <!-- 1. PAYMENT CONFIRMATION MODAL -->
    <!-- ========================================== -->
    <div id="paymentModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 transition-all">
        <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full overflow-hidden border border-borderline">
            <!-- Modal Header -->
            <div class="px-6 py-5 border-b border-borderline flex items-center justify-between bg-surface">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-primary-light text-primary flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[22px]">payments</span>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-charcoal leading-tight">Konfirmasi Pembayaran</h3>
                        <p class="text-xs text-muted mt-0.5" id="modal-order-summary">Dine In • Tunai</p>
                    </div>
                </div>
                <button type="button" onclick="closePaymentModal()" class="w-8 h-8 rounded-full text-muted hover:text-charcoal hover:bg-white flex items-center justify-center transition cursor-pointer">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 space-y-4">
                <!-- Total Tagihan Callout -->
                <div class="p-4 rounded-2xl bg-primary-light border border-primary/20 text-center">
                    <span class="text-xs font-semibold text-primary uppercase tracking-wider">Total Tagihan</span>
                    <div class="text-3xl font-extrabold text-charcoal tracking-tight mt-1" id="modal-bill-total">Rp 0</div>
                </div>

                <!-- Customer & Payment Details Card -->
                <div class="grid grid-cols-2 gap-3 text-xs bg-surface p-3.5 rounded-xl border border-borderline">
                    <div>
                        <span class="text-muted block">Pelanggan:</span>
                        <span class="font-bold text-charcoal truncate block" id="modal-customer-name">Pelanggan Umum</span>
                    </div>
                    <div>
                        <span class="text-muted block">Metode Pembayaran:</span>
                        <span class="font-bold text-charcoal block" id="modal-payment-method-badge">Tunai</span>
                    </div>
                </div>

                <!-- Uang Diterima Group (Active for Tunai) -->
                <div id="cash-input-group" class="space-y-3">
                    <div>
                        <label class="block text-xs font-bold text-charcoal mb-1.5" for="cash-received-input">
                            Uang Diterima (Rp)
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-xs font-bold text-muted pointer-events-none">Rp</span>
                            <input id="cash-received-input" 
                                   type="number" 
                                   min="0"
                                   placeholder="0"
                                   class="w-full pl-10 pr-4 py-3 bg-white border-2 border-borderline rounded-xl text-base font-extrabold text-charcoal focus:border-primary focus:outline-none transition">
                        </div>
                    </div>

                    <!-- Quick Cash Shortcut Buttons -->
                    <div class="flex items-center gap-1.5 flex-wrap">
                        <button type="button" onclick="setExactCash()" class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-surface hover:bg-emerald-50 text-charcoal hover:text-primary border border-borderline transition cursor-pointer">
                            Uang Pas
                        </button>
                        <button type="button" onclick="setCashAmount(50000)" class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-surface hover:bg-emerald-50 text-charcoal hover:text-primary border border-borderline transition cursor-pointer">
                            50.000
                        </button>
                        <button type="button" onclick="setCashAmount(100000)" class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-surface hover:bg-emerald-50 text-charcoal hover:text-primary border border-borderline transition cursor-pointer">
                            100.000
                        </button>
                        <button type="button" onclick="setCashAmount(200000)" class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-surface hover:bg-emerald-50 text-charcoal hover:text-primary border border-borderline transition cursor-pointer">
                            200.000
                        </button>
                    </div>

                    <!-- Kembalian Display -->
                    <div class="p-3.5 rounded-xl border border-borderline bg-surface flex items-center justify-between">
                        <span class="text-xs font-semibold text-muted">Kembalian:</span>
                        <span id="modal-change-amount" class="text-base font-extrabold text-charcoal">Rp 0</span>
                    </div>

                    <!-- Warning if cash is insufficient -->
                    <p id="cash-warning-msg" class="hidden text-xs font-semibold text-rose-600 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">error</span>
                        <span>Uang yang diterima kurang dari total tagihan!</span>
                    </p>
                </div>

                <!-- Non-cash instruction info -->
                <div id="non-cash-info-group" class="hidden p-4 rounded-xl bg-blue-50 border border-blue-200 text-xs text-blue-800 space-y-1">
                    <div class="font-bold flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[18px]">qr_code_scanner</span>
                        <span>Pembayaran Digital (<span id="non-cash-method-name">QRIS</span>)</span>
                    </div>
                    <p class="text-[11px] leading-relaxed text-blue-700">Pastikan pembayaran pelanggan telah diverifikasi sebelum mengklik konfirmasi.</p>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-surface border-t border-borderline flex items-center justify-end gap-3">
                <button type="button" onclick="closePaymentModal()" class="px-4 py-2.5 rounded-xl border border-borderline bg-white hover:bg-gray-100 text-charcoal text-xs font-bold transition cursor-pointer">
                    Batal
                </button>
                <button id="btn-confirm-checkout" type="button" class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-bold shadow-md shadow-emerald-500/20 flex items-center gap-2 transition cursor-pointer">
                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                    <span id="btn-confirm-checkout-text">Konfirmasi Bayar</span>
                </button>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- 2. SUCCESS TRANSACTION MODAL -->
    <!-- ========================================== -->
    <div id="success-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 transition-all">
        <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full overflow-hidden border border-borderline p-6 text-center">
            <!-- Green checkmark icon -->
            <div class="w-16 h-16 rounded-full bg-emerald-100 text-primary flex items-center justify-center mx-auto mb-4 shadow-inner">
                <span class="material-symbols-outlined text-[36px]">check_circle</span>
            </div>

            <h3 class="text-xl font-extrabold text-charcoal mb-1">Transaksi Berhasil!</h3>
            <p class="text-xs text-muted mb-4">Pembayaran telah diterima dan tersimpan di database.</p>

            <!-- Invoice & Change Summary Card -->
            <div class="bg-surface rounded-2xl p-4 border border-borderline text-left space-y-2 mb-6">
                <div class="flex justify-between items-center text-xs">
                    <span class="text-muted">No. Invoice</span>
                    <span class="font-bold text-charcoal font-mono" id="success-invoice-no">-</span>
                </div>
                <div class="flex justify-between items-center text-xs">
                    <span class="text-muted">Total Pembayaran</span>
                    <span class="font-extrabold text-charcoal" id="success-total-paid">Rp 0</span>
                </div>
                <div id="success-change-row" class="flex justify-between items-center text-xs pt-2 border-t border-borderline">
                    <span class="text-muted font-semibold">Kembalian</span>
                    <span class="font-extrabold text-emerald-600 text-sm" id="success-change-amount">Rp 0</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-2.5">
                <button id="btn-print-receipt" type="button" class="w-full py-3 px-4 rounded-xl bg-charcoal hover:bg-black text-white text-xs font-bold flex items-center justify-center gap-2 shadow-sm transition cursor-pointer">
                    <span class="material-symbols-outlined text-[18px]">print</span>
                    <span>Cetak Struk Pembayaran</span>
                </button>
                <button type="button" onclick="closeSuccessModal()" class="w-full bg-white border border-gray-300 text-gray-700 font-semibold py-3 px-4 rounded-lg hover:bg-gray-50 transition duration-200 cursor-pointer">
                    Selesai / Pesanan Baru
                </button>
            </div>
        </div>
    </div>

    <script>
        let activeCategoryId = 'all';

        function filterByCategory(categoryId, btn) {
            activeCategoryId = String(categoryId);

            // Update button styles
            document.querySelectorAll('.category-btn').forEach(button => {
                const isSelected = button.getAttribute('data-category-id') === activeCategoryId;
                const icon = button.querySelector('.material-symbols-outlined');

                if (isSelected) {
                    button.className = 'category-btn px-5 py-2.5 rounded-xl bg-primary text-white font-bold text-xs tracking-wide shadow-sm shadow-emerald-500/20 flex items-center gap-2 transition cursor-pointer';
                    if (icon) icon.className = 'material-symbols-outlined text-[18px] text-white';
                } else {
                    button.className = 'category-btn px-5 py-2.5 rounded-xl bg-white border border-borderline hover:border-gray-300 text-charcoal hover:text-black font-semibold text-xs tracking-wide shadow-sm transition flex items-center gap-2 cursor-pointer';
                    if (icon) icon.className = 'material-symbols-outlined text-[18px] text-muted';
                }
            });

            applyFilters();
        }

        function applyFilters() {
            const searchInput = document.getElementById('searchMenuInput');
            const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
            const cards = document.querySelectorAll('.product-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const cardCategoryId = String(card.getAttribute('data-category-id') || '');
                const cardTitle = card.querySelector('h3')?.textContent.toLowerCase() || '';
                const cardDesc = card.querySelector('p')?.textContent.toLowerCase() || '';

                const matchesCategory = (activeCategoryId === 'all' || cardCategoryId === activeCategoryId);
                const matchesSearch = query === '' || cardTitle.includes(query) || cardDesc.includes(query);

                if (matchesCategory && matchesSearch) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            const noResultsEl = document.getElementById('noResultsMessage');
            if (noResultsEl) {
                if (visibleCount === 0 && cards.length > 0) {
                    noResultsEl.classList.remove('hidden');
                } else {
                    noResultsEl.classList.add('hidden');
                }
            }
        }

        // Live search listener
        const searchInput = document.getElementById('searchMenuInput');
        if (searchInput) {
            searchInput.addEventListener('input', applyFilters);
            searchInput.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    searchInput.value = '';
                    applyFilters();
                    searchInput.blur();
                }
            });
        }

        // ==========================================
        // 2. Interactive Cart Logic (Vanilla JS)
        // ==========================================
        let cart = [];

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        function renderCart() {
            const container = document.getElementById('cart-items-container');
            const subtotalEl = document.getElementById('cart-subtotal');
            const totalEl = document.getElementById('cart-total');
            const paymentBtnEl = document.getElementById('payment-total-btn');
            const subtotalLabelEl = document.getElementById('cart-subtotal-label');

            if (!container) return;

            let total = 0;
            let totalItems = 0;

            if (cart.length === 0) {
                container.innerHTML = `
                    <div class="h-full min-h-[220px] flex flex-col items-center justify-center text-center p-6 text-muted">
                        <div class="w-14 h-14 rounded-2xl bg-surface border border-borderline flex items-center justify-center text-slate-300 mb-3">
                            <span class="material-symbols-outlined text-[28px]">shopping_cart</span>
                        </div>
                        <p class="font-bold text-sm text-charcoal">Keranjang Masih Kosong</p>
                        <p class="text-xs text-muted mt-1 max-w-[200px]">Pilih menu di sebelah kiri untuk menambah pesanan.</p>
                    </div>
                `;
            } else {
                let html = '';
                cart.forEach(item => {
                    const itemTotal = item.price * item.qty;
                    total += itemTotal;
                    totalItems += item.qty;

                    html += `
                        <div class="p-3.5 rounded-xl border border-borderline/80 bg-surface/50 hover:bg-surface transition">
                            <div class="flex items-start justify-between">
                                <div class="pr-2">
                                    <h4 class="font-bold text-charcoal text-sm leading-tight">${item.name}</h4>
                                    <p class="text-xs text-muted mt-0.5">Rp ${formatRupiah(item.price)} / porsi</p>
                                </div>
                                <span class="font-extrabold text-charcoal text-sm">Rp ${formatRupiah(itemTotal)}</span>
                            </div>
                            <div class="mt-3 flex items-center justify-between pt-2 border-t border-borderline/40">
                                <div class="flex items-center gap-2">
                                    <button type="button" class="btn-qty-minus w-7 h-7 rounded-lg border border-borderline bg-white hover:bg-gray-100 text-charcoal font-bold flex items-center justify-center transition cursor-pointer" data-id="${item.id}">
                                        <span class="material-symbols-outlined text-[16px] pointer-events-none">remove</span>
                                    </button>
                                    <span class="w-6 text-center font-bold text-charcoal text-sm">${item.qty}</span>
                                    <button type="button" class="btn-qty-plus w-7 h-7 rounded-lg bg-primary-light hover:bg-primary-subtle text-primary border border-primary/20 font-bold flex items-center justify-center transition cursor-pointer" data-id="${item.id}">
                                        <span class="material-symbols-outlined text-[16px] pointer-events-none">add</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                });
                container.innerHTML = html;
            }

            const formattedTotal = 'Rp ' + formatRupiah(total);
            if (subtotalEl) subtotalEl.textContent = formattedTotal;
            if (totalEl) totalEl.textContent = formattedTotal;
            if (paymentBtnEl) paymentBtnEl.textContent = `Bayar — ${formattedTotal}`;
            if (subtotalLabelEl) subtotalLabelEl.textContent = `Subtotal (${totalItems} item)`;
        }

        function addToCart(id, name, price) {
            id = String(id);
            const existing = cart.find(item => String(item.id) === id);
            if (existing) {
                existing.qty += 1;
            } else {
                cart.push({
                    id: id,
                    name: name,
                    price: Number(price),
                    qty: 1
                });
            }
            renderCart();
        }

        function changeQty(id, delta) {
            id = String(id);
            const itemIndex = cart.findIndex(item => String(item.id) === id);
            if (itemIndex > -1) {
                cart[itemIndex].qty += delta;
                if (cart[itemIndex].qty <= 0) {
                    cart.splice(itemIndex, 1);
                }
                renderCart();
            }
        }

        // Attach click event to all .add-to-cart-btn elements
        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const id = btn.getAttribute('data-id');
                const name = btn.getAttribute('data-name');
                const price = parseFloat(btn.getAttribute('data-price')) || 0;
                addToCart(id, name, price);
            });
        });

        // Also allow clicking the product card to add to cart
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('click', (e) => {
                if (e.target.closest('.add-to-cart-btn')) return;
                const id = card.getAttribute('data-id');
                const name = card.getAttribute('data-name');
                const price = parseFloat(card.getAttribute('data-price')) || 0;
                if (id) {
                    addToCart(id, name, price);
                }
            });
        });

        // Attach click event to #btn-clear-cart
        const clearCartBtn = document.getElementById('btn-clear-cart');
        if (clearCartBtn) {
            clearCartBtn.addEventListener('click', () => {
                cart = [];
                renderCart();
            });
        }

        // Event delegation on #cart-items-container for (+) and (-) buttons
        const cartContainer = document.getElementById('cart-items-container');
        if (cartContainer) {
            cartContainer.addEventListener('click', (e) => {
                const minusBtn = e.target.closest('.btn-qty-minus');
                if (minusBtn) {
                    const id = minusBtn.getAttribute('data-id');
                    changeQty(id, -1);
                    return;
                }

                const plusBtn = e.target.closest('.btn-qty-plus');
                if (plusBtn) {
                    const id = plusBtn.getAttribute('data-id');
                    changeQty(id, 1);
                    return;
                }
            });
        }

        // Initial render on page load
        renderCart();

        // ==========================================
        // 3. Order Type & Payment Method Toggle Logic
        // ==========================================
        let orderType = 'Dine In';
        let paymentMethod = 'Tunai';

        const btnDineIn = document.getElementById('btn-dine-in');
        const btnTakeAway = document.getElementById('btn-take-away');

        const orderTypeActiveClasses = ['bg-primary', 'text-white', 'shadow-sm'];
        const orderTypeInactiveClasses = ['bg-white', 'border', 'border-gray-200', 'text-charcoal', 'hover:bg-surface'];

        function updateOrderTypeUI() {
            if (orderType === 'Dine In') {
                btnDineIn.classList.remove(...orderTypeInactiveClasses);
                btnDineIn.classList.add(...orderTypeActiveClasses);
                btnDineIn.querySelector('.material-symbols-outlined')?.classList.remove('text-muted');

                btnTakeAway.classList.remove(...orderTypeActiveClasses);
                btnTakeAway.classList.add(...orderTypeInactiveClasses);
                btnTakeAway.querySelector('.material-symbols-outlined')?.classList.add('text-muted');
            } else {
                btnTakeAway.classList.remove(...orderTypeInactiveClasses);
                btnTakeAway.classList.add(...orderTypeActiveClasses);
                btnTakeAway.querySelector('.material-symbols-outlined')?.classList.remove('text-muted');

                btnDineIn.classList.remove(...orderTypeActiveClasses);
                btnDineIn.classList.add(...orderTypeInactiveClasses);
                btnDineIn.querySelector('.material-symbols-outlined')?.classList.add('text-muted');
            }
        }

        if (btnDineIn) {
            btnDineIn.addEventListener('click', () => {
                orderType = 'Dine In';
                updateOrderTypeUI();
            });
        }

        if (btnTakeAway) {
            btnTakeAway.addEventListener('click', () => {
                orderType = 'Take Away';
                updateOrderTypeUI();
            });
        }

        const btnTunai = document.getElementById('btn-tunai');
        const btnQris = document.getElementById('btn-qris');

        const paymentActiveClasses = ['border-primary', 'bg-primary-light', 'text-primary'];
        const paymentInactiveClasses = ['border-borderline', 'bg-surface', 'hover:bg-gray-100', 'text-charcoal'];

        function updatePaymentMethodUI() {
            if (paymentMethod === 'Tunai') {
                btnTunai.classList.remove(...paymentInactiveClasses);
                btnTunai.classList.add(...paymentActiveClasses);
                btnTunai.querySelector('.material-symbols-outlined')?.classList.remove('text-muted');

                btnQris.classList.remove(...paymentActiveClasses);
                btnQris.classList.add(...paymentInactiveClasses);
                btnQris.querySelector('.material-symbols-outlined')?.classList.add('text-muted');
            } else {
                btnQris.classList.remove(...paymentInactiveClasses);
                btnQris.classList.add(...paymentActiveClasses);
                btnQris.querySelector('.material-symbols-outlined')?.classList.remove('text-muted');

                btnTunai.classList.remove(...paymentActiveClasses);
                btnTunai.classList.add(...paymentInactiveClasses);
                btnTunai.querySelector('.material-symbols-outlined')?.classList.add('text-muted');
            }
        }

        if (btnTunai) {
            btnTunai.addEventListener('click', () => {
                paymentMethod = 'Tunai';
                updatePaymentMethodUI();
            });
        }

        if (btnQris) {
            btnQris.addEventListener('click', () => {
                paymentMethod = 'QRIS';
                updatePaymentMethodUI();
            });
        }

        // ==========================================
        // 4. Checkout, Modals, & Receipt Flow
        // ==========================================
        let currentTransactionId = null;

        function getCartTotal() {
            return cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
        }

        function openPaymentModal() {
            const customerNameInput = (document.getElementById('customer-name')?.value || '').trim();
            const warningEl = document.getElementById('name-warning');
            const inputEl = document.getElementById('customer-name');

            if (!customerNameInput) {
                if (warningEl) warningEl.classList.remove('hidden');
                if (inputEl) {
                    inputEl.classList.add('border-red-500');
                    inputEl.classList.remove('border-gray-200');
                    inputEl.focus();
                }
                return; // Stop execution, prevent modal from opening
            }

            if (warningEl) warningEl.classList.add('hidden');
            if (inputEl) {
                inputEl.classList.remove('border-red-500');
                inputEl.classList.add('border-gray-200');
            }

            if (cart.length === 0) {
                alert('Keranjang belanja masih kosong!');
                return;
            }

            const total = getCartTotal();
            const customerName = customerNameInput;

            // Populate Modal Info
            document.getElementById('modal-order-summary').textContent = `${orderType} • ${paymentMethod}`;
            document.getElementById('modal-bill-total').textContent = 'Rp ' + formatRupiah(total);
            document.getElementById('modal-customer-name').textContent = customerName;
            document.getElementById('modal-payment-method-badge').textContent = paymentMethod;

            const cashGroup = document.getElementById('cash-input-group');
            const nonCashGroup = document.getElementById('non-cash-info-group');
            const cashInput = document.getElementById('cash-received-input');

            if (paymentMethod === 'Tunai') {
                cashGroup.classList.remove('hidden');
                nonCashGroup.classList.add('hidden');
                cashInput.value = total;
                calculateChange();
            } else {
                cashGroup.classList.add('hidden');
                nonCashGroup.classList.remove('hidden');
                document.getElementById('non-cash-method-name').textContent = paymentMethod;
                // Enable confirm button for non-cash
                const confirmBtn = document.getElementById('btn-confirm-checkout');
                if (confirmBtn) {
                    confirmBtn.disabled = false;
                    confirmBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            }

            document.getElementById('paymentModal').classList.remove('hidden');

            if (paymentMethod === 'Tunai' && cashInput) {
                setTimeout(() => cashInput.select(), 100);
            }
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').classList.add('hidden');
        }

        function calculateChange() {
            if (paymentMethod !== 'Tunai') return;

            const total = getCartTotal();
            const cashInput = document.getElementById('cash-received-input');
            const cash = parseFloat(cashInput ? cashInput.value : 0) || 0;
            const changeDisplay = document.getElementById('modal-change-amount');
            const warningMsg = document.getElementById('cash-warning-msg');
            const confirmBtn = document.getElementById('btn-confirm-checkout');

            if (cash < total) {
                if (warningMsg) warningMsg.classList.remove('hidden');
                if (changeDisplay) changeDisplay.textContent = 'Rp 0';
                if (confirmBtn) {
                    confirmBtn.disabled = true;
                    confirmBtn.classList.add('opacity-50', 'cursor-not-allowed');
                }
            } else {
                if (warningMsg) warningMsg.classList.add('hidden');
                const change = cash - total;
                if (changeDisplay) changeDisplay.textContent = 'Rp ' + formatRupiah(change);
                if (confirmBtn) {
                    confirmBtn.disabled = false;
                    confirmBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            }
        }

        function setExactCash() {
            const cashInput = document.getElementById('cash-received-input');
            if (cashInput) {
                cashInput.value = getCartTotal();
                calculateChange();
            }
        }

        function setCashAmount(amt) {
            const cashInput = document.getElementById('cash-received-input');
            if (cashInput) {
                cashInput.value = amt;
                calculateChange();
            }
        }

        // Live calculation on cash input
        const cashReceivedInput = document.getElementById('cash-received-input');
        if (cashReceivedInput) {
            cashReceivedInput.addEventListener('input', calculateChange);
            cashReceivedInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    const confirmBtn = document.getElementById('btn-confirm-checkout');
                    if (confirmBtn && !confirmBtn.disabled) {
                        confirmBtn.click();
                    }
                }
            });
        }

        // Pay button triggers Payment Modal with strict validation
        const btnMainPay = document.getElementById('btn-main-pay');
        if (btnMainPay) {
            btnMainPay.addEventListener('click', function() {
                const customerNameInput = (document.getElementById('customer-name')?.value || '').trim();
                const warningEl = document.getElementById('name-warning');
                const inputEl = document.getElementById('customer-name');

                if (!customerNameInput) {
                    if (warningEl) warningEl.classList.remove('hidden');
                    if (inputEl) {
                        inputEl.classList.add('border-red-500');
                        inputEl.classList.remove('border-gray-200');
                        inputEl.focus();
                    }
                    return; // Stop execution, prevent modal from opening
                }

                if (warningEl) warningEl.classList.add('hidden');
                if (inputEl) {
                    inputEl.classList.remove('border-red-500');
                    inputEl.classList.add('border-gray-200');
                }

                if (cart.length === 0) {
                    alert('Keranjang belanja masih kosong!');
                    return;
                }
                openPaymentModal();
            });
        }

        // Confirm Checkout Handler (Fetch to /kasir/checkout)
        const btnConfirmCheckout = document.getElementById('btn-confirm-checkout');
        if (btnConfirmCheckout) {
            btnConfirmCheckout.addEventListener('click', () => {
                const total = getCartTotal();
                if (cart.length === 0 || total <= 0) {
                    alert('Keranjang belanja masih kosong!');
                    return;
                }

                const customerInput = document.getElementById('customer-name');
                const customerName = (customerInput && customerInput.value.trim()) ? customerInput.value.trim() : '';
                if (!customerName) {
                    alert('Nama pelanggan harus diisi sebelum melakukan pembayaran!');
                    return;
                }

                let cashReceived = total;
                if (paymentMethod === 'Tunai') {
                    const cashInput = document.getElementById('cash-received-input');
                    const cash = parseFloat(cashInput ? cashInput.value : 0) || 0;
                    if (cash < total) {
                        alert('Uang yang diterima kurang dari total tagihan.');
                        return;
                    }
                    cashReceived = cash;
                }

                const confirmBtnText = document.getElementById('btn-confirm-checkout-text');
                btnConfirmCheckout.disabled = true;
                if (confirmBtnText) confirmBtnText.textContent = 'Memproses...';

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

                fetch('/kasir/checkout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        cart: cart,
                        customer_name: customerName,
                        order_type: orderType,
                        payment_method: paymentMethod,
                        cash_received: cashReceived
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        currentTransactionId = data.transaction_id;
                        closePaymentModal();

                        // Populate Success Modal
                        document.getElementById('success-invoice-no').textContent = data.invoice_number;
                        document.getElementById('success-total-paid').textContent = 'Rp ' + formatRupiah(data.total_price);
                        
                        const changeRow = document.getElementById('success-change-row');
                        if (paymentMethod === 'Tunai') {
                            if (changeRow) changeRow.classList.remove('hidden');
                            document.getElementById('success-change-amount').textContent = 'Rp ' + formatRupiah(data.change_amount);
                        } else {
                            if (changeRow) changeRow.classList.add('hidden');
                        }

                        // Show Success Modal
                        const successModal = document.getElementById('success-modal');
                        if (successModal) successModal.classList.remove('hidden');
                    } else {
                        alert(data.message || 'Terjadi kesalahan saat memproses checkout.');
                    }
                })
                .catch(err => {
                    console.error('Checkout error:', err);
                    alert('Gagal terhubung ke server. Periksa koneksi dan coba lagi.');
                })
                .finally(() => {
                    btnConfirmCheckout.disabled = false;
                    if (confirmBtnText) confirmBtnText.textContent = 'Konfirmasi Bayar';
                });
            });
        }

        // Print Receipt Button Handler
        const btnPrintReceipt = document.getElementById('btn-print-receipt');
        if (btnPrintReceipt) {
            btnPrintReceipt.addEventListener('click', () => {
                if (currentTransactionId) {
                    window.open('/kasir/struk/' + currentTransactionId, '_blank');
                }
            });
        }

        // Typing listener to clear customer name warning as soon as user types
        const customerNameEl = document.getElementById('customer-name');
        if (customerNameEl) {
            customerNameEl.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    const warningEl = document.getElementById('name-warning');
                    if (warningEl) warningEl.classList.add('hidden');
                    this.classList.remove('border-red-500');
                    this.classList.add('border-gray-200');
                }
            });
        }

        // Global Reset & Close Success Modal Function
        function closeSuccessModal() {
            // 1. Sembunyikan modal sukses
            const successModal = document.getElementById('success-modal');
            if (successModal) successModal.classList.add('hidden');
            
            // 2. Kosongkan array keranjang
            cart = [];
            
            // 3. Kosongkan input nama pelanggan dan reset tampilan border
            const customerInput = document.getElementById('customer-name');
            if (customerInput) {
                customerInput.value = '';
                customerInput.classList.remove('border-red-500');
                customerInput.classList.add('border-gray-200');
            }
            
            // 4. Reset variabel state ke default UI
            orderType = 'Dine In';
            paymentMethod = 'Tunai';
            updateOrderTypeUI();
            updatePaymentMethodUI();
            
            // 5. Render ulang keranjang (akan menjadi kosong)
            renderCart();
            
            // 6. Sembunyikan teks peringatan merah jika masih muncul
            const nameWarning = document.getElementById('name-warning');
            if (nameWarning) nameWarning.classList.add('hidden');

            currentTransactionId = null;
        }

        // ==========================================
        // 5. Profile Dropdown Click-to-Toggle
        // ==========================================
        const profileBtn = document.getElementById('profile-btn');
        const profileDropdown = document.getElementById('profile-dropdown');

        if (profileBtn && profileDropdown) {
            // Buka/tutup menu saat profil diklik
            profileBtn.addEventListener('click', function(e) {
                e.stopPropagation(); // Mencegah event bocor ke window
                profileDropdown.classList.toggle('hidden');
            });

            // Tutup menu jika user mengeklik area mana saja di luar menu
            window.addEventListener('click', function(e) {
                if (!profileBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                    profileDropdown.classList.add('hidden');
                }
            });
        }
    </script>
</body>
</html>
