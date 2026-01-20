<?php

namespace RedJasmine\UserCore\UI\Http\User\Api\Controllers\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RedJasmine\UserCore\Application\Services\Commands\UserUnbindSocialite\UserUnbindSocialiteCommand;
use RedJasmine\UserCore\Application\Services\Queries\GetSocialitesQuery;

trait AccountSocialites
{
    /**
     * 获取绑定的社交账号
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function socialites(Request $request) : JsonResponse
    {
        $request->offsetSet('id', Auth::id());
        $result = $this->service->getSocialites(GetSocialitesQuery::from($request));
        return static::success($result);
    }


    /**
     * 解绑社交账号
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function unbindSocialite(Request $request) : JsonResponse
    {
        $request->offsetSet('id', Auth::id());

        $this->service->unbindSocialite(UserUnbindSocialiteCommand::from($request));

        return static::success();
    }


}