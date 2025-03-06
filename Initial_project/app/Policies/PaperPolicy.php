<?php

namespace App\Policies;

use App\Models\User;
use App\Models\paper;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaperPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\paper  $paper
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, paper $paper)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\paper  $paper
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, paper $paper)
    {
        // if($user->hasRole('staff')){
        //     return true;
        // }
        // if($user->hasRole('admin')){
        //     return true;
        // }
        $paper=Paper::find($paper->id)->teacher()->where('user_id',$user->id)->first();
        if($paper){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\paper  $paper
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, paper $paper)
    {
        // if($user->hasRole('staff')){
        //     return true;
        // }
        // if($user->hasRole('admin')){
        //     return true;
        // }
        $paper=Paper::find($paper->id)->teacher()->where('user_id',$user->id)->first();
        if($paper){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\paper  $paper
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, paper $paper)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\paper  $paper
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, paper $paper)
    {
        //
    }
}
