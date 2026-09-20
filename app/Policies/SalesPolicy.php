<?php

namespace App\Policies;

use App\Models\Sales;
use App\Models\User;

class SalesPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, Sales $sales): bool
    {
        return $user->isAdmin() || $sales->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Sales $sales): bool
    {
        return $user->isAdmin() || $sales->user_id === $user->id;
    }

    public function delete(User $user, Sales $sales): bool
    {
        return $user->isAdmin();
    }

    public function restore(User $user, Sales $sales): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Sales $sales): bool
    {
        return $user->isAdmin();
    }
}
