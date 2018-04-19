<?php

namespace App\Policies;

use App\User;
use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(Admin $admin, User $model)
    {
        return $model->owner_id == $admin->id;
    }

    /**
     * Determine whether the admin can create models.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return true;
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(Admin $admin, User $model)
    {
        return $model->owner_id == $admin->id;
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(Admin $admin, User $model)
    {
        return $model->owner_id == $admin->id;
    }
}
