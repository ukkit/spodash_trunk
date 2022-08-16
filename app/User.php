<?php

namespace App;

use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_login_at', 'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $rules = [
        'name' => 'bail|required|min:2',
        // 'email' => 'required|email|unique:users',
        'roles' => 'required|min:1',
    ];

    public function userTeams($id)
    {
        $value = DB::table('teams')
                ->join('user_has_teams', 'teams.id', '=', 'user_has_teams.team_id')
                ->where('user_has_teams.user_id', $id)
                ->take(10)
                ->get('team_name');

        return $value;
    }

    public function userAction($id)
    {
        $value = DB::table('action_histories')->where('users_id', $id)->orderBy('start_time', 'desc')->first();

        return $value;
    }

    public function user_actions($id)
    {
        $value = DB::table('action_histories')->where('users_id', $id)->orderBy('start_time', 'desc')->get();

        return $value;
    }

    public function instance_details($instance_details_id)
    {
        $value = DB::table('instance_details')->where('id', $instance_details_id)->first();

        return $value;
    }
}
