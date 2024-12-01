<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        // Get search query and sort column and direction from request
        $search = $request->input('search');
        $sortColumn = $request->input('sortColumn', 'name'); // Default to sorting by name
        $sortDirection = $request->input('sortDirection', 'asc'); // Default sorting direction

        // Query to fetch subjects with search and sorting
        $subjects = Subject::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('code', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->orderBy($sortColumn, $sortDirection)
            ->paginate(10);

        return view('subjects.index', compact('subjects', 'search', 'sortColumn', 'sortDirection'));
    }

    // Controller Methods

    public function create()
    {
        return response()->json(['action' => 'create']);
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return response()->json(['action' => 'edit', 'subject' => $subject]);
    }


    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'code' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Create a new subject
        Subject::create($request->all());

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully');
    }

    public function update(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'code' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update($request->all());

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully');
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully');
    }
}
