<?php

namespace App\Policies;

use App\Models\ResearchProject;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResearchProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ResearchProject  $researchProject
     * @return mixed
     */
    public function view(User $user, ResearchProject $researchProject)
    {
        
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ResearchProject  $researchProject
     * @return mixed
     */
    public function update(User $user, ResearchProject $researchProject)
    {
        if($user->hasRole('staff')){
            return true;
        }
        if($user->hasRole('admin')){
            return true;
        }
        // if($user->hasRole('headproject')){
        //     return true;
        // }
        $researchProject=ResearchProject::find($researchProject->id)->user()->where('user_id',$user->id)->get();
        
        foreach ($researchProject as $res) {
            //print($res);
            if($user->id == $res->id and $res->pivot->role == '1' ){
                return true;
            }
            else{
                return false;
            }
        }
        
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ResearchProject  $researchProject
     * @return mixed
     */
    public function delete(User $user, ResearchProject $researchProject)
    {
        if($user->hasRole('staff')){
            return true;
        }
        if($user->hasRole('admin')){
            return true;
        }
        // if($user->hasRole('headproject')){
        //     return true;
        // }
        //$researchProject=ResearchProject::find($researchProject->id)->user()->where('user_id',$user->id)->get();
        $researchProject=ResearchProject::find($researchProject->id);
        //$researchProject = User::with(['researchProject'])->where('id',$user->id)->get();
        //dd($researchProject->user);
        //return false;
        foreach ($researchProject->user as $res) {
            //print($res);
            if($user->id == $res->id and $res->pivot->role == '1' ){
                return true;
            }
            else{
                return false;
            }
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ResearchProject  $researchProject
     * @return mixed
     */
    public function restore(User $user, ResearchProject $researchProject)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ResearchProject  $researchProject
     * @return mixed
     */
    public function forceDelete(User $user, ResearchProject $researchProject)
    {
        //
    }
}
