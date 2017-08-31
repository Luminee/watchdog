<?php

namespace Luminee\Watchdog\Middleware;

use Closure;
use Luminee\Watchdog\Judgement;

class GateWatcherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $route = \Route::getRoutes()->match($request)->getUri();
        if (in_array($route, config('watchdog.ignore_route'))) {
            return $next($request);
        }
        Judgement::judgement($route, $this->getAccountId());
        return $next($request);
    }

    protected function getAccountId()
    {
        return $account_id = 1;
    }

}
