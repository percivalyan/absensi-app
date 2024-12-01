@extends('layouts.app')

@section('content')
<div class="container py-5" id="mainContent">
    <h1 class="mb-4">Data Guru</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Users and Their Subjects</h4>
        <a href="{{ route('subject_user.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Assign User to Subject
        </a>
    </div>

    <div class="row">
        @foreach($subjectUsers->unique('user.id') as $subjectUser)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <!-- User Initials Avatar -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar rounded-circle bg-primary text-white d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px; font-size: 1.25rem;">
                                {{ strtoupper(substr($subjectUser->user->name, 0, 1)) }}
                            </div>
                            <h5 class="card-title m-0">{{ $subjectUser->user->name }}</h5>
                        </div>
                        <!-- Subjects -->
                        <p class="mb-3">
                            <strong>Subjects:</strong>
                            @foreach($subjectUser->user->subjects as $subject)
                                <span class="badge bg-secondary">{{ $subject->name }}</span>
                            @endforeach
                        </p>
                        <!-- Actions -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('subject_user.edit', $subjectUser->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('subject_user.destroy', $subjectUser->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to remove this assignment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Remove
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
