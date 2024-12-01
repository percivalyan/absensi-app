@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card mb-4 shadow-lg" style="border-radius: 20px; overflow: hidden;">
            <div class="card-header text-center" style="background-color: #4A90E2; color: #fff; font-weight: bold;">
                <h4 class="mb-0">QR Code untuk Kehadiran</h4>
            </div>
            <div class="card-body text-center p-4" style="background-color: #f9f9f9;">
                <img src="{{ $qrcode }}" alt="QR Code" id="qrcode" class="img-fluid"
                     style="border: 5px solid #4A90E2; border-radius: 15px; padding: 10px;">
                <p class="mt-3 text-muted">Pindai QR Code ini untuk konfirmasi kehadiran.</p>
            </div>
        </div>
        
        <div class="text-center mb-3">
            <a href="{{ route('presences.qrcode.download-pdf', ['code' => $code]) }}" 
               class="btn btn-primary btn-lg" 
               style="border-radius: 30px; background-image: linear-gradient(135deg, #4A90E2, #0056b3);">
                Download PDF
            </a>
        </div>
        
        <div class="text-center">
            <small class="text-muted">
                Untuk mendownload QR Code dalam format SVG (agar bisa diedit), klik kanan pada gambar, lalu pilih "Download".
            </small>
        </div>
    </div>
</div>
@endsection
