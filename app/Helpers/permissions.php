<?php

use Illuminate\Support\Arr;

// Logic, based on intellicus_details_id, look for instance_details_id in team_permissions table
// If found, return true
function user_has_rights($id)
{
    $user_id = Auth::user()->id;
    $team_permissions = DB::table('team_permissions')->where('user_id', $user_id)->where('intellicus_details_id', $id)->first();
    if ($team_permissions) {
        return true;
    } else {
        return false;
    }
}

function checkUserRights($id)
{
    $retval = false;
    $uid = Auth::user()->id;
    // echo " | " . $uid;
    $team = DB::table('user_has_teams')->where('user_id', $uid)->get();
    $team_id = Arr::pluck($team, 'team_id');
    $all_team_id = DB::table('teams')->select('id')->where('team_name', 'All')->first();

    if (Auth::user()->hasAnyRole(['advance', 'admin', 'superadmin'])) {
        $retval = true;
    } else {
        $query = DB::table('instance_has_teams')->where('instance_id', $id)->where('team_id', $team_id)->count();
        if ($query > 0) {
            $retval = true;
        } else {
            // BELOW QURTY IS USED TO CHECK IF CURRENT INSTANCE IS MEMBER OF ALL
            $query = DB::table('instance_has_teams')->where('instance_id', $id)->where('team_id', $all_team_id->id)->count();
            if ($query > 0) {
                $retval = true;
            }
        }
    }

    return $retval;
}
