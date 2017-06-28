<?php 
namespace App\Http\Middleware;

use Closure;

class EnableCrossRequest {

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Origin, Content-Type, Cookie, Accept, Access-Control-Allow-Headers, Authorization');
        header('Access-Control-Allow-Methods: GET, POST, DELETE, PATCH, PUT, OPTIONS');
        return $next($request);
  }

}