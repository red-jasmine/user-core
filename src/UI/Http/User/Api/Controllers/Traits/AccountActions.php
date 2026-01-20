<?php

namespace RedJasmine\UserCore\UI\Http\User\Api\Controllers\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RedJasmine\UserCore\Application\Services\BaseUserApplicationService;
use RedJasmine\UserCore\Application\Services\Commands\SetBaseInfo\UserSetBaseInfoCommand;
use RedJasmine\UserCore\Application\Services\Commands\SetPassword\UserSetPasswordCommand;
use RedJasmine\UserCore\UI\Http\User\Api\Requests\PasswordRequest;
use RedJasmine\UserCore\UI\Http\User\Api\Resources\UserCoreResource;

/**
 * @property BaseUserApplicationService $service
 */
trait AccountActions
{


    public function check() : JsonResponse
    {
        $user = Auth::user();

        return response()->success();
    }

    // 查询
    public function info(Request $request) : UserCoreResource
    {
        $user = Auth::user();

        return UserCoreResource::make($user);
    }


    /**
     * 更新基础信息
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function updateBaseInfo(Request $request) : JsonResponse
    {

        $request->offsetSet('id', Auth::id());

        $this->service->updateBaseInfo(UserSetBaseInfoCommand::from($request));

        return static::success();
    }


    /**
     * 修改密码
     *
     * @param  PasswordRequest  $request
     *
     * @return JsonResponse
     */
    public function password(PasswordRequest $request) : JsonResponse
    {
        $request->offsetSet('id', Auth::id());

        $this->service->setPassword(UserSetPasswordCommand::from($request));

        return static::success();
    }
}