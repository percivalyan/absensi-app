@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Assignment Details</h1>

    <div class="card">
        <div class="card-header">
            <strong>User:</strong> {{ $subjectUser->user->name }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Assigned Subjects</h5>
            <ul>
                @foreach($subjectUser->user->subjects as $subject)
                    <li>{{ $subject->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
