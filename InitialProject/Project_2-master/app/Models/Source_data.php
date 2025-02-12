<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source_data extends Model
{
    use HasFactory;
    protected $table = 'source_data';
    protected $fillable = [
        'source_name',
    ];
    public function paper()
    {
        return $this->belongsToMany(Paper::class,'source_papers');
    }
}
