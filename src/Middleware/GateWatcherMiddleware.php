<?php

namespace Luminee\Watchdog\Middleware;

use Closure;
use Illuminate\Foundation\Testing\HttpException;
use Luminee\Watchdog\Model\Power;
use Luminee\Watchdog\Model\AccountRole;

class GateWatcherMiddleware
{
    protected $ignore_route
        = [
        
        ];
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $route = substr($request->getRequestUri(), 1);
        if (in_array($route, $this->ignore_route)) {
            return $next($request);
        }
        if (empty($power = Power::where('route', $route)->first())) {
            throw new HttpException('Route has not bind to operation');
        }
        $power_ids = AccountRole::with('role')->where('account_id', $this->getAccountId())->first()->role->power_ids;
        if ($power_ids == 0 || in_array($power->id, explode(',', $power_ids))) {
            return $next($request);
        }
        throw new HttpException('Operation not allowed');
    }
    
    protected function getAccountId()
    {
        return $account_id = 1;
    }
    
}
