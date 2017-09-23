<?php

namespace App\Policies;

use App\User;
use App\Sekolah;
use Illuminate\Auth\Access\HandlesAuthorization;

class SekolahPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the sekolah.
     *
     * @param  \App\User  $user
     * @param  \App\Sekolah  $sekolah
     * @return mixed
     */
    public function view(User $user, Sekolah $sekolah)
    {
        //
    }

    /**
     * Determine whether the user can create sekolahs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the sekolah.
     *
     * @param  \App\User  $user
     * @param  \App\Sekolah  $sekolah
     * @return mixed
     */
    public function update(User $user, Sekolah $sekolah)
    {
        //
    }

    /**
     * Determine whether the user can delete the sekolah.
     *
     * @param  \App\User  $user
     * @param  \App\Sekolah  $sekolah
     * @return mixed
     */
    public function delete(User $user, Sekolah $sekolah)
    {
        //
    }
}
