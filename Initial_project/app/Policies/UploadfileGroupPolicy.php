<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\ResearchGroup;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UploadfileGroupPolicy
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user,$group_id)
    {
        $researchGroup=ResearchGroup::find($group_id)->user()->where('user_id',$user->id)->get();
        //$researchProject = User::with(['researchProject'])->where('id',$user->id)->get();
        if($user->hasRole('admin')){
            return true;
        }
        foreach ($researchGroup as $res) {
            //print($res);
            if($user->id == $res->id  ){
                return true;
            }
            else{
                return false;
            }
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Product $product)
    {
        //
    }

    public function upload(User $user, Product $product)
    {
        /*if($user->hasRole('admin')){
            return true;
        }else{
            return false;
        }*/
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Product $product ,$group_id)
    {
        $researchGroup=ResearchGroup::find($group_id)->user()->where('user_id',$user->id)->get();
        //$researchProject = User::with(['researchProject'])->where('id',$user->id)->get();
        if($user->hasRole('admin')){
            return true;
        }
        foreach ($researchGroup as $res) {
            //print($res);
            if($user->id == $res->id  ){
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Product $product)
    {
        //
    }
}
