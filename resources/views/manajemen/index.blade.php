{{-- resources/views/manajemen/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manajemen Dashboard</h1>

    {{-- Search form --}}
    <form method="GET" action="{{ route('manajemen.index') }}">
        <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    {{-- Display Attendance Data --}}
    <h3>Attendance</h3>
    @foreach ($attendances as $attendance)
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $attendance->title }}</h5>
                <p class="card-text">{{ $attendance->description }}</p>
                <small class="text-muted">Created at: {{ $attendance->created_at->format('Y-m-d H:i') }}</small>
            </div>
        </div>
    @endforeach

    {{-- Pagination for Attendance --}}
    <div class="pagination">
        {{ $attendances->links() }}
    </div>

    {{-- Display SubjectUser Data --}}
    <h3>Assigned Subject and User</h3>
    @if ($subjectUser && $subjectUser->user && $subjectUser->subject)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $subjectUser->user->name ?? 'No User Assigned' }}</h5>
                <p class="card-text">Assigned to Subject: {{ $subjectUser->subject->name ?? 'No Subject Assigned' }}</p>
            </div>
        </div>
    @else
        <p>No subject-user assignment found.</p>
    @endif
</div>
@endsection
