<?php

namespace Luminee\Watchdog;

use Luminee\Watchdog\Model\Power;
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

}
