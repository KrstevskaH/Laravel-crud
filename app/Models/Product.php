<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = ['name', 'detail', 'dob','email','phone','status','image','university_id'];
    use HasFactory;

    public function university(): BelongsTo
    {
        return $this->belongsTo(Universities::class, 'university_id', 'id');
    }
}
