<?php

namespace App\Http\Middleware;

use App\Models\UserPermission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class EnsureUserRoleIsAllowedToAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        try {
            $userRole = auth()->user()->role;
            $currentRouteName = Route::currentRouteName();
            if (UserPermission::isRoleHasRightToAccess($userRole, $currentRouteName) || in_array($currentRouteName, $this->defaultUserAccessRole()[$userRole])) {
                return $next($request);
            } else {
                abort(403, 'Non abilitato.');
            }
        } catch (\Throwable $e) {
            abort(403, 'Non abilitato.');
        }
    }

    /**
     * Permessi di default della pagine
     * @return \string[][]
     */
    private function defaultUserAccessRole()
    {
        return [
            'admin' => [
                'user-permissions',
            ]
        ];
    }
}
