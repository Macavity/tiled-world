<?php
namespace App\Http\Middleware;

use Closure;

/**
 * Class NoCache
 * Disable view cache for local environment
 *
 * @package App\Http\Middleware
 */
class NoCache {

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(env('APP_ENV') === 'local'){
            $cachedViewsDirectory = app('path.storage').'/framework/views/';

            if ($handle = opendir($cachedViewsDirectory)) {

                while (false !== ($entry = readdir($handle))) {
                    if(strstr($entry, '.')) continue;
                    @unlink($cachedViewsDirectory . $entry);
                }

                closedir($handle);
            }
        }

        return $next($request);

    }

}