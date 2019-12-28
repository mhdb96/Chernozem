<?php
namespace App\Http\Middleware;
use Closure;
use Auth;
class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userRole = Auth::user()->role->name;

        if($userRole != "admin") {
            return redirect('/permission-denied');
        }
        
        return $next($request);
    }
}