<?php

namespace App\Policies;
use Illuminate\Auth\Access\HandlesAuthorization;
use MoonShine\Models\MoonshineUser;
use App\Models\MarketAccess;

class MarketAccessPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user)
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function view(MoonshineUser $user, MarketAccess $model)
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function create(MoonshineUser $user)
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function update(MoonshineUser $user, MarketAccess $model)
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function delete(MoonshineUser $user, MarketAccess $model)
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function massDelete(MoonshineUser $user)
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function restore(MoonshineUser $user, MarketAccess $model)
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function forceDelete(MoonshineUser $user, MarketAccess $model)
    {
        return $user->moonshine_user_role_id === 1;
    }
}
