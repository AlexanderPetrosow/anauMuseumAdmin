<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DemoGuide
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $license = file_get_contents(base_path('license'));
        if(!Hash::check(trim($license), file_get_contents(base_path('.igitignore')))){
            $uri = explode('/', $request->url());
            return redirect('/'.trim($uri[3]));
        }
        return $next($request);
    }
}
