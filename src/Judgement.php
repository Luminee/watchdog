<?php

namespace Luminee\Watchdog;

use Luminee\Watchdog\Model\Power;
use Luminee\Watchdog\Model\RolePower;
use Luminee\Watchdog\Model\AccountPower;
use Illuminate\Foundation\Testing\HttpException;

class Judgement
{
    /**
     * @param $route
     * @param $power_ids
     * @throws Illuminate\Foundation\Testing\HttpException
     * @return bool
     */
    public static function judgement($route, $power_ids)
    {
        $power_id = self::checkPowerExist($route);
//        if (!self::checkAccountPowers($power_id, $role_ids, $account_id)) {
//            throw new HttpException('Operation not allowed');
//        }
        if (!in_array($power_id, $power_ids)) {
            throw new HttpException('Operation not allowed');
        }
        return true;
    }

    /**
     * @param $route
     * @throws Illuminate\Foundation\Testing\HttpException
     * @return mixed
     */
    protected static function checkPowerExist($route)
    {
        if (empty($power = Power::where('route', $route)->first())) {
            throw new HttpException('Route has not bind to operation');
        }
        return $power->id;
    }

    /**
     * @param $power_id
     * @param $role_ids
     * @param $account_id
     * @return bool
     */
    protected static function checkAccountPowers($power_id, $role_ids, $account_id)
    {
        if ($account_power = AccountPower::where('account_id', $account_id)->where('power_id', $power_id)->first()) {
            return $account_power->is_addition == 1;
        } else {
            return !empty(RolePower::whereIn('role_id', $role_ids)->where('power_id', $power_id)->first());
        }
    }
}
