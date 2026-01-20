<?php

namespace RedJasmine\UserCore\Domain\Services\Socialite;

use RedJasmine\Socialite\Application\Services\Commands\SocialiteUserClearCommand;
use RedJasmine\Socialite\Application\Services\Queries\GetUsersByOwnerQuery;
use RedJasmine\Socialite\Application\Services\SocialiteUserApplicationService;
use RedJasmine\UserCore\Domain\Models\BaseUserModel;


class UserSocialiteService
{


    public function __construct(
        protected SocialiteUserApplicationService $socialiteUserService,
    ) {
    }


    public const   APP_ID = 'UserCenter';


    public function getBinds(BaseUserModel $user)
    {
        $query           = new  GetUsersByOwnerQuery;
        $query->owner    = $user;
        $query->appId    = static::APP_ID;
        $query->provider = null;

        return $this->socialiteUserService->getUsersByOwner($query);

    }

    /**
     * @param  BaseUserModel  $user
     * @param  string  $provider
     *
     * @return bool
     */
    public function unbind(BaseUserModel $user, string $provider) : bool
    {
        $command = new SocialiteUserClearCommand();

        $command->owner    = $user;
        $command->provider = $provider;
        $command->appId    = static::APP_ID;

        return $this->socialiteUserService->clear($command);
    }
}