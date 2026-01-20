<?php

namespace RedJasmine\UserCore\Infrastructure\Repositories;

use RedJasmine\Support\Foundation\Facades\AES;
use RedJasmine\Support\Infrastructure\Repositories\Repository;
use RedJasmine\UserCore\Domain\Models\BaseUserModel;
use RedJasmine\UserCore\Domain\Repositories\BaseUserRepositoryInterface;

abstract class BaseUserRepository extends Repository implements BaseUserRepositoryInterface
{

    public function findByName(string $name) : ?BaseUserModel
    {
        return $this->query()->where('name', $name)->first();
    }

    public function findByEmail(string $email) : ?BaseUserModel
    {
        return $this->query()->where('email', AES::encryptString($email))->first();
    }

    public function findByPhone(string $phone) : ?BaseUserModel
    {
        return $this->query()->where('phone', AES::encryptString($phone))->first();
    }

    public function findByAccount(string $account) : ?BaseUserModel
    {
        return $this->query()
                    ->where('name', $account)
                    ->orWhere('email', AES::encryptString($account))
                    ->orWhere('phone', AES::encryptString($account))
                    ->first();
    }

    public function findByConditions($credentials) : ?BaseUserModel
    {
        return $this->query()->where($credentials)->first();
    }
}