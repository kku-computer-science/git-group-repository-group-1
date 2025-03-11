<?php

namespace App\Policies;

use App\Models\Fund;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FundPolicy
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
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Fund $fund)
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
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Fund $fund)
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
        $fund=Fund::where([['id',$fund->id],['user_id',$user->id]])->first();
        //dd($fund);
        if($fund){
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
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Fund $fund)
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
        $fund=Fund::where([['id',$fund->id],['user_id',$user->id]])->first();
        if($fund){
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
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Fund $fund)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Fund $fund)
    {
        //
    }
}
