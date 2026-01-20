<?php

namespace RedJasmine\UserCore\Application\Services\Commands\UserUnbindSocialite;

use RedJasmine\Support\Application\Commands\CommandHandler;
use RedJasmine\Support\Exceptions\BaseException;
use RedJasmine\UserCore\Application\Services\BaseUserApplicationService;
use RedJasmine\UserCore\Domain\Services\Socialite\UserSocialiteService;
use Throwable;

class UserUnbindSocialiteCommandHandler extends CommandHandler
{

    public function __construct(
        protected BaseUserApplicationService $service,
        protected UserSocialiteService $userSocialiteService
    ) {
    }


    /**
     * @param  UserUnbindSocialiteCommand  $command
     *
     * @return bool
     * @throws BaseException
     * @throws Throwable
     */
    public function handle(UserUnbindSocialiteCommand $command) : bool
    {
        $this->beginDatabaseTransaction();

        try {

            $user = $this->service->repository->find($command->id);

            $this->userSocialiteService->unbind($user, $command->provider);

            $this->commitDatabaseTransaction();
        } catch (BaseException $exception) {
            $this->rollBackDatabaseTransaction();
            throw  $exception;
        } catch (Throwable $throwable) {
            $this->rollBackDatabaseTransaction();
            throw  $throwable;
        }

        return true;

    }
}