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
                        Rp {{ number_format($todayRevenue, 0, ',', '.') }}
                    </div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-primary-fixed flex items-center justify-center text-primary shrink-0" style="background-color: rgb(236, 253, 245); color: rgb(5, 150, 105);">
                    <span class="material-symbols-outlined text-[20px]">payments</span>
                </div>
            </div>
            <div class="mt-5 pt-4 flex items-center justify-between border-t border-surface-container-low/60">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container-low text-primary font-label-md text-label-md" style="background-color: rgb(236, 253, 245); color: rgb(5, 150, 105);">
                    <span class="material-symbols-outlined text-[15px] font-bold">trending_up</span>
                    <span>Hari ini</span>
                </div>
                <span class="font-label-caps text-label-caps text-on-surface-variant">Realtime</span>
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
                        {{ $todayOrders }} Pesanan
                    </div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-surface-container-low flex items-center justify-center text-on-surface-variant shrink-0">
                    <span class="material-symbols-outlined text-[20px]">receipt_long</span>
                </div>
            </div>
            <div class="mt-5 pt-4 flex items-center justify-between border-t border-surface-container-low/60">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container-low text-on-surface font-label-md text-label-md">
                    <span class="material-symbols-outlined text-[15px] text-primary" style="color: rgb(5, 150, 105);">check_circle</span>
                    <span>Selesai diproses</span>
                </div>
                <span class="font-label-caps text-label-caps text-on-surface-variant">Realtime</span>
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
                Tren akumulasi pendapatan harian bulan berjalan ({{ $currentMonthName ?? 'Bulan Ini' }})
            </p>
        </div>

        <!-- Dynamic Chart Container -->
        <div class="w-full">
            <div id="revenueChart" class="w-full min-h-[340px]"></div>
        </div>
    </div>
</div>

<!-- ApexCharts Library -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const chartData = @json($chartData);
        const chartLabels = @json($chartLabels);

        const options = {
            series: [{
                name: 'Total Pendapatan',
                data: chartData
            }],
            chart: {
                type: 'area',
                height: 330,
                fontFamily: 'Inter, sans-serif',
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            colors: ['#059669'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.30,
                    opacityTo: 0.04,
                    stops: [0, 90, 100]
                }
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            markers: {
                size: 3.5,
                colors: ['#ffffff'],
                strokeColors: '#059669',
                strokeWidth: 2,
                hover: {
                    size: 6
                }
            },
            dataLabels: {
                enabled: false
            },
            grid: {
                borderColor: '#eff4ff',
                strokeDashArray: 3,
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            xaxis: {
                categories: chartLabels,
                labels: {
                    style: {
                        colors: '#64748b',
                        fontSize: '11px',
                        fontFamily: 'Inter, sans-serif'
                    }
                },
                axisBorder: {
                    show: true,
                    color: '#e2e8f0'
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                // Automatically auto-scales based on real data
                labels: {
                    style: {
                        colors: '#64748b',
                        fontSize: '11px',
                        fontFamily: 'Inter, sans-serif'
                    },
                    formatter: function (value) {
                        return 'Rp ' + Number(value).toLocaleString('id-ID');
                    }
                }
            },
            tooltip: {
                theme: 'light',
                y: {
                    formatter: function (value) {
                        return 'Rp ' + Number(value).toLocaleString('id-ID');
                    }
                }
            }
        };

        const chartElement = document.querySelector("#revenueChart");
        if (chartElement) {
            const chart = new ApexCharts(chartElement, options);
            chart.render();
        }
    });
</script>
@endsection
