<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Group;

class CheckGroupName
{
    public function handle($request, Closure $next)
    {

        $group = Group::where('name', 'Admin')->first();

        if (!$group) {

            return response()->json(['error' => 'Le groupe Admin n\'existe pas'], 404);
        }

        return $next($request);
    }
}
