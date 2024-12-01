@extends('layouts.home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 rounded-lg">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4">{{ $title }}</h2>

                        <form method="POST" action="{{ route('home.employees.updatePassword') }}">
                            @csrf

                            <!-- Current Password -->
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Kata Sandi Saat Ini</label>
                                <input type="password" name="current_password" id="current_password" class="form-control"
                                    required>
                                @error('current_password')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Kata Sandi Baru</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                                @error('password')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm New Password -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" required>
                                @error('password_confirmation')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2">Ganti Kata Sandi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Add custom styles in your app.css or inline */
        .card {
            border-radius: 12px;
            /* Round the corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Softer shadow */
        }

        .card-body {
            background-color: #f9f9f9;
            /* Subtle background color */
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
@endsection
