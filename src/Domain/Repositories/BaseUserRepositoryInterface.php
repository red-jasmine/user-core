<?php

namespace RedJasmine\UserCore\Domain\Repositories;

use RedJasmine\Support\Domain\Repositories\RepositoryInterface;
use RedJasmine\UserCore\Domain\Models\BaseUserModel;

/**
 * @method BaseUserModel  find($id)
 */
interface BaseUserRepositoryInterface extends RepositoryInterface
{
    public function findByName(string $name) : ?BaseUserModel;

    public function findByEmail(string $email) : ?BaseUserModel;

    public function findByPhone(string $phone) : ?BaseUserModel;

    /**
     * 登录账号信息
     *
     * @param  string  $account
     *
     * @return BaseUserModel|null
     */
    public function findByAccount(string $account) : ?BaseUserModel;

    public function findByConditions($credentials) : ?BaseUserModel;
}
