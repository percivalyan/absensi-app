@extends('layouts.app')

@push('style')
    @powerGridStyles
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            color: #333;
        }
        .container-fluid {
            padding-top: 20px;
        }
        h1 {
            color: #333;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        .card-header {
            background-color: #f8f9fa;
            color: #333;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
            border-radius: 8px 8px 0 0;
        }
        .card-body {
            padding: 20px;
            color: #555;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .modal-content {
            background-color: #fff;
            border-radius: 10px;
            border: 1px solid #ddd;
        }
        .modal-header, .modal-footer {
            background-color: #f8f9fa;
            color: #333;
            border: none;
        }
        .input-group input {
            border-radius: 8px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            color: #333;
        }
        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
@endpush

@section('buttons')
    <div class="mb-4 text-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSubjectModal">
            <i class="fas fa-plus-circle me-2"></i> Buat Mapel Baru
        </button>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <h1>Mata Pelajaran</h1>

        @if (session('success'))
            <div class="alert alert-success mb-3">{{ session('success') }}</div>
        @endif

        <!-- Search Form -->
        <form action="{{ route('subjects.index') }}" method="GET" class="mb-4 row">
            <div class="col-md-8 col-12 mb-3 mb-md-0">
                <div class="input-group">
                    <input type="text" name="search" value="{{ old('search', $search) }}" class="form-control" placeholder="Ketik Mapel yang ingin dicari..." />
                </div>
            </div>
            <div class="col-md-4 col-12">
                <button type="submit" class="btn btn-primary w-100">Cari Mapel</button>
            </div>
        </form>
        
        <!-- Card Layout for Subjects -->
        <div class="row">
            @foreach ($subjects as $subject)
                <div class="col-md-4 col-sm-6">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="card-title">{{ $subject->name }}</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Code:</strong> {{ $subject->code }}</p>
                            <p><strong>Description:</strong> {{ $subject->description }}</p>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSubjectModal{{ $subject->id }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this subject?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item {{ $subjects->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $subjects->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @foreach ($subjects->getUrlRange(1, $subjects->lastPage()) as $page => $url)
                        <li class="page-item {{ $subjects->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    <li class="page-item {{ $subjects->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $subjects->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection

<!-- Create Subject Modal -->
<div class="modal fade" id="createSubjectModal" tabindex="-1" aria-labelledby="createSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createSubjectModalLabel">Create New Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('subjects.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="code" class="form-label">Subject Code</label>
                        <input type="text" class="form-control" id="code" name="code" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Subject Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Subject Modal -->
@foreach ($subjects as $subject)
<div class="modal fade" id="editSubjectModal{{ $subject->id }}" tabindex="-1" aria-labelledby="editSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubjectModalLabel">Edit Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="code" class="form-label">Subject Code</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $subject->code) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Subject Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $subject->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description', $subject->description) }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endpush
