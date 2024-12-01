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
            <div class="col-md-8 mx-auto">
                <div class="card shadow-lg border-0 mb-4">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Absensi Hari Ini</h5>
                        <form action="{{ route('presensi.index') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control me-2" placeholder="Cari Absensi..." 
                                   value="{{ $search ?? '' }}">
                            <button class="btn btn-light" type="submit">Cari</button>
                        </form>
                    </div>
                    <div class="card-body">
                        @if ($attendances->isEmpty())
                            <p class="text-muted text-center">Tidak ada data absensi yang ditemukan.</p>
                        @else
                            <div class="list-group">
                                @foreach ($attendances as $attendance)
                                    <a href="{{ route('home.show', $attendance->id) }}"
                                        class="list-group-item d-flex justify-content-between align-items-center py-3 border-0 rounded-3 mb-3 shadow-sm notification-item">
                                        <div class="ms-2 me-auto">
                                            <h6 class="fw-bold text-dark mb-1">
                                                {{ $attendance->title }}
                                                @if ($attendance->created_at->greaterThanOrEqualTo(now()->subHours(12)))
                                                    <span class="badge bg-success ms-2">NEW</span>
                                                @endif
                                            </h6>
                                            <p class="text-muted mb-0">{{ Str::limit($attendance->description, 100) }}</p>
                                        </div>
                                        @include('partials.attendance-badges')
                                    </a>
                                @endforeach
                            </div>
                            <!-- Navigasi Paginasi -->
                            <div class="mt-4 text-center">
                                <div style="display: inline-block; list-style: none; padding: 0; margin: 0;">
                                    @foreach ($attendances->links()->elements[0] as $page => $url)
                                        <a 
                                            href="{{ $url }}" 
                                            style="text-decoration: none; padding: 8px 12px; margin: 0 4px; border: 1px solid #007bff; border-radius: 4px; background-color: {{ $page == $attendances->currentPage() ? '#007bff' : 'transparent' }}; color: {{ $page == $attendances->currentPage() ? '#fff' : '#007bff' }};">
                                            {{ $page }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </ul>
    </div>
</div>

<!-- Bottom Navigation -->
<div class="fixed-bottom bg-light d-flex justify-content-around border-top py-2">
    <a href="{{ url('/') }}" class="text-decoration-none text-center">
        <i class="fas fa-home" style="font-size: 24px; color: grey;"></i>
        <p class="small m-0">Beranda</p>
    </a>
    <a href="{{ url('/home/notification') }}" class="text-decoration-none text-center">
        <i class="fas fa-bell" style="font-size: 24px; color: blue;"></i>
        <p class="small m-0">Notifikasi</p>
    </a>
    <a href="{{ url('/home/account') }}" class="text-decoration-none text-center">
        <i class="fas fa-user-cog" style="font-size: 24px; color: gray;"></i>
        <p class="small m-0">Profil</p>
    </a>
</div>

@endsection

<style>
    .notification-item {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .notification-item:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
</style>
