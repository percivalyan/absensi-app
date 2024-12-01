@extends('layouts.home')

@section('content')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navbar = document.getElementById('navbar_1');
        if (navbar) {
            navbar.style.display = 'none';
        }

        // Element references
        const notifikasiBtn = document.getElementById('notifikasiBtn');
        const mainContent = document.getElementById('mainContent');
        const notifikasiContent = document.getElementById('notifikasiContent');

        // Handle button click
        notifikasiBtn.addEventListener('click', function (e) {
            e.preventDefault();
            mainContent.style.display = 'none';
            notifikasiContent.style.display = 'block';
        });
    });
</script>

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm py-3">
    <div class="container">
        <button onclick="window.history.back();" class="btn btn-outline-primary btn-sm ms-3" style="margin-top: 10px;">
            <i class="fa fa-arrow-left"></i> Back
        </button>

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

<!-- Notifikasi Section -->
<div class="container text-center py-5">
    <div id="notifikasiSection">
        <h3 class="mb-4">Notifikasi</h3>
        <ul class="list-group text-start">
            {{-- <li class="list-group-item">Notifikasi 1: Pesan atau pemberitahuan terbaru.</li>
            <li class="list-group-item">Notifikasi 2: Pesan atau pemberitahuan penting lainnya.</li>
            <!-- Add more notifications here --> --}}

            <h1 class="text-center">Coming Soon</h1>
        </ul>
    </div>
</div>

<!-- Bottom Navigation -->
<div class="fixed-bottom bg-light d-flex justify-content-around border-top py-2">
    <a href="{{ url('/') }}" class="text-decoration-none text-center">
        <i class="fas fa-home" style="font-size: 24px; color: grey;"></i>
        <p class="small m-0">Beranda</p>
    </a>
    <a href="{{ url('/dashboard/notification') }}" class="text-decoration-none text-center">
        <i class="fas fa-bell" style="font-size: 24px; color: blue;"></i>
        <p class="small m-0">Notifikasi</p>
    </a>
    <a href="{{ url('/dashboard/account') }}" class="text-decoration-none text-center">
        <i class="fas fa-user-cog" style="font-size: 24px; color: gray;"></i>
        <p class="small m-0">Profil</p>
    </a>
</div>

@endsection
