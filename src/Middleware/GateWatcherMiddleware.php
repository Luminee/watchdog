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
        if (in_array($request->getRequestUri(), config('watchdog.ignore_route'))) {
            return $next($request);
        }
        Judgement::judgement($request->getRequestUri(), $this->getAccountId());
        return $next($request);
    }
    
    protected function getAccountId()
    {
        return $account_id = 1;
    }
    
}
