<?php

namespace RedJasmine\UserCore\Domain\Services\ChangeAccount\Contracts;

use RedJasmine\UserCore\Domain\Models\BaseUserModel;
use RedJasmine\UserCore\Domain\Services\ChangeAccount\Data\UserChangeAccountData;

interface UserChannelAccountServiceProviderInterface
{
    public function captcha(BaseUserModel $user, UserChangeAccountData $data) : bool;

    public function verify(BaseUserModel $user, UserChangeAccountData $data) : bool;

    public function change(BaseUserModel $user, UserChangeAccountData $data) : bool;
}