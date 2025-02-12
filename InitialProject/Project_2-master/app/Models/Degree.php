<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;

    public function program()
    {
        return $this->hasMany(Program::class);
    }

    public function course()
    {
        return $this->hasMany(Course::class);
    }
}
