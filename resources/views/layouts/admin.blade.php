<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="web_dashboard" name="shell-type">
    <title>@yield('title', 'RestoPOS - Manager')</title>

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <style>
        @layer base {
            html, body { margin: 0; padding: 0; }
            body { overscroll-behavior: none; }
            main > :first-child { margin-top: 0 !important; }
            main > :last-child { margin-bottom: 0 !important; }
        }
        ::-webkit-scrollbar { display: none; }
        :root {
            --primary: #059669;
        }
        .text-primary { color: #059669 !important; }
        .bg-primary { background-color: #059669 !important; }
        .border-primary { border-color: #059669 !important; }
        .bg-primary-fixed { background-color: #d1fae5 !important; }
    </style>

    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "tertiary": "#00647d",
                        "surface-variant": "#d9e3f6",
                        "on-error-container": "#93000a",
                        "surface-container-low": "#eff4ff",
                        "primary-fixed-dim": "#ffb4a4",
                        "inverse-surface": "#27313f",
                        "on-secondary-fixed-variant": "#753224",
                        "on-tertiary-fixed-variant": "#004d61",
                        "tertiary-fixed": "#b9eaff",
                        "on-primary-container": "#fffbff",
                        "on-primary": "#ffffff",
                        "surface-container-high": "#dee9fc",
                        "tertiary-fixed-dim": "#6ed3f8",
                        "surface-container-highest": "#d9e3f6",
                        "on-tertiary-fixed": "#001f29",
                        "primary-fixed": "#ffdad3",
                        "inverse-primary": "#ffb4a4",
                        "surface-bright": "#f8f9ff",
                        "background": "#f8f9ff",
                        "surface-container": "#e6eeff",
                        "surface-tint": "#af2f17",
                        "secondary-container": "#ffa08c",
                        "on-secondary-fixed": "#3c0802",
                        "outline": "#8d706b",
                        "on-surface": "#121c2a",
                        "on-background": "#121c2a",
                        "secondary": "#934939",
                        "on-primary-fixed": "#3e0500",
                        "primary": "#ac2d15",
                        "surface": "#f8f9ff",
                        "on-surface-variant": "#59413c",
                        "error": "#ba1a1a",
                        "on-tertiary-container": "#fafdff",
                        "on-error": "#ffffff",
                        "secondary-fixed": "#ffdad3",
                        "on-primary-fixed-variant": "#8d1600",
                        "surface-container-lowest": "#ffffff",
                        "surface-dim": "#d0dbed",
                        "outline-variant": "#e1bfb8",
                        "on-secondary-container": "#783526",
                        "primary-container": "#ce452b",
                        "error-container": "#ffdad6",
                        "on-tertiary": "#ffffff",
                        "inverse-on-surface": "#eaf1ff",
                        "tertiary-container": "#007f9e",
                        "secondary-fixed-dim": "#ffb4a4",
                        "on-secondary": "#ffffff"
                    },
                    borderRadius: {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    spacing: {
                        "margin-lg": "2rem",
                        "space-xs": "0.25rem",
                        "space-md": "1rem",
                        "space-sm": "0.5rem",
                        "space-lg": "1.5rem",
                        "gutter-lg": "1.5rem",
                        "space-xl": "2rem",
                        "gutter": "1rem",
                        "margin-md": "1.5rem",
                        "margin": "1rem"
                    },
                    fontFamily: {
                        "label-caps": ["Inter"],
                        "body-sm": ["Inter"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "display-hero": ["Plus Jakarta Sans"],
                        "body-md": ["Inter"],
                        "data-metric-sm": ["Plus Jakarta Sans"],
                        "label-md": ["Inter"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "data-metric": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "display-hero-mobile": ["Plus Jakarta Sans"],
                        "title-sm": ["Plus Jakarta Sans"]
                    },
                    fontSize: {
                        "label-caps": ["11px", { lineHeight: "14px", letterSpacing: "0.05em", fontWeight: "600" }],
                        "body-sm": ["13px", { lineHeight: "18px", fontWeight: "400" }],
                        "headline-md": ["20px", { lineHeight: "28px", letterSpacing: "-0.01em", fontWeight: "600" }],
                        "display-hero": ["36px", { lineHeight: "44px", letterSpacing: "-0.02em", fontWeight: "700" }],
                        "body-md": ["14px", { lineHeight: "20px", fontWeight: "400" }],
                        "data-metric-sm": ["24px", { lineHeight: "32px", letterSpacing: "-0.015em", fontWeight: "700" }],
                        "label-md": ["12px", { lineHeight: "16px", letterSpacing: "0.01em", fontWeight: "500" }],
                        "headline-lg-mobile": ["22px", { lineHeight: "30px", letterSpacing: "-0.01em", fontWeight: "600" }],
                        "data-metric": ["32px", { lineHeight: "38px", letterSpacing: "-0.02em", fontWeight: "700" }],
                        "headline-lg": ["28px", { lineHeight: "36px", letterSpacing: "-0.015em", fontWeight: "600" }],
                        "display-hero-mobile": ["28px", { lineHeight: "36px", letterSpacing: "-0.02em", fontWeight: "700" }],
                        "title-sm": ["16px", { lineHeight: "24px", fontWeight: "600" }]
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-background font-body-md text-body-md text-on-surface antialiased">
    <svg aria-hidden="true" class="inline-defs-container" style="position:absolute;width:0;height:0;overflow:hidden"></svg>

    <!-- Left Navigation Sidebar -->
    <aside class="fixed left-0 top-0 h-screen w-64 bg-surface-container-lowest shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-50 flex flex-col justify-between p-6">
        <div class="flex flex-col gap-8">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-on-primary shrink-0" style="background-color: rgb(5, 150, 105); color: rgb(255, 255, 255);">
                    <span class="material-symbols-outlined text-[20px]">restaurant</span>
                </div>
                <div class="flex items-center">
                    <span class="font-headline-md text-headline-md tracking-tight text-on-surface font-bold">Resto</span>
                    <span class="font-headline-md text-headline-md tracking-tight text-primary font-bold" style="color: rgb(5, 150, 105);">POS</span>
                </div>
            </div>
            <nav class="flex flex-col gap-2">
                <a href="{{ url('/manager') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->is('manager') ? 'bg-primary text-on-primary font-title-sm text-title-sm shadow-sm' : 'font-title-sm text-title-sm text-on-surface hover:bg-surface-container-low hover:text-on-surface' }}" style="{{ request()->is('manager') ? 'background-color: rgb(5, 150, 105); color: rgb(255, 255, 255);' : '' }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span>Dashboard Manager</span>
                </a>
                <a href="{{ url('/manager/produk') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->is('manager/produk*') || request()->is('manager/kategori*') ? 'bg-primary text-on-primary font-title-sm text-title-sm shadow-sm' : 'font-title-sm text-title-sm text-on-surface hover:bg-surface-container-low hover:text-on-surface' }}" style="{{ (request()->is('manager/produk*') || request()->is('manager/kategori*')) ? 'background-color: rgb(5, 150, 105); color: rgb(255, 255, 255);' : '' }}">
                    <span class="material-symbols-outlined">restaurant_menu</span>
                    <span>Daftar Menu</span>
                </a>
                <a href="{{ url('/manager/pengguna') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->is('manager/pengguna*') ? 'bg-primary text-on-primary font-title-sm text-title-sm shadow-sm' : 'font-title-sm text-title-sm text-on-surface hover:bg-surface-container-low hover:text-on-surface' }}" style="{{ request()->is('manager/pengguna*') ? 'background-color: rgb(5, 150, 105); color: rgb(255, 255, 255);' : '' }}">
                    <span class="material-symbols-outlined">group</span>
                    <span>Pengguna</span>
                </a>
            </nav>
        </div>
        <div class="mt-auto flex flex-col gap-3">
            <a href="{{ url('/kasir') }}" class="w-full py-3 px-4 rounded-xl bg-primary text-on-primary font-title-sm text-title-sm flex items-center justify-center gap-2 shadow-sm transition-all hover:opacity-95" style="background-color: rgb(5, 150, 105); color: rgb(255, 255, 255);">
                <span class="material-symbols-outlined text-[20px]">point_of_sale</span>
                <span>Buka Layar Kasir</span>
            </a>
            <div class="relative">
                <div id="sidebar-profile-btn" class="flex items-center justify-between p-2 rounded-xl hover:bg-surface-container-low transition-all cursor-pointer">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-10 h-10 rounded-full bg-primary/10 border-2 border-primary/20 text-primary font-bold flex items-center justify-center text-[16px] shrink-0 font-headline-md">
                            {{ strtoupper(substr(auth()->user()->name ?? 'D', 0, 1)) }}
                        </div>
                        <div class="flex flex-col min-w-0 text-left">
                            <span class="font-title-sm text-title-sm text-on-surface font-bold truncate">{{ auth()->user()->name ?? 'Dheka' }}</span>
                            <span class="font-label-md text-label-md text-on-surface-variant truncate">{{ ucfirst(auth()->user()->role ?? 'Manajer') }}</span>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-[20px] text-on-surface-variant transition-colors">more_vert</span>
                </div>
                <!-- Popover Menu -->
                <div id="sidebar-profile-dropdown" class="absolute left-0 right-0 bottom-full mb-2 hidden z-50 bg-white rounded-xl shadow-lg border border-slate-200 p-1.5 transition-all">
                    <div class="px-3 py-2 border-b border-slate-100 mb-1">
                        <p class="text-xs font-semibold text-slate-800">{{ auth()->user()->name ?? 'Dheka' }} ({{ ucfirst(auth()->user()->role ?? 'Manajer') }})</p>
                        <p class="text-[11px] text-slate-500 truncate">{{ auth()->user()->email ?? 'dheka@restopos.id' }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 text-sm text-red-600 rounded-lg hover:bg-red-50 transition-colors font-medium text-left">
                            <span class="material-symbols-outlined text-[18px]">logout</span>
                            <span>Log out</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Top Header and Main Content -->
    <div class="pl-64 min-h-screen bg-background">
        <header class="fixed top-0 left-64 right-0 h-16 bg-surface-container-lowest/80 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-40 px-8 flex items-center justify-between">
            <div class="flex items-center gap-3"></div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 text-on-surface-variant font-medium text-body-sm">
                    <span class="material-symbols-outlined text-[18px] text-on-surface-variant">calendar_today</span>
                    <span>{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>
        </header>

        <main class="w-full pt-24 p-8 lg:p-10 lg:pt-28">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarBtn = document.getElementById('sidebar-profile-btn');
            const sidebarDropdown = document.getElementById('sidebar-profile-dropdown');

            if (sidebarBtn && sidebarDropdown) {
                // Toggle menu on click
                sidebarBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    sidebarDropdown.classList.toggle('hidden');
                });

                // Close menu when clicking outside
                window.addEventListener('click', function(e) {
                    if (!sidebarBtn.contains(e.target) && !sidebarDropdown.contains(e.target)) {
                        sidebarDropdown.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>
</html>
