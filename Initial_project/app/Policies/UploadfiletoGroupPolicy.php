<?php

namespace App\Policies;

use App\Models\ResearchGroup;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UploadfiletoGroupPolicy
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
     * @param  \App\Models\ResearchGroup  $researchGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ResearchGroup $researchGroup)
    {
        dd($researchGroup);
        //$researchg=ResearchGroup::find(1)->user()->where('user_id',$user->id)->get();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user,ResearchGroup $researchGroup)
    {
        dd($researchGroup);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ResearchGroup  $researchGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ResearchGroup $researchGroup)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ResearchGroup  $researchGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ResearchGroup $researchGroup)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ResearchGroup  $researchGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ResearchGroup $researchGroup)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ResearchGroup  $researchGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ResearchGroup $researchGroup)
    {
        //
    }
}
