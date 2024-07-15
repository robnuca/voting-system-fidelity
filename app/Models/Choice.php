<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vote; // Import the Vote model

class Choice extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public $timestamps = true; // Ensure timestamps are enabled

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}