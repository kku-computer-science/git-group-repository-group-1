<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'fname_en',
        'lname_en',
        'fname_th',
        'lname_th',
        'doctoral_degree',
        'academic_ranks_en',
        'academic_ranks_th',
        'position_en',
        'position_th',
        'title_name_th',
        'title_name_en',     
        'role',
        'picture',
        'status',
        'program_id',
        'username'
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        
        
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getPictureAttribute($value){
        if($value){
            return asset('images/imag_user/'.$value);
        }else{
            return asset('images/imag_user/no-image.png');
        }
    }
    public function researchProject()
    {
        return $this->belongsToMany(ResearchProject::class,'work_of_research_projects')->withPivot('role');
        // OR return $this->belongsTo('App\User');
    }
    public function researchGroup()
    {
        return $this->belongsToMany(ResearchGroup::class,'work_of_research_groups')->withPivot('role');
        // OR return $this->belongsTo('App\User');
    }

    public function paper()
    {
        return $this->belongsToMany(Paper::class,'user_papers')->withPivot('author_type');
        
    }

    public function academicworks()
    {
        return $this->belongsToMany(Academicwork::class,'user_of_academicworks')->withPivot('author_type');
        
    }

    public function program() {
        return $this->belongsTo(Program::class);
    }

    public function department() {
        return $this->belongsTo(department::class);
    }

    public function expertise()
    {
        return $this->hasMany(Expertise::class);
    }

    public function education()
    {
        return $this->hasMany(Education::class);
    }
    public function fund()
    {
        return $this->hasMany(Fund::class);
    }
}
