@extends('layouts.kepala.app')

@section('content')
    <style>
        .dashboard-page .page-title {
            font-size: 20px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 2px;
        }

        .dashboard-page .page-sub {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 18px;
        }

        /* STAT CARD */
        .dashboard-page .stat-card {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            color: white;
            border-radius: 14px;
            padding: 14px 16px;
            transition: transform 0.2s ease;
            height: 100%;
        }

        .dashboard-page .stat-card:hover {
            transform: translateY(-3px);
        }

        .dashboard-page .stat-card .stat-label {
            font-size: 11px;
            opacity: 0.85;
            margin-bottom: 6px;
        }

        .dashboard-page .stat-card .stat-value {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }

        /* MENU CARD */
        .dashboard-page .menu-card {
            background: #ffffff;
            border-radius: 14px;
            border: 0.5px solid #e2e8f0;
            padding: 14px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            height: 100%;
            transition: transform 0.2s ease;
        }

        .dashboard-page .menu-card:hover {
            transform: translateY(-4px);
        }

        .dashboard-page .menu-card .menu-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2px;
            flex-shrink: 0;
        }

        .dashboard-page .menu-card .menu-title {
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        .dashboard-page .menu-card .menu-desc {
            font-size: 11px;
            color: #64748b;
            margin: 0;
            flex: 1;
            line-height: 1.5;
        }

        .dashboard-page .menu-card .menu-btn {
            display: inline-block;
            font-size: 11px;
            font-weight: 500;
            background: #4f46e5;
            color: #fff;
            border-radius: 8px;
            padding: 5px 10px;
            text-decoration: none;
            align-self: flex-start;
            margin-top: 4px;
            transition: background 0.2s;
            white-space: nowrap;
        }

        .dashboard-page .menu-card .menu-btn:hover {
            background: #4338ca;
            color: #fff;
            text-decoration: none;
        }

        /* CHART CARD */
        .dashboard-page .chart-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 16px;
            border: 0.5px solid #e2e8f0;
        }

        .dashboard-page .chart-card .chart-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .dashboard-page .chart-card .chart-title {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        .dashboard-page .chart-card .chart-divider {
            border: none;
            border-top: 0.5px solid #e2e8f0;
            margin: 10px 0 14px;
        }

        .dashboard-page .chart-card #filterYear {
            width: 80px;
            border-radius: 8px;
            border: 0.5px solid #cbd5e1;
            background: #f8fafc;
            color: #1e293b;
            padding: 4px 8px;
            font-size: 12px;
        }

        .dashboard-page .chart-card #filterYear:focus {
            outline: none;
            border-color: #6366f1;
        }

        /* RESPONSIVE */
        @media (max-width: 575.98px) {
            .dashboard-page .page-title {
                font-size: 17px;
            }

            .dashboard-page .page-sub {
                font-size: 12px;
                margin-bottom: 14px;
            }

            .dashboard-page .stat-card {
                padding: 12px 14px;
                border-radius: 12px;
            }

            .dashboard-page .stat-card .stat-value {
                font-size: 20px;
            }

            .dashboard-page .stat-card .stat-label {
                font-size: 10px;
            }

            .dashboard-page .menu-card {
                padding: 12px;
                border-radius: 12px;
                gap: 4px;
            }

            .dashboard-page .menu-card .menu-icon {
                width: 32px;
                height: 32px;
                border-radius: 8px;
            }

            .dashboard-page .menu-card .menu-title {
                font-size: 12px;
            }

            .dashboard-page .menu-card .menu-desc {
                font-size: 10px;
            }

            .dashboard-page .menu-card .menu-btn {
                font-size: 10px;
                padding: 4px 8px;
            }

            .dashboard-page .chart-card {
                padding: 12px;
                border-radius: 12px;
            }

            .dashboard-page .chart-card .chart-title {
                font-size: 13px;
            }

            .dashboard-page .chart-card #filterYear {
                width: 70px;
                font-size: 11px;
            }

            .dashboard-page canvas#guestChart {
                height: 200px !important;
            }
        }
    </style>

    <div class="dashboard-page">

        <p class="page-title">Selamat datang, Kepala Desa</p>
        <p class="page-sub">Monitoring dan manajemen desa</p>

        {{-- Stat Cards --}}
        <div class="row g-2 g-md-3 mb-2 mb-md-3">
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <p class="stat-label">Total Aparat</p>
                    <p class="stat-value">{{ $totalAparat }}</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <p class="stat-label">Kunjungan bulan ini</p>
                    <p class="stat-value">{{ $kunjunganBulan }}</p>
                </div>
            </div>
            <div class="col-6 col-md-3 mt-2 mt-md-0">
                <div class="stat-card">
                    <p class="stat-label">Berita diterbitkan</p>
                    <p class="stat-value">{{ $totalBerita ?? 0 }}</p>
                </div>
            </div>
            <div class="col-6 col-md-3 mt-2 mt-md-0">
                <div class="stat-card">
                    <p class="stat-label">Galeri foto</p>
                    <p class="stat-value">{{ $totalGaleri ?? 0 }}</p>
                </div>
            </div>
        </div>

        {{-- Menu Cards --}}
        <div class="row g-2 g-md-3 mb-2 mb-md-3">
            <div class="col-6 col-md-3">
                <div class="menu-card">
                    <div class="menu-icon" style="background:#e6f1fb;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#185FA5"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="4" />
                            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                        </svg>
                    </div>
                    <p class="menu-title">Manajemen Aparat</p>
                    <p class="menu-desc">Kelola data aparat dan perangkat desa.</p>
                    <a href="{{ route('aparat.index') }}" class="menu-btn">Kelola Aparat</a>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="menu-card">
                    <div class="menu-icon" style="background:#dcfce7;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#15803d"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                    <p class="menu-title">Buku Tamu</p>
                    <p class="menu-desc">Lihat daftar tamu dan kunjungan desa.</p>
                    <a href="{{ route('kepala.bukutamu') }}" class="menu-btn">Lihat Buku Tamu</a>
                </div>
            </div>
            <div class="col-6 col-md-3 mt-2 mt-md-0">
                <div class="menu-card">
                    <div class="menu-icon" style="background:#fef9c3;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#a16207"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2" />
                            <path d="M18 14h-8" />
                            <path d="M15 18h-5" />
                            <path d="M10 6h8" />
                            <path d="M10 10h8" />
                        </svg>
                    </div>
                    <p class="menu-title">Berita Desa</p>
                    <p class="menu-desc">Tambah dan kelola berita terbaru desa.</p>
                    <a href="{{ route('kepala.berita.index') }}" class="menu-btn">Kelola Berita</a>
                </div>
            </div>
            <div class="col-6 col-md-3 mt-2 mt-md-0">
                <div class="menu-card">
                    <div class="menu-icon" style="background:#ede9fe;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#6d28d9"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" />
                            <path d="M3 9h18" />
                            <path d="M9 21V9" />
                        </svg>
                    </div>
                    <p class="menu-title">Galeri Desa</p>
                    <p class="menu-desc">Kelola foto dokumentasi kegiatan desa.</p>
                    <a href="{{ Auth::user()->role == 'kepala_desa' ? route('kepala.gallery.index') : route('aparat.gallery.index') }}"
                        class="menu-btn">Kelola Galeri</a>
                </div>
            </div>
        </div>

        {{-- Grafik Kunjungan --}}
        <div class="chart-card">
            <div class="chart-top">
                <p class="chart-title">Grafik kunjungan tamu</p>
                <input type="number" id="filterYear" value="{{ date('Y') }}" min="2000" max="2100">
            </div>
            <hr class="chart-divider">
            <div style="position: relative; width: 100%; height: 260px;">
                <canvas id="guestChart" role="img" aria-label="Grafik batang kunjungan tamu per bulan">
                    Data kunjungan tamu bulanan.
                </canvas>
            </div>
        </div>

    </div>{{-- end .dashboard-page --}}

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let chart;

        async function loadChart() {
            const year = parseInt(document.getElementById('filterYear').value);
            if (!year || year < 2000 || year > 2100) {
                alert('Tahun tidak valid');
                return;
            }

            const response = await fetch(`/chart/guest?year=${year}`);
            const result = await response.json();

            if (chart) chart.destroy();

            chart = new Chart(document.getElementById('guestChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: result.labels,
                    datasets: [{
                        label: 'Jumlah kunjungan',
                        data: result.values,
                        backgroundColor: '#c7d2fe',
                        borderColor: '#4f46e5',
                        borderWidth: 1,
                        borderRadius: 5,
                        borderSkipped: false,
                        barPercentage: 0.5,
                        categoryPercentage: 0.7,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            titleColor: '#94a3b8',
                            bodyColor: '#f1f5f9',
                            cornerRadius: 8,
                            padding: 10,
                            callbacks: {
                                label: ctx => ' ' + ctx.parsed.y + ' kunjungan'
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            border: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 11
                                },
                                color: '#94a3b8',
                                autoSkip: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            border: {
                                display: false,
                                dash: [4, 4]
                            },
                            grid: {
                                color: 'rgba(0,0,0,0.05)',
                                drawTicks: false
                            },
                            ticks: {
                                font: {
                                    size: 11
                                },
                                color: '#94a3b8',
                                padding: 8,
                                stepSize: 10
                            }
                        }
                    }
                }
            });
        }

        document.getElementById('filterYear').addEventListener('change', loadChart);
        loadChart();
    </script>
@endsection
