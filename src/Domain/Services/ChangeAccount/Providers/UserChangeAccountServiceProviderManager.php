<?php

namespace RedJasmine\UserCore\Domain\Services\ChangeAccount\Providers;

use RedJasmine\Support\Foundation\Manager\ServiceManager;

class UserChangeAccountServiceProviderManager extends ServiceManager
{

    protected const  DRIVERS = [
        PhoneUserChangeAccountServiceProvider::NAME => PhoneUserChangeAccountServiceProvider::class
    ];

}