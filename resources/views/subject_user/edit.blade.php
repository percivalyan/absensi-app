@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User Assignment</h1>

    <form action="{{ route('subject_user.update', $subjectUser->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $subjectUser->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="subject_id">Subjects</label>
            <select name="subject_id[]" id="subject_id" class="form-control" multiple>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" 
                            {{ in_array($subject->id, $subjectUser->user->subjects->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update Assignment</button>
    </form>
</div>
@endsection
