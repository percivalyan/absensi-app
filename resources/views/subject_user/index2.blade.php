@extends('layouts.home')

@section('content')
<div class="container">
    <h1 class="py-2">Assigned Users to Subjects</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search Form -->
    <form method="GET" action="{{ route('subject_user.index2') }}" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search by User or Subject" value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <a href="{{ route('subject_user.create') }}" class="btn btn-primary mb-3">Assign User to Subject</a>

    <div class="row">
        @foreach($subjectUsers->unique('user.id') as $subjectUser)
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ $subjectUser->user->name }}</h5>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">Assigned Subjects:</h6>
                    <div class="badge-list">
                        @foreach($subjectUser->user->subjects as $subject)
                            <span class="badge bg-secondary mb-2">{{ $subject->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        {{ $subjectUsers->links() }}
    </div>

    <button onclick="window.history.back();" class="btn btn-outline-primary btn-sm ms-3" style="margin-top: 10px;">
        <i class="fa fa-arrow-left"></i> Back
    </button>
</div>
@endsection
