<?php

namespace RedJasmine\UserCore\Domain\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;
use RedJasmine\Support\Domain\Policies\HasDefaultPolicy;
use RedJasmine\UserCore\Domain\Models\BaseUserModel as Model;

abstract class UserCorePolicy
{
    use HandlesAuthorization;

    use HasDefaultPolicy;

    abstract public static function getModel() : string;

    public function setAccount($user, Model $model) : bool
    {
        return $user->canany($this->buildPermission(__FUNCTION__));
    }

    public function setGroup($user, Model $model) : bool
    {
        return $user->canany($this->buildPermission(__FUNCTION__));
    }

    public function setStatus($user, Model $model) : bool
    {
        return $user->canany($this->buildPermission(__FUNCTION__));
    }


}
