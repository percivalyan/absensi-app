<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional, as Laravel will assume it's 'subjects')
    protected $table = 'subjects';

    // Specify the attributes that are mass assignable
    protected $fillable = ['code', 'name', 'description'];

    // If you need to define relationships, you can add methods here

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
