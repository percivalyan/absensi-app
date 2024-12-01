<?php

namespace App\Http\Controllers;

use App\Models\SubjectUser;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectUserController extends Controller
{
    // Display a listing of the assigned users to subjects
    public function index()
    {
        $subjectUsers = SubjectUser::with(['user', 'subject'])->get();
        return view('subject_user.index', compact('subjectUsers'));
    }

    public function index2(Request $request)
    {
        // Get the search query from the request
        $search = $request->get('search');
    
        // Query the SubjectUser model and filter by user name or subject name, then paginate with 10 results per page
        $subjectUsers = SubjectUser::with(['user', 'subject'])
            ->when($search, function ($query) use ($search) {
                return $query->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                })
                ->orWhereHas('subject', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                });
            })
            ->paginate(10);  // Paginate with 10 records per page
    
        return view('subject_user.index2', compact('subjectUsers'));
    }
    
    // Show the form for creating a new assignment
    public function create()
    {
        $users = User::all();
        $subjects = Subject::all();

        return view('subject_user.create', compact('users', 'subjects'));
    }

    // Store a newly assigned user to a subject
    public function store(Request $request)
    {
        // Validate the incoming request to ensure only a single user is assigned
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',  // Ensures only one user ID
            'subject_id' => 'required|array',
            'subject_id.*' => 'exists:subjects,id',
        ]);

        // Get the user to assign
        $user = User::findOrFail($validated['user_id']);

        // Loop through subjects and sync with the user (ensuring only one user)
        foreach ($validated['subject_id'] as $subjectId) {
            $subject = Subject::findOrFail($subjectId);
            $user->subjects()->syncWithoutDetaching([$subjectId]); // Syncing the user with the subject
        }

        return redirect()->route('subject_user.index')->with('success', 'User assigned to subjects!');
    }

    // Show the form for editing an existing assignment
    public function edit($id)
    {
        $subjectUser = SubjectUser::findOrFail($id);
        $users = User::all();
        $subjects = Subject::all();

        return view('subject_user.edit', compact('subjectUser', 'users', 'subjects'));
    }

    // Update the specified assignment in storage
    public function update(Request $request, $id)
    {
        // Validate the incoming request to ensure only a single user is assigned
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',  // Ensures only one user ID
            'subject_id' => 'required|array',
            'subject_id.*' => 'exists:subjects,id',
        ]);

        $subjectUser = SubjectUser::findOrFail($id);

        // Get the user to assign
        $user = User::findOrFail($validated['user_id']);

        // Sync the updated user with the selected subjects
        foreach ($validated['subject_id'] as $subjectId) {
            $subject = Subject::findOrFail($subjectId);
            $user->subjects()->syncWithoutDetaching([$subjectId]); // Syncing the user with the subject
        }

        return redirect()->route('subject_user.index')->with('success', 'Assignment updated!');
    }

    // Remove the specified assignment from storage
    public function destroy($id)
    {
        $subjectUser = SubjectUser::findOrFail($id);

        // Detach the user from the subject
        $subjectUser->user->subjects()->detach($subjectUser->subject_id);

        return redirect()->route('subject_user.index')->with('success', 'Assignment removed!');
    }

    // For selecting users and subjects (optional)
    public function show($id)
    {
        $subjectUser = SubjectUser::findOrFail($id);
        return view('subject_user.show', compact('subjectUser'));
    }
}
