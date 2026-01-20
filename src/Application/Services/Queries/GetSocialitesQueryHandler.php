<?php

namespace RedJasmine\UserCore\Application\Services\Queries;

use RedJasmine\Support\Application\Queries\QueryHandler;
use RedJasmine\Support\Domain\Queries\FindQuery;
use RedJasmine\UserCore\Application\Services\BaseUserApplicationService;
use RedJasmine\UserCore\Domain\Services\Socialite\UserSocialiteService;

class GetSocialitesQueryHandler extends QueryHandler
{


    public function __construct(
        protected BaseUserApplicationService $service,
        protected UserSocialiteService $userSocialiteService

    ) {
    }

    public function handle(GetSocialitesQuery $query)
    {
        $user = $this->service->repository->find(FindQuery::from(['id' => $query->id]));


        return $this->userSocialiteService->getBinds($user);
    }
}