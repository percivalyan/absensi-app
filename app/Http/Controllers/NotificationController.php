<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Holiday;
use App\Models\Permission;
use App\Models\Presence;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $attendances = Attendance::query()
        ->forCurrentUser(auth()->user()->position_id)
        ->when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })
        ->orderByDesc('created_at')
        ->paginate(2); // Set paginasi 8 item per halaman

    return view('notification.index', [
        "attendances" => $attendances,
        "search" => $search
    ]);
}

    
}