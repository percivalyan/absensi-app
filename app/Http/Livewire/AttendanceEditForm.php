<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
use Illuminate\Support\Str;

class AttendanceEditForm extends AttendanceAbstract
{
    public $initialCode;

    public function mount()
    {
        parent::mount();

        // Format waktu agar hanya jam:menit
        $this->attendance['start_time'] = $this->formatTime($this->attendance['start_time']);
        $this->attendance['batas_start_time'] = $this->formatTime($this->attendance['batas_start_time']);
        $this->attendance['end_time'] = $this->formatTime($this->attendance['end_time']);
        $this->attendance['batas_end_time'] = $this->formatTime($this->attendance['batas_end_time']);

        $this->initialCode = $this->attendance['code'];
        $this->attendance['code'] = $this->initialCode ? true : false;

        $this->position_ids = $this->attendance->positions()->pluck('positions.id', 'positions.id')->toArray();
    }

    public function save()
    {
        // Pastikan semua waktu memiliki format H:i
        $this->attendance['start_time'] = $this->formatTime($this->attendance['start_time']);
        $this->attendance['batas_start_time'] = $this->formatTime($this->attendance['batas_start_time']);
        $this->attendance['end_time'] = $this->formatTime($this->attendance['end_time']);
        $this->attendance['batas_end_time'] = $this->formatTime($this->attendance['batas_end_time']);

        // Validasi
        $this->validate([
            'attendance.start_time' => 'required|date_format:H:i',
            'attendance.batas_start_time' => 'required|date_format:H:i',
            'attendance.end_time' => 'required|date_format:H:i',
            'attendance.batas_end_time' => 'required|date_format:H:i',
        ]);

        $this->position_ids = array_filter($this->position_ids, function ($id) {
            return is_numeric($id);
        });

        $position_ids = array_values($this->position_ids);

        $attendance = [];
        if (!$this->attendance->code) {
            $this->attendance->code = null;
            $attendance = $this->attendance->toArray();
        } else {
            $attendance = $this->attendance->toArray();
            if (!$this->initialCode) {
                $attendance['code'] = Str::random();
            } else {
                $attendance['code'] = $this->initialCode;
            }
        }

        $this->attendance->update($attendance);
        $this->attendance->positions()->sync($position_ids);

        redirect()->route('attendances.index')->with('success', "Data absensi berhasil diubah.");
    }

    private function formatTime($time)
    {
        // Tambahkan ":00" jika input hanya berisi jam
        if (!str_contains($time, ':')) {
            $time .= ':00';
        }
        return $time;
    }

    public function render()
    {
        return view('livewire.attendance-edit-form');
    }
}
