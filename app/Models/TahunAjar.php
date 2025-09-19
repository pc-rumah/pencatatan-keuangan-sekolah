<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TahunAjar extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function semester(): BelongsToMany
    {
        return $this->belongsToMany(Semester::class);
    }
}
