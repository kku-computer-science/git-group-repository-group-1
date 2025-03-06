<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_name_th','department_name_en',
    ];


    public function users()
    {
        return $this->hasMany(User::class);
        
    }
}
