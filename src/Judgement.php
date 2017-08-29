<?php

namespace Luminee\Watchdog;

use Illuminate\Foundation\Testing\HttpException;
use Luminee\Watchdog\Model\Power;
use Luminee\Watchdog\Model\AccountRole;

class Judgement
{
    public static function judgement($route, $account_id)
    {
        if (empty($power = Power::where('route', $route)->first())) {
            throw new HttpException('Route has not bind to operation');
        }
        $power_ids = AccountRole::with('role')->where('account_id', $account_id)->first()->role->power_ids;
        if ($power_ids != 0 && !in_array($power->id, explode(',', $power_ids))) {
            throw new HttpException('Operation not allowed');
        }
        return true;
    }
}