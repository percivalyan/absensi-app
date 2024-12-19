<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_time',
        'batas_start_time',
        'end_time',
        'batas_end_time',
        'code'
    ];

    protected $appends = ['data'];

    /**
     * Accessor for the `data` attribute.
     */
    protected function data(): Attribute
    {
        return Attribute::make(
            get: function () {
                $now = now();

                // Ensure the time strings are valid before parsing
                $startTime = $this->parseTime($this->start_time);
                $batasStartTime = $this->parseTime($this->batas_start_time);
                $endTime = $this->parseTime($this->end_time);
                $batasEndTime = $this->parseTime($this->batas_end_time);

                $isHolidayToday = Holiday::query()
                    ->where('holiday_date', $now->toDateString())
                    ->exists();

                return (object) [
                    "start_time" => $this->start_time,
                    "batas_start_time" => $this->batas_start_time,
                    "end_time" => $this->end_time,
                    "batas_end_time" => $this->batas_end_time,
                    "now" => $now->format("H:i"),
                    "is_start" => $startTime && $batasStartTime && $startTime <= $now && $batasStartTime >= $now,
                    "is_end" => $endTime && $batasEndTime && $endTime <= $now && $batasEndTime >= $now,
                    'is_using_qrcode' => !empty($this->code),
                    'is_holiday_today' => $isHolidayToday
                ];
            }
        );
    }

    /**
     * Helper function to safely parse time strings.
     *
     * @param string|null $timeString
     * @return Carbon|null
     */
    private function parseTime(?string $timeString): ?Carbon
    {
        try {
            if ($timeString && !str_contains($timeString, ':')) {
                $timeString .= ':00'; // Tambahkan menit default jika tidak ada
            }
            return $timeString ? Carbon::createFromFormat('H:i', $timeString) : null;
        } catch (\Exception $e) {
            return null; // Return null if parsing fails
        }
    }

    public function scopeForCurrentUser($query, $userPositionId)
    {
        $query->whereHas('positions', function ($query) use ($userPositionId) {
            $query->where('position_id', $userPositionId);
        });
    }

    public function positions()
    {
        return $this->belongsToMany(Position::class);
    }

    public function presences()
    {
        return $this->hasMany(Presence::class);
    }
}
