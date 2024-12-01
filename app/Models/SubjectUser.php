<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SubjectUser extends Pivot
{
    // Optionally, define the table name (if it's different from the default 'subject_user')
    protected $table = 'subject_user';

    // If you want to allow mass assignment for any fields in the pivot table
    protected $fillable = ['user_id', 'subject_id'];

    // Add any additional methods or properties related to the pivot table here
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
