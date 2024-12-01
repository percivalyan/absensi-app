<?php

namespace App\Http\Livewire;

use App\Models\Position;
use Livewire\Component;
use Carbon\Carbon;

class AttendanceAbstract extends Component
{
    public $attendance;
    public $positions;
    public $position_ids = [];

    protected $rules = [
        'attendance.title' => 'required|string|min:6',
        'attendance.description' => 'required|string|max:500', // Isi atau Kosongkan saja
        'attendance.start_time' => 'required|date_format:H:i', // Isi otomatis 07:00
        'attendance.batas_start_time' => 'required|date_format:H:i|after:start_time', // Isi otomatis 08:00
        'attendance.end_time' => 'required|date_format:H:i', // Isi otomatis 14:00
        'attendance.batas_end_time' => 'required|date_format:H:i|after:end_time', // Isi otomatis 20:00
        'attendance.code' => 'sometimes|nullable|boolean',
        'position_ids' => 'required|array',
        "position_ids.*"  => "required|distinct|numeric",
    ];

    public function mount()
    {
        // Set the positions
        $this->positions = Position::query()->select(['id', 'name'])->get();

        // Set the title to today's date in the required format
        $this->attendance['title'] = 'Absensi Hari ' . Carbon::today()->locale('id')->translatedFormat('l, d F Y');

        // Set default times
        $this->attendance['start_time'] = '07:00'; // Default start time
        $this->attendance['batas_start_time'] = '08:00'; // Default batas start time
        $this->attendance['end_time'] = '14:00'; // Default end time
        $this->attendance['batas_end_time'] = '20:00'; // Default batas end time

        // Set the default description
        $this->attendance['description'] = 'Isi atau abaikan saja, bersifat opsional.'; // Default description
    }
}
