@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Assign User to Subject</h1>

    <form action="{{ route('subject_user.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Select User</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">-- Select User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="subject_id" class="form-label">Select Subjects</label>
            <select name="subject_id[]" id="subject_id" class="form-control" multiple required>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ in_array($subject->id, old('subject_id', [])) ? 'selected' : '' }}>{{ $subject->name }}</option>
                @endforeach
            </select>
            @error('subject_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Assign</button>
    </form>
</div>
@endsection
