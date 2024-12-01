<?php

namespace App\Http\Controllers;

use App\Models\SubjectUser;
use App\Models\Attendance;
use Illuminate\Http\Request;

class ManajemenController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Mendapatkan data attendance dengan pencarian
        $attendances = Attendance::query()
            ->forCurrentUser(auth()->user()->position_id)
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderByDesc('created_at')
            ->paginate(2); // Set paginasi 2 item per halaman

        // Mendapatkan data SubjectUser berdasarkan user_id (atau ID lain yang diperlukan)
        // Pastikan subjectUser tidak null
        $subjectUser = SubjectUser::with(['user', 'subject'])->where('id', 1)->first();

        // If subjectUser is null, provide a fallback or default value
        $subjectUser = $subjectUser ?: (object)[
            'user' => (object)[],
            'subject' => (object)[]
        ];

        return view('manajemen.index', [
            "attendances" => $attendances,
            "search" => $search,
            "subjectUser" => $subjectUser, // Mengirim data SubjectUser ke view
        ]);
    }
}
