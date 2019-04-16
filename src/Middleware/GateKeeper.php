<?php

namespace Luminee\Watchdog\Middleware;

use Luminee\Watchdog\Judgement;
use Luminee\Watchdog\Model\AccountPower;
use Luminee\Watchdog\Model\AccountRole;
use Luminee\Watchdog\Model\RolePower;

class GateKeeper
{
    protected $power_ids;

    /**
     * @param $request
     * @param $account_id
     * @throws Illuminate\Foundation\Testing\HttpException
     * @return bool
     */
    public function check($request, $account_id)
    {
        $router = \Route::getRoutes()->match($request);
        $route = implode('|', $router->methods()) . '@' . $router->uri();
        if (in_array($route, config('watchdog.ignore_route'))) {
            return true;
        }
        $role_ids = $this->getRole($account_id);
        if (in_array(config('watchdog.super_admin_id'), $role_ids)) {
            return true;
        }
        $this->power_ids = $this->getPowers($role_ids, $account_id);
        return Judgement::judgement($route, $this->power_ids);
    }

    protected function getRole($account_id)
    {
        return AccountRole::where('account_id', $account_id)->pluck('role_id')->toArray();
    }

    protected function getPowers($role_ids, $account_id)
    {
        $role_powers = RolePower::whereIn('role_id', $role_ids)->pluck('power_id')->toArray();
        $other_powers = AccountPower::where('account_id', $account_id)->get();
        $remove = [];
        foreach ($other_powers as $id) {
            $id->is_addition == 1 ? $role_powers[] = $id->power_id : $remove[] = $id->power_id;
        }
        $ids = [];
        foreach ($role_powers as $id) {
            if (!in_array($id, $remove)) $ids[] = $id;
        }
        return $ids;
    }

}
