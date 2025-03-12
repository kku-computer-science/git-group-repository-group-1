<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;
    protected $fillable = [
        'fund_name',
        'fund_year',
        'fund_details',
        'fund_type',
        'fund_level',
        'support_resource',
        'fund_agency'
    ];

    public function researchProject()
    {
        //return $this->belongs(ResearchProject::class,'fund_of_research');
        return $this->hasMany(ResearchProject::class);
        // OR return $this->belongsTo('App\User');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
