<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    use HasFactory;
    protected $fillable = [
        'expert_name',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
