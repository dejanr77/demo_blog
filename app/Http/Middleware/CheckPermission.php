<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class CheckPermission
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param null $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {
        if (!$this->auth->guest())
        {
            if ($request->user()->userCan($permission))
            {
                return $next($request);
            }
            else
            {
                return redirect()->route('public.home');
            }
        }

        return $request->ajax() ? response('Unauthorized.', 401) : redirect('login');
    }
}
