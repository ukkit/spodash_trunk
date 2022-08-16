<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class Permission extends Model
// {
//     //
// }

class Permission extends \Spatie\Permission\Models\Permission
{
    public static function defaultPermissions()
    {
        return [
            'show perm page',

            'view_users',
            'add_users',
            'edit_users',
            'delete_users',

            'view_roles',
            'add_roles',
            'edit_roles',
            'delete_roles',

            'view_instanceDetails',
            'add_instanceDetails',
            'edit_instanceDetails',
            'delete_instanceDetails',
            'start_instanceDetails',
            'stop_instanceDetails',
            'restart_instanceDetails',
            'upgrade_instanceDetails',

            'view_serverDetails',
            'add_serverDetails',
            'edit_serverDetails',
            'delete_serverDetails',

            'view_databaseDetails',
            'add_databaseDetails',
            'edit_databaseDetails',
            'delete_databaseDetails',

            'view_databaseTypes',
            'add_databaseTypes',
            'edit_databaseTypes',
            'delete_databaseTypes',

            'view_osTypes',
            'add_osTypes',
            'edit_osTypes',
            'delete_osTypes',

            'view_productNames',
            'add_productNames',
            'edit_productNames',
            'delete_productNames',

            'view_productVersions',
            'add_productVersions',
            'edit_productVersions',
            'delete_productVersions',

            'view_serverUses',
            'add_serverUses',
            'edit_serverUses',
            'delete_serverUses',
        ];
    }
}
