<section id="navbar_1">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm py-3">
        <div class="container">
            {{-- <button onclick="window.history.back();" class="btn btn-outline-primary btn-sm ms-3" style="margin-top: 10px;">
                <i class="fa fa-arrow-left"></i> Back
            </button>
     --}}
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
</section>
