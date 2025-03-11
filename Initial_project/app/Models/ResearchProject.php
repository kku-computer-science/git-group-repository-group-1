<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProject extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_name', 'project_start', 'project_end', 'responsible_department', 'budget', 'note','status','project_year'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class,'work_of_research_projects')->withPivot('role');
        // OR return $this->hasOne('App\Phone');
    }

    public function outsider()
    {
        return $this->belongsToMany(Outsider::class,'outsiders_work_of_project')->withPivot('role');
        // OR return $this->hasOne('App\Phone');
    }
    public function fund()
    {
        //return $this->belongsToMany(Fund::class,'fund_of_research');
        // OR return $this->belongsTo('App\User');
        return $this->belongsTo(Fund::class);
    }

}
