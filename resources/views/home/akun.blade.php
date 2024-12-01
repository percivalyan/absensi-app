@extends('layouts.home')

@section('content')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.getElementById('navbar_1');
            if (navbar) {
                navbar.style.display = 'none';
            }
        });
    </script>
    <div class="container py-5">
        <!-- Header Section -->
        <div class="mb-5">
            <h1 class="fw-bold text-primary">E-Absensi</h1>
            <div class="d-flex align-items-center text-muted">
                <i class="fas fa-user-circle me-3 fs-2 text-dark"></i> <!-- Icon user -->
                <div>
                    <p class="mb-0 fw-semibold text-dark">{{ auth()->user()->name }}</p>
                    <p class="mb-0">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>

        <!-- Overview Text -->
        <p class="fw-semibold text-muted mb-4">Overview</p>

        <!-- Buttons Section -->
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <a href="" class="btn btn-lg btn-success w-100 py-3 fw-bold shadow-sm hover-shadow">
                    LAPORAN ABSENSI
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <a href="" class="btn btn-lg btn-warning w-100 py-3 fw-bold shadow-sm hover-shadow">
                    MANAJEMEN PENILAIAN
                </a>
            </div>
        </div>

        <!-- Bottom Navigation -->
        <div class="fixed-bottom bg-white d-flex justify-content-around border-top py-3">
            <a href="{{ url('/') }}" class="text-decoration-none text-center">
                <i class="fas fa-home" style="font-size: 28px; color: #007bff;"></i>
                <p class="small m-0">Beranda</p>
            </a>
            <a href="{{ url('/home/notification') }}" class="text-decoration-none text-center">
                <i class="fas fa-bell" style="font-size: 28px; color: #6c757d;"></i>
                <p class="small m-0">Notifikasi</p>
            </a>
            <a href="{{ url('/home/account') }}" class="text-decoration-none text-center">
                <i class="fas fa-user-cog" style="font-size: 28px; color: #6c757d;"></i>
                <p class="small m-0">Profil</p>
            </a>
        </div>
    </div>
@endsection
