@extends('layouts.home')

@section('content')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navbar = document.getElementById('navbar_1');
        if (navbar) {
            navbar.style.display = 'none';
        }

        // Element references
        const laporanAbsensiBtn = document.getElementById('laporanAbsensiBtn');
        const mainContent = document.getElementById('mainContent');
        const absensiContent = document.getElementById('absensiContent');

        // Handle button click
        laporanAbsensiBtn.addEventListener('click', function (e) {
            e.preventDefault();
            mainContent.style.display = 'none';
            absensiContent.style.display = 'block';
        });
    });
</script>

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm py-3">
    <div class="container">
        <button onclick="window.history.back();" class="btn btn-outline-primary btn-sm ms-3" style="margin-top: 10px;">
            <i class="fa fa-arrow-left"></i> Back
        </button>
        {{-- <a class="navbar-brand fw-bold" href="{{ route('home.index') }}">Absensi App</a> --}}

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav align-items-center gap-md-4 py-2 py-md-0">
                <li class="nav-item px-4 py-1 px-md-0 py-md-0">
                    <a class="nav-link {{ request()->routeIs('home.*') ? 'active fw-bold' : '' }}" href="{{ route('home.index') }}">Beranda</a>
                </li>
                <li class="nav-item px-4 py-1 px-md-0 py-md-0">
                    <form action="{{ route('auth.logout') }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger w-100 fw-bold">Keluar</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Profile Section -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-12">
            <div class="profil-container p-4 rounded shadow-sm bg-white">
                <div class="text-center mb-4">
                    <!-- User Icon -->
                    <div class="user-logo mb-3">
                        <i class="fas fa-user-circle" style="font-size: 100px; color: #1a73e8;"></i>
                    </div>
                    <h3>Profil</h3>
                </div>

                <div class="profil-info mb-3">
                    <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                    <p><strong>Tanggal Bergabung:</strong> {{ auth()->user()->created_at->format('d M Y') }}</p>
                </div>

                <!-- Change Password Button -->
                <div class="text-center">
                    <a href="{{ url('/employees/password') }}" class="btn btn-primary py-2 px-4 rounded-pill fw-bold">
                        Ganti Password
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Navigation (Sticky) -->
<div class="fixed-bottom bg-white d-flex justify-content-around border-top py-3">
    <a href="{{ url('/') }}" class="text-decoration-none text-center">
        <i class="fas fa-home" style="font-size: 28px; color: #6c757d;"></i>
        <p class="small m-0">Beranda</p>
    </a>
    <a href="{{ url('notification') }}" class="text-decoration-none text-center">
        <i class="fas fa-bell" style="font-size: 28px; color: #6c757d;"></i>
        <p class="small m-0">Notifikasi</p>
    </a>
    <a href="{{ url('/home/account') }}" class="text-decoration-none text-center">
        <i class="fas fa-user-cog" style="font-size: 28px; color: #007bff;"></i>
        <p class="small m-0">Profil</p>
    </a>
</div>

@endsection
