@extends('layouts.app')

@section('content')
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.getElementById('navbar_1');
            if (navbar) navbar.style.display = 'none';

            // Button functionality for navigating between views
            const laporanAbsensiBtn = document.getElementById('laporanAbsensiBtn');
            const mainContent = document.getElementById('mainContent');
            const absensiContent = document.getElementById('absensiContent');
            const backButton = document.getElementById('backButton');

            if (laporanAbsensiBtn) {
                laporanAbsensiBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    mainContent.style.display = 'none';
                    absensiContent.style.display = 'block';
                });
            }

            if (backButton) {
                backButton.addEventListener('click', function() {
                    absensiContent.style.display = 'none';
                    mainContent.style.display = 'block';
                });
            }
        });
    </script> --}}

    <div class="container py-3" id="mainContent">
        <!-- User Info -->
        <div class="mb-5">
            <h1 class="fw-bold text-primary">E-Absensi</h1>
            <div class="d-flex align-items-center text-muted">
                <i class="fas fa-user-circle me-3 fs-2 text-dark"></i>
                <div>
                    <p class="mb-0 fw-semibold text-dark">{{ auth()->user()->name }}</p>
                    <p class="mb-0">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>

        <!-- Section Title -->
        <p class="fw-semibold text-muted mb-4">Overview</p>

      `  <!-- Cards Section -->
      <div class="row">
        @php
            $items = [
                [
                    'route' => 'presences.index',
                    'icon' => 'briefcase', // Ikon Font Awesome
                    'text' => 'LAPORAN PRESENSI',
                    'color' => 'success',
                ],
                [
                    'route' => 'attendances.index',
                    'icon' => 'calendar-alt', // Ikon Font Awesome
                    'text' => 'JADWAL PELAJARAN',
                    'color' => 'warning',
                ],
                [
                    'route' => 'subject_user.index',
                    'icon' => 'chalkboard-teacher', // Ikon Font Awesome
                    'text' => 'DATA GURU',
                    'color' => 'primary',
                ],
                [
                    'route' => 'subjects.index',
                    'icon' => 'chart-bar', // Ikon Font Awesome
                    'text' => 'MATA PELAJARAN',
                    'color' => 'secondary',
                ],
                // [
                //     'route' => 'subjects.index',
                //     'icon' => 'clipboard-list', // Ikon Font Awesome
                //     'text' => 'DATA IZIN',
                //     'color' => 'info',
                // ],
            ];
        @endphp
    
        @foreach ($items as $item)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <a href="{{ route($item['route']) }}"
                    class="btn btn-lg btn-{{ $item['color'] }} w-100 py-4 fw-bold shadow d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-{{ $item['icon'] }} mb-2" style="font-size: 2rem;"></i>
                    <span>{{ $item['text'] }}</span>
                </a>
            </div>
        @endforeach
    
        <!-- Data Count Cards -->
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="btn btn-lg btn-light w-100 py-4 fw-bold shadow d-flex flex-column align-items-center">
                <span>Data Jabatan</span>
                <div class="fw-bold" style="font-size: 1.5rem;">{{ $positionCount }}</div>
            </div>
        </div>
    
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="btn btn-lg btn-light w-100 py-4 fw-bold shadow d-flex flex-column align-items-center">
                <span>Data User</span>
                <div class="fw-bold" style="font-size: 1.5rem;">{{ $userCount }}</div>
            </div>
        </div>
    </div>
    
    </div>

    <!-- Bottom Navigation -->
    <div class="fixed-bottom bg-white d-flex justify-content-around border-top py-3">
        <a href="{{ url('/') }}" class="text-decoration-none text-center">
            <i class="fas fa-home" style="font-size: 28px; color: #007bff;"></i>
            <p class="small m-0">Beranda</p>
        </a>
        <a href="{{ url('/dashboard/notification') }}" class="text-decoration-none text-center">
            <i class="fas fa-bell" style="font-size: 28px; color: #6c757d;"></i>
            <p class="small m-0">Notifikasi</p>
        </a>
        <a href="{{ url('/dashboard/account') }}" class="text-decoration-none text-center">
            <i class="fas fa-user-cog" style="font-size: 28px; color: #6c757d;"></i>
            <p class="small m-0">Profil</p>
        </a>
    </div>
@endsection

<!-- Feather Icons Initialization -->
<script>
    feather.replace();
</script>
