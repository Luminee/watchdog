<?php

namespace Luminee\Watchdog\Middleware;

use Luminee\Watchdog\Judgement;
use Luminee\Watchdog\Repositories\WatchdogRepository;

class GateKeeper
{
    protected $power_ids;

    protected $role_ids;

    protected $route = '';

    protected $watchdog;

    public function __construct()
    {
        if (empty($this->watchdog)) {
            $this->watchdog = new WatchdogRepository();
        }
    }

    /**
     * @param $request
     * @param $account_id
     * @throws Illuminate\Foundation\Testing\HttpException
     * @return bool
     */
    public function check($request, $account_id)
    {
        if (empty($this->route)) {
            $router = \Route::getRoutes()->match($request);
            $this->route = implode('|', $router->methods()) . '@' . $router->uri();
        }
        $this->role_ids = $this->watchdog->getRoleIdsByAccountId($account_id);
        $this->power_ids = $this->watchdog->getAccountPowerIds($this->role_ids, $account_id);
        if (in_array($this->route, config('watchdog.ignore_route'))) {
            return true;
        }
        if (in_array(config('watchdog.super_admin_id'), $this->role_ids)) {
            return true;
        }
        return Judgement::judgement($this->route, $this->power_ids);
    }

}
