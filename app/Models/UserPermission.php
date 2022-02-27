<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'route_name',
    ];

    public static function routeNameList()
    {
        return [
            'pages',
            'navigation-menus',
            'dashboard',
            'users',
            'user-permissions',
        ];
    }

    /**
     * Controlla la situazione di permessi sulla route attuale
     * @param $userRole
     * @param $routeName
     * @return bool
     */
    public static function isRoleHasRightToAccess($userRole, $routeName)
    {
        try {

            $model = static::where('role', $userRole)
                ->where('route_name', $routeName)
                ->first();
            return $model ? true : false;

        } catch (\Throwable $e) {
            return false;
        }
    }
}
