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
        <div class="row">
            @if ($attendances->isEmpty())
                <p class="text-muted text-center">Tidak ada data absensi yang ditemukan.</p>
            @else
                @foreach ($attendances as $attendance)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-lg border-0">
                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">{{ $attendance->title }}</h5>
                                @if ($attendance->created_at->greaterThanOrEqualTo(now()->subHours(12)))
                                    <span class="badge bg-success">NEW</span>
                                @endif
                            </div>
                            <div class="card-body">
                                {{-- <p class="text-muted mb-3">{{ Str::limit($attendance->description, 100) }}</p> --}}
                                <a href="{{ route('home.show', $attendance->id) }}" class="btn btn-outline-primary w-100">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- Navigasi Paginasi -->
                {{-- <div class="col-12 mt-4">
                    <div class="d-flex justify-content-center">
                        <div style="list-style: none; padding: 0; margin: 0;">
                            @foreach ($attendances->links()->elements[0] as $page => $url)
                                <a 
                                    href="{{ $url }}" 
                                    style="text-decoration: none; padding: 8px 12px; margin: 0 4px; border: 1px solid #007bff; border-radius: 4px; background-color: {{ $page == $attendances->currentPage() ? '#007bff' : 'transparent' }}; color: {{ $page == $attendances->currentPage() ? '#fff' : '#007bff' }};">
                                    {{ $page }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div> --}}
            @endif
        </div>
    </div>
</div>

<!-- Bottom Navigation -->
<div class="fixed-bottom bg-white d-flex justify-content-around border-top py-3">
    <a href="{{ url('/') }}" class="text-decoration-none text-center">
        <i class="fas fa-home" style="font-size: 28px; color: #6c757d;"></i>
        <p class="small m-0">Beranda</p>
    </a>
    <a href="{{ url('notification') }}" class="text-decoration-none text-center">
        <i class="fas fa-bell" style="font-size: 28px; color: #007bff;"></i>
        <p class="small m-0">Notifikasi</p>
    </a>
    <a href="{{ url('/home/account') }}" class="text-decoration-none text-center">
        <i class="fas fa-user-cog" style="font-size: 28px; color: #6c757d;"></i>
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
