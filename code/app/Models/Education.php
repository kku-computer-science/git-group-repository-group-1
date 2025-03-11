<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'uname','qua_name','level','year'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
