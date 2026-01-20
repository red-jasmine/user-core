<?php

namespace RedJasmine\UserCore\Application\Services\Commands\SetBaseInfo;

use RedJasmine\Support\Application\Commands\CommandHandler;
use RedJasmine\Support\Exceptions\BaseException;
use RedJasmine\UserCore\Application\Services\BaseUserApplicationService;
use RedJasmine\UserCore\Domain\Models\BaseUserModel;
use Throwable;

class UserSetBaseInfoCommandHandler extends CommandHandler
{

    public function __construct(
        protected BaseUserApplicationService $service
    ) {
    }


    /**
     * @param  UserSetBaseInfoCommand  $command
     *
     * @return BaseUserModel
     * @throws BaseException
     * @throws Throwable
     */
    public function handle(UserSetBaseInfoCommand $command) : BaseUserModel
    {
        $this->beginDatabaseTransaction();

        try {

            $user = $this->service->repository->find($command->id);

            $user->setUserBaseInfo($command);

            $this->service->repository->update($user);

            $this->commitDatabaseTransaction();
        } catch (BaseException $exception) {
            $this->rollBackDatabaseTransaction();
            throw  $exception;
        } catch (Throwable $throwable) {
            $this->rollBackDatabaseTransaction();
            throw  $throwable;
        }

        return $user;

    }
}