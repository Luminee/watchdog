<?php

namespace Luminee\Watchdog\Services;

use Luminee\Watchdog\Repositories\WatchdogRepository;
use Luminee\Base\Services\BaseService;

class WatchdogService extends BaseService
{
    protected $repo;

    public function __construct()
    {
        if (empty($this->repo)) {
            $this->repo = new WatchdogRepository();
        }
    }

    public function initRoute()
    {
        $routes = $this->repo->getRoutes();
        $create = [];
        $now = date('Y-m-d H:i:s');
        foreach ($this->_GetRoutes as $route) {
            $url = implode('|', $route->methods()) . '@' . $route->uri();
            if (in_array($url, $routes)) continue;
            $create[] = ['route' => $url, 'created_at' => $now, 'updated_at' => $now];
        }
        $this->repo->insertPower($create);
    }
}