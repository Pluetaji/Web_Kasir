@extends('layouts.admin')

@section('title', 'Dashboard Manager - RestoPOS')

@section('content')
<div class="flex flex-col w-full mt-2">
    <!-- Minimalist Executive Header -->
    <header class="mb-8">
        <h1 class="font-headline-lg text-headline-lg font-bold text-on-surface tracking-tight">
            Dashboard Manager
        </h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-1.5 max-w-2xl">
            Selamat datang kembali, pantau performa operasional dan pendapatan restoran Anda hari ini.
        </p>
    </header>

    <!-- Top Metric Cards (2-Column Grid) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Card 1: Revenue -->
        <div class="relative overflow-hidden bg-surface-container-lowest rounded-xl p-6 shadow-sm flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div class="flex flex-col">
                    <span class="font-label-caps text-label-caps uppercase text-on-surface-variant tracking-wide">
                        Total Pendapatan Hari Ini
                    </span>
                    <div class="font-data-metric text-data-metric text-on-surface tracking-tight mt-2">
                        Rp 2.450.000
                    </div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-primary-fixed flex items-center justify-center text-primary shrink-0" style="background-color: rgb(236, 253, 245); color: rgb(5, 150, 105);">
                    <span class="material-symbols-outlined text-[20px]">payments</span>
                </div>
            </div>
            <div class="mt-5 pt-4 flex items-center justify-between border-t border-surface-container-low/60">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container-low text-primary font-label-md text-label-md" style="background-color: rgb(236, 253, 245); color: rgb(5, 150, 105);">
                    <span class="material-symbols-outlined text-[15px] font-bold">trending_up</span>
                    <span>+14.2% vs kemarin</span>
                </div>
                <span class="font-label-caps text-label-caps text-on-surface-variant">Update 12m lalu</span>
            </div>
        </div>

        <!-- Card 2: Orders -->
        <div class="relative overflow-hidden bg-surface-container-lowest rounded-xl p-6 shadow-sm flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div class="flex flex-col">
                    <span class="font-label-caps text-label-caps uppercase text-on-surface-variant tracking-wide">
                        Total Pesanan Hari Ini
                    </span>
                    <div class="font-data-metric text-data-metric text-on-surface tracking-tight mt-2">
                        128 Pesanan
                    </div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-surface-container-low flex items-center justify-center text-on-surface-variant shrink-0">
                    <span class="material-symbols-outlined text-[20px]">receipt_long</span>
                </div>
            </div>
            <div class="mt-5 pt-4 flex items-center justify-between border-t border-surface-container-low/60">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container-low text-on-surface font-label-md text-label-md">
                    <span class="material-symbols-outlined text-[15px] text-primary" style="color: rgb(5, 150, 105);">check_circle</span>
                    <span>+8 pesanan dari target siang</span>
                </div>
                <span class="font-label-caps text-label-caps text-on-surface-variant">Kapasitas 82%</span>
            </div>
        </div>
    </div>

    <!-- Monthly Revenue Trend (Chart Card) -->
    <div class="bg-surface-container-lowest rounded-xl p-6 lg:p-8 shadow-sm">
        <!-- Chart Header -->
        <div class="mb-6">
            <h2 class="font-headline-md text-headline-md font-bold text-on-surface">
                Grafik Pendapatan Bulanan
            </h2>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
                Tren akumulasi pendapatan harian bulan berjalan (Oktober 2026)
            </p>
        </div>

        <!-- SVG Vector Line Chart -->
        <div class="w-full overflow-x-auto">
            <div class="min-w-[640px] w-full">
                <svg class="w-full h-auto block select-none" viewBox="0 0 880 320" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="terracottaGradient" x1="0" x2="0" y1="0" y2="1">
                            <stop offset="0%" stop-color="#059669" stop-opacity="0.22"></stop>
                            <stop offset="85%" stop-color="#059669" stop-opacity="0.03"></stop>
                            <stop offset="100%" stop-color="#10b981" stop-opacity="0"></stop>
                        </linearGradient>
                        <filter height="130%" id="softShadow" width="120%" x="-10%" y="-10%">
                            <feDropShadow dx="0" dy="3" flood-color="#121c2a" flood-opacity="0.08" stdDeviation="3"></feDropShadow>
                        </filter>
                    </defs>
                    <!-- Horizontal Reference Gridlines & Y-Axis Labels -->
                    <line stroke="#eff4ff" stroke-dasharray="3 3" stroke-width="1.5" x1="72" x2="848" y1="36" y2="36"></line>
                    <text fill="#59413c" font-family="Inter, sans-serif" font-size="11" font-weight="500" text-anchor="end" x="64" y="40">Rp 80Jt</text>
                    <line stroke="#eff4ff" stroke-dasharray="3 3" stroke-width="1.5" x1="72" x2="848" y1="92" y2="92"></line>
                    <text fill="#59413c" font-family="Inter, sans-serif" font-size="11" font-weight="500" text-anchor="end" x="64" y="96">Rp 60Jt</text>
                    <line stroke="#eff4ff" stroke-dasharray="3 3" stroke-width="1.5" x1="72" x2="848" y1="148" y2="148"></line>
                    <text fill="#59413c" font-family="Inter, sans-serif" font-size="11" font-weight="500" text-anchor="end" x="64" y="152">Rp 40Jt</text>
                    <line stroke="#eff4ff" stroke-dasharray="3 3" stroke-width="1.5" x1="72" x2="848" y1="204" y2="204"></line>
                    <text fill="#59413c" font-family="Inter, sans-serif" font-size="11" font-weight="500" text-anchor="end" x="64" y="208">Rp 20Jt</text>
                    <line stroke="#d9e3f6" stroke-width="1.5" x1="72" x2="848" y1="260" y2="260"></line>
                    <text fill="#59413c" font-family="Inter, sans-serif" font-size="11" font-weight="500" text-anchor="end" x="64" y="264">Rp 0</text>
                    <!-- Smooth Area Fill under Curve -->
                    <path d="M 88 245 C 140 238, 170 220, 210 205 C 255 190, 290 182, 335 158 C 380 134, 420 148, 465 125 C 510 102, 545 92, 590 76 C 630 62, 675 68, 715 54 C 755 42, 800 48, 840 40 L 840 260 L 88 260 Z" fill="url(#terracottaGradient)"></path>
                    <!-- Main Bezier Line Stroke -->
                    <path d="M 88 245 C 140 238, 170 220, 210 205 C 255 190, 290 182, 335 158 C 380 134, 420 148, 465 125 C 510 102, 545 92, 590 76 C 630 62, 675 68, 715 54 C 755 42, 800 48, 840 40" fill="none" stroke="#10b981" stroke-linecap="round" stroke-linejoin="round" stroke-width="3.5"></path>
                    <!-- Milestone Point Markers -->
                    <circle cx="88" cy="245" fill="#ffffff" r="3.5" stroke="#10b981" stroke-width="2"></circle>
                    <circle cx="210" cy="205" fill="#ffffff" r="3.5" stroke="#10b981" stroke-width="2"></circle>
                    <circle cx="335" cy="158" fill="#ffffff" r="3.5" stroke="#10b981" stroke-width="2"></circle>
                    <circle cx="465" cy="125" fill="#ffffff" r="3.5" stroke="#10b981" stroke-width="2"></circle>
                    <circle cx="590" cy="76" fill="#ffffff" r="3.5" stroke="#10b981" stroke-width="2"></circle>
                    <circle cx="715" cy="54" fill="#ffffff" r="3.5" stroke="#10b981" stroke-width="2"></circle>
                    <!-- Active Day Indicator -->
                    <line stroke="#10b981" stroke-dasharray="4 4" stroke-opacity="0.4" stroke-width="1.5" x1="715" x2="715" y1="54" y2="260"></line>
                    <circle cx="715" cy="54" fill="#059669" filter="url(#softShadow)" r="6" stroke="#ffffff" stroke-width="2.5"></circle>
                    <!-- Minimalist Callout Tooltip for Today -->
                    <g filter="url(#softShadow)" transform="translate(635, 14)">
                        <rect fill="#121c2a" height="28" rx="6" width="160" x="0" y="0"></rect>
                        <polygon fill="#121c2a" points="80,28 76,33 84,33"></polygon>
                        <text fill="#ffffff" font-family="Inter, sans-serif" font-size="11.5" font-weight="600" text-anchor="middle" x="80" y="18">
                            Hari ini: Rp 2.450.000
                        </text>
                    </g>
                    <!-- X-Axis Labels -->
                    <text fill="#59413c" font-family="Inter, sans-serif" font-size="11" font-weight="500" text-anchor="middle" x="88" y="284">Tgl 1</text>
                    <text fill="#59413c" font-family="Inter, sans-serif" font-size="11" font-weight="500" text-anchor="middle" x="210" y="284">Tgl 5</text>
                    <text fill="#59413c" font-family="Inter, sans-serif" font-size="11" font-weight="500" text-anchor="middle" x="335" y="284">Tgl 10</text>
                    <text fill="#59413c" font-family="Inter, sans-serif" font-size="11" font-weight="500" text-anchor="middle" x="465" y="284">Tgl 15</text>
                    <text fill="#59413c" font-family="Inter, sans-serif" font-size="11" font-weight="500" text-anchor="middle" x="590" y="284">Tgl 20</text>
                    <text fill="#059669" font-family="Inter, sans-serif" font-size="11" font-weight="700" text-anchor="middle" x="715" y="284">Tgl 25</text>
                    <text fill="#59413c" font-family="Inter, sans-serif" font-size="11" font-weight="500" text-anchor="middle" x="840" y="284">Tgl 30</text>
                </svg>
            </div>
        </div>
    </div>
</div>
@endsection
