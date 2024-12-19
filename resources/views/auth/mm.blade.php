@extends('layouts.auth')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Loading overlay styles */
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            text-align: center;
        }

        /* Icon and text styles */
        #loading-overlay .user-icon {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }

        #loading-overlay .loading-text {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        /* Spinner styles */
        .spinner {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush

@section('content')
    <!-- Loading Overlay -->
    <div id="loading-overlay">
        <div class="user-icon">
            <!-- Custom SVG Icon -->
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="200" height="200"
                style="transform: translate(-60px, -150px);">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M12 1.25C9.37665 1.25 7.25 3.37665 7.25 6C7.25 8.62335 9.37665 10.75 12 10.75C14.6234 10.75 16.75 8.62335 16.75 6C16.75 3.37665 14.6234 1.25 12 1.25ZM8.75 6C8.75 4.20507 10.2051 2.75 12 2.75C13.7949 2.75 15.25 4.20507 15.25 6C15.25 7.79493 13.7949 9.25 12 9.25C10.2051 9.25 8.75 7.79493 8.75 6Z"
                    fill="#1C274C"></path>
                <path
                    d="M18.8555 16.5729C19.1527 16.8614 19.1599 17.3362 18.8714 17.6334L17.0382 19.5223C16.8901 19.6749 16.6842 19.7575 16.4717 19.7495C16.2591 19.7414 16.06 19.6436 15.9239 19.4802L15.0904 18.4802C14.8252 18.162 14.8681 17.6891 15.1863 17.4239C15.5045 17.1587 15.9774 17.2016 16.2426 17.5198L16.5424 17.8794L17.795 16.5888C18.0834 16.2915 18.5583 16.2844 18.8555 16.5729Z"
                    fill="#1C274C"></path>
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M13.9107 21.6083C13.2991 21.7009 12.6587 21.75 12 21.75C9.96067 21.75 8.07752 21.2792 6.67815 20.4796C5.3 19.6921 4.25 18.4899 4.25 17C4.25 15.5101 5.3 14.3079 6.67815 13.5204C8.07752 12.7208 9.96067 12.25 12 12.25C13.8045 12.25 15.4825 12.6184 16.8117 13.2537C16.8742 13.2512 16.937 13.25 17 13.25C19.6234 13.25 21.75 15.3766 21.75 18C21.75 20.6234 19.6234 22.75 17 22.75C15.8204 22.75 14.7413 22.32 13.9107 21.6083ZM13.75 18C13.75 16.2051 15.2051 14.75 17 14.75C18.7949 14.75 20.25 16.2051 20.25 18C20.25 19.7949 18.7949 21.25 17 21.25C15.2051 21.25 13.75 19.7949 13.75 18ZM14.4176 14.0127C13.113 14.8593 12.25 16.3289 12.25 18C12.25 18.8029 12.4492 19.5593 12.8009 20.2224C12.5388 20.2406 12.2715 20.25 12 20.25C10.1733 20.25 8.55649 19.8253 7.42236 19.1772C6.26701 18.517 5.75 17.7193 5.75 17C5.75 16.2807 6.26701 15.483 7.42236 14.8228C8.55649 14.1747 10.1733 13.75 12 13.75C12.8611 13.75 13.6767 13.8444 14.4176 14.0127Z"
                    fill="#1C274C"></path>
            </svg>
        </div>
        <div class="loading-text">
            <h1 class="text-center fw-bold mb-0 text-black">
                <span>E - Absensi</span>
            </h1>
        </div>
        <div class="spinner"></div>
    </div>

    <div class="w-100" id="login-container" style="display: none;">
        <style>
            #landings .navbar {
                background-color: white;
                /* background-color: #1C274C; */
                /* Main navbar background color */
                padding: 5px 10px;
                /* Increased padding for better spacing */
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 10px;
                /* Rounded corners for the navbar */
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                /* Subtle shadow for a sleek look */

            }

            #logins .navbar {
                background-color: white;
                /* background-color: #1C274C; */
                /* Main navbar background color */
                padding: 5px 10px;
                /* Increased padding for better spacing */
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 10px;
                /* Rounded corners for the navbar */
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                /* Subtle shadow for a sleek look */
                margin-top: -70px;
            }

            /* Navbar links styling */
            .navbar a {
                color: white;
                font-size: 18px;
                font-weight: 600;
                padding: 12px 18px;
                text-decoration: none;
                transition: background-color 0.3s ease, transform 0.3s ease;
                border-radius: 5px;
                /* Rounded corners for individual links */
            }

            /* Navbar link hover effects */
            .navbar a:hover {
                background-color: white;
                /* Hover background color */
                transform: scale(1.05);
                /* Slight scale effect on hover */
            }

            /* Navbar brand (Home) */
            .navbar .navbar-brand {
                font-size: 24px;
                font-weight: bold;
                color: #1C274C;
            }

            /* Navbar links container (if you plan to add more links) */
            .navbar .navbar-links {
                display: flex;
                gap: 15px;
            }

            /* Optional: Add a separator between the brand and links */
            .navbar .navbar-links::before {
                content: '|';
                color: white;
                padding-right: 15px;
            }

            /* Initially show the landings section and hide the logins section */
            #landings {
                display: block;
                /* Show landings section by default */
            }

            #logins {
                display: none;
                /* Keep logins section hidden */
            }
        </style>

        {{-- <section id="visis">
            <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat recusandae sint iure odio fugiat
                aspernatur magni eos. Aliquam dolorum, ratione enim, quaerat facere delectus repellat harum dicta veritatis
                quisquam doloremque?</h1>
        </section> --}}

        <section id="landings">
            {{-- <nav class="navbar" style="margin-top: 1000px"> --}}
            <nav class="navbar" style="margin-top: 850px">
                <a href="{{ url('/') }}" class="navbar-brand" id="home-link">Home</a>
                {{-- <a href="#" class="navbar-brand" id="visi-link">Visi & Misi</a> --}}
                <a href="#" class="navbar-brand" id="login-link">Login</a>
            </nav>

            <div style="margin-top: 40px"></div>
            <!-- Hero Section -->
            <section>
                <div class="hero-section d-flex align-items-center"
                    style="background-color: #f8f9fa; height: 100vh; position: relative;">
                    <div class="container-fluid d-flex flex-column flex-lg-row justify-content-between align-items-center">
                        <div class="text-container" style="flex: 1; padding: 20px;">
                            <br>
                            <h2 class="display-4 font-weight-bold mb-4"
                                style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); color: #6c757d;">
                                Sistem Absensi Guru SMP Islam Nurush Shodiqin
                            </h2>
                            <p class="lead text-dark" style="text-align: justify;">
                                SMP Islam Nurush Shodiqin, didirikan pada tahun 2000 di Kabupaten Bogor, adalah institusi
                                pendidikan yang mengedepankan integrasi antara ilmu pengetahuan umum dan nilai-nilai
                                keislaman. Kami berkomitmen untuk menciptakan generasi unggul dalam akademis dan berakhlak
                                mulia, memberikan pendidikan yang tidak hanya mengedukasi tetapi juga membentuk karakter
                                siswa.
                            </p>
                            <br>
                            <!-- Tombol untuk membuka modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visiMisiModal">
                                Visi dan Misi
                            </button>
                        </div>
                        <div class="image-container"
                            style="flex: 1; display: flex; justify-content: center; padding: 20px;">
                            <img src="{{ asset('img/hero_yns.jpg') }}" alt="Hero Image" class="img-fluid rounded"
                                style="max-width: 100%; height: auto;">
                        </div>
                    </div>
                </div>
            </section>

            <div class="modal fade" id="visiMisiModal" tabindex="-1" role="dialog" aria-labelledby="visiMisiModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #007bff; color: #fff; text-align: center;">
                            <h5 class="modal-title" id="visiMisiModalLabel">Visi dan Misi Sekolah</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                style="color: #fff;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="font-family: 'Arial', sans-serif; padding: 40px;">
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="text-primary">Visi</h4>
                                    <p style="font-size: 18px; line-height: 1.6;">
                                        Menjadi lembaga pendidikan Islam yang terkemuka, berkomitmen untuk mencetak generasi
                                        Muslim yang cerdas, berakhlak mulia, dan siap berkontribusi positif bagi masyarakat.
                                    </p>
                                </div>
                                <div class="col-12">
                                    <h4 class="text-primary">Misi</h4>
                                    <ul style="font-size: 18px; line-height: 1.6; padding-left: 20px;">
                                        <li>Integrasi nilai-nilai keislaman dalam setiap aspek pendidikan.</li>
                                        <li>Menyediakan pendidikan yang seimbang antara ilmu agama dan ilmu pengetahuan
                                            umum.</li>
                                        <li>Menciptakan lingkungan yang mendukung pengembangan potensi akademik dan
                                            non-akademik siswa.</li>
                                        <li>Menumbuhkan sikap peduli sosial dan cinta lingkungan di kalangan siswa.</li>
                                        <li>Mendorong kolaborasi dan semangat kebersamaan dalam setiap kegiatan sekolah.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="border-top: none; justify-content: center;">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                style="font-size: 16px; padding: 10px 20px;">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tambahkan Bootstrap JS dan dependencies jika belum ada -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

            <!-- About Section -->
            <section id="about" class="about-section py-5"
                style="background: linear-gradient(to bottom, #f8f9fa, #e9ecef);">
                <div class="container text-center">
                    <!-- Vision and Mission Section -->
                    <div class="d-flex justify-content-center mt-5">
                        <!-- Vision Card -->
                        {{-- <div class="card m-2" style="width: 500px;">
                            <div class="card-body">
                                <h4 class="text-dark"><i class="fas fa-eye"></i> Visi</h4>
                                <p style="color: black;">Menjadi lembaga pendidikan Islam yang terkemuka, berkomitmen untuk
                                    mencetak generasi Muslim yang cerdas, berakhlak mulia, dan siap berkontribusi positif
                                    bagi
                                    masyarakat.</p>
                            </div>
                        </div> --}}
                        <!-- Mission Card -->
                        {{-- <div class="card m-2" style="width: 500px;">
                            <div class="card-body">
                                <h4 class="text-dark"><i class="fas fa-bullseye"></i> Misi</h4>
                                <p style="color: black;">SMP Islam Nurush Shodiqin berkomitmen untuk:</p>
                                <ol class="list-unstyled"
                                    style="padding-left: 0; color: black; text-align: left; margin-left: 10px;">
                                    <li><i class="fas fa-check-circle"></i> Integrasi nilai-nilai keislaman dalam setiap
                                        aspek
                                        pendidikan.</li>
                                    <li><i class="fas fa-check-circle"></i> Menyediakan pendidikan yang seimbang antara ilmu
                                        agama dan ilmu pengetahuan umum.</li>
                                    <li><i class="fas fa-check-circle"></i> Menciptakan lingkungan yang mendukung
                                        pengembangan
                                        potensi akademik dan non-akademik siswa.</li>
                                    <li><i class="fas fa-check-circle"></i> Menumbuhkan sikap peduli sosial dan cinta
                                        lingkungan
                                        di kalangan siswa.</li>
                                    <li><i class="fas fa-check-circle"></i> Mendorong kolaborasi dan semangat kebersamaan
                                        dalam
                                        setiap kegiatan sekolah.</li>
                                </ol>
                                <p style="color: black;">Dengan misi ini, kami berusaha agar setiap siswa tidak hanya
                                    berhasil
                                    secara akademis tetapi juga menjadi individu yang bermanfaat bagi masyarakat.</p>
                            </div>
                        </div> --}}
                    </div>

                    <!-- Map Section -->
                    <!--<div id="map" style="height: 400px; margin: 20px;"></div>-->
                    <!--<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />-->
                    <!--<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>-->

                    <!--<script>
                        -- >
                        <
                        !--
                        var map = L.map('map').setView([-6.4070, 106.8547], 15);
                        -- >
                        <
                        !--L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            -- >
                            <
                            !--maxZoom: 19,
                            -- >
                            <
                            !--attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'--
                                >
                                <
                                !--
                        }).addTo(map);
                        -- >
                        <
                        !--L.marker([-6.4070, 106.8547]).addTo(map) -- >
                            <
                            !--.bindPopup(-- >
                                <
                                !--
                                '<b>SMP Islam Nurush Shodiqin</b><br>Jl Masjid Jami Al Barkah Kp. Rawa RT/RW 02/08, Rawa Panjang, Kecamatan Bojonggede, Kabupaten Bogor, Jawa Barat 16920'--
                                >
                                <
                                !--) -- >
                            <
                            !--.openPopup();
                        -- >
                        <
                        !--
                    </script>-->

                    <!-- Footer Section -->
                    <footer class="footer bg-light text-dark py-4">
                        <div class="container text-center">
                            <p class="mb-1">
                                Jl. Masjid Jami Al Barkah Kp. Rawa RT/RW 02/08, Rawa Panjang, Kecamatan Bojonggede,
                                Kabupaten Bogor, Jawa Barat 16920
                            </p>
                            <div class="social-links mt-3">
                                <a href="#" class="text-dark mx-2" title="Facebook" aria-label="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="text-dark mx-2" title="Tiktok" aria-label="Tiktok">
                                    <i class="fab fa-tiktok"></i>
                                </a>
                                <a href="#" class="text-dark mx-2" title="Instagram" aria-label="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                            <p class="mt-4 mb-0">© 2023 All rights reserved.</p>
                        </div>
                    </footer>
                </div>
            </section>



        </section>

        <!-- Add Bootstrap JS and dependencies if not already included -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <section id="logins">

            <nav class="navbar">
                <a href="{{ url('/') }}" class="navbar-brand" id="home-link">Home</a>
                <a href="#" class="navbar-brand" id="login-link">Login</a>
            </nav>
            <div class="py-5"></div>
            <main class="form-signin w-100 m-auto text-center">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="200"
                    height="200" class="mb-4" style="transform: translateX(60px);">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 1.25C9.37665 1.25 7.25 3.37665 7.25 6C7.25 8.62335 9.37665 10.75 12 10.75C14.6234 10.75 16.75 8.62335 16.75 6C16.75 3.37665 14.6234 1.25 12 1.25ZM8.75 6C8.75 4.20507 10.2051 2.75 12 2.75C13.7949 2.75 15.25 4.20507 15.25 6C15.25 7.79493 13.7949 9.25 12 9.25C10.2051 9.25 8.75 7.79493 8.75 6Z"
                        fill="#1C274C"></path>
                    <path
                        d="M18.8555 16.5729C19.1527 16.8614 19.1599 17.3362 18.8714 17.6334L17.0382 19.5223C16.8901 19.6749 16.6842 19.7575 16.4717 19.7495C16.2591 19.7414 16.06 19.6436 15.9239 19.4802L15.0904 18.4802C14.8252 18.162 14.8681 17.6891 15.1863 17.4239C15.5045 17.1587 15.9774 17.2016 16.2426 17.5198L16.5424 17.8794L17.795 16.5888C18.0834 16.2915 18.5583 16.2844 18.8555 16.5729Z"
                        fill="#1C274C"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M13.9107 21.6083C13.2991 21.7009 12.6587 21.75 12 21.75C9.96067 21.75 8.07752 21.2792 6.67815 20.4796C5.3 19.6921 4.25 18.4899 4.25 17C4.25 15.5101 5.3 14.3079 6.67815 13.5204C8.07752 12.7208 9.96067 12.25 12 12.25C13.8045 12.25 15.4825 12.6184 16.8117 13.2537C16.8742 13.2512 16.937 13.25 17 13.25C19.6234 13.25 21.75 15.3766 21.75 18C21.75 20.6234 19.6234 22.75 17 22.75C15.8204 22.75 14.7413 22.32 13.9107 21.6083ZM13.75 18C13.75 16.2051 15.2051 14.75 17 14.75C18.7949 14.75 20.25 16.2051 20.25 18C20.25 19.7949 18.7949 21.25 17 21.25C15.2051 21.25 13.75 19.7949 13.75 18ZM14.4176 14.0127C13.113 14.8593 12.25 16.3289 12.25 18C12.25 18.8029 12.4492 19.5593 12.8009 20.2224C12.5388 20.2406 12.2715 20.25 12 20.25C10.1733 20.25 8.55649 19.8253 7.42236 19.1772C6.26701 18.517 5.75 17.7193 5.75 17C5.75 16.2807 6.26701 15.483 7.42236 14.8228C8.55649 14.1747 10.1733 13.75 12 13.75C12.8611 13.75 13.6767 13.8444 14.4176 14.0127Z"
                        fill="#1C274C"></path>
                </svg>
                <form method="POST" action="{{ route('auth.login') }}" id="login-form">
                    <div class="loading-text py-2">
                        <h1 class="text-center fw-bold mb-0 text-black py-2">
                            <span>E - Absensi</span>
                        </h1>
                    </div>

                    <div class="form-floating mb-3 position-relative">
                        <i class="fa fa-envelope position-absolute top-50 start-0 translate-middle-y ms-3 mt-2"></i>
                        <input type="email" class="form-control ps-5" id="floatingInputEmail" name="email"
                            placeholder="name@example.com" required aria-label="Email address">
                    </div>

                    <div class="form-floating mb-3 position-relative">
                        <i class="fa fa-lock position-absolute top-50 start-0 translate-middle-y ms-3 mt-1"></i>
                        <input type="password" class="form-control ps-5" id="floatingPassword" name="password"
                            placeholder="Password" required aria-label="Password">
                    </div>


                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="flexCheckRemember">
                        <label class="form-check-label" for="flexCheckRemember">
                            Ingatkan Saya di Perangkat ini
                        </label>
                    </div>

                    <button class="w-100 btn btn-primary" type="submit" id="login-form-button">Masuk</button>
                    <p class="mt-5 mb-3 text-muted">&copy; All rights reserved 2024</p>
                </form>
            </main>
        </section>

    </div>
@endsection

@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(() => {
                document.getElementById('loading-overlay').style.display = 'none';
                document.getElementById('login-container').style.display = 'block';
            }, 3000); // 3-second delay
        });

        document.getElementById('login-link').addEventListener('click', function() {
            // Hide the landings section
            document.getElementById('landings').style.display = 'none';

            // Show the logins section
            document.getElementById('logins').style.display = 'block';
        });

        document.getElementById('home-link').addEventListener('click', function() {
            // Hide the logins section
            document.getElementById('logins').style.display = 'none';

            // Show the landings section
            document.getElementById('landings').style.display = 'block';
        });
    </script>
    <script type="module" src="{{ asset('js/auth/login.js') }}"></script>

    <!-- Add Bootstrap JS and dependencies if not already included -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endpush
