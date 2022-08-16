<?php

namespace App\Models;

use Auth;
use DB;
use Eloquent as Model;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Traits\HasRoles;

class Server_detail extends Model
{
    use SoftDeletes,HasRoles;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

    public $table = 'server_details';

    protected $softCascade = ['cascade_soft_delete_instance_detail', 'cascade_soft_delete_database_detail'];

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'gen_sd_id',
        'os_types_id',
        'database_types_id',
        'server_uses_id',
        'server_name',
        'server_ip',
        'server_class',
        'server_location',
        'server_ram_gb',
        'server_hdd_gb',
        'server_user',
        'server_password',
        'admin_user',
        'admin_password',
        'server_cpu_cores',
        'server_is_active',
        'server_show_on_site',
        'server_owner',
        'server_note',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'gen_sd_id' => 'string',
        'os_types_id' => 'integer',
        'database_types_id' => 'integer',
        'server_uses_id' => 'integer',
        'server_name' => 'string',
        'server_ip' => 'string',
        'server_class' => 'string',
        'server_location' => 'string',
        'server_ram_gb' => 'integer',
        'server_hdd_gb' => 'integer',
        'server_cpu_cores' => 'integer',
        'server_user' => 'string',
        'server_password' => 'string',
        'admin_user' => 'string',
        'admin_password' => 'string',
        'server_is_active' => 'string',
        'server_show_on_site' => 'string',
        'server_owner' => 'string',
        'server_note' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function databaseType()
    {
        return $this->belongsTo(\App\Models\DatabaseType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function osType()
    {
        return $this->belongsTo(\App\Models\OsType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function instanceDetails()
    {
        return $this->hasMany(\App\Models\InstanceDetail::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function databaseDetails()
    {
        return $this->hasMany(\App\Models\DatabaseDetail::class);
    }

    public function os_type()
    {
        return $this->belongsTo(\App\Models\Os_type::class);
    }

    public function database_type()
    {
        return $this->belongsTo(\App\Models\Database_type::class);
    }

    public function instance_detail()
    {
        return $this->hasMany(\App\Models\Instance_detail::class);
    }

    public function intellicus_detail()
    {
        return $this->hasMany(\App\Models\Intellicus_detail::class);
    }

    public function cascade_soft_delete()
    {
        return $this->hasMany(\App\Models\Instance_detail::class, 'database_details_id');
    }

    public function cascade_soft_delete_instance_detail()
    {
        return $this->hasMany(\App\Models\Instance_detail::class, 'server_details_id', 'database_details_id');
    }

    public function cascade_soft_delete_database_detail()
    {
        return $this->hasMany(\App\Models\Database_detail::class, 'server_details_id');
    }

    public function get_dba_counts($id)
    {
        $value = DB::table('dba_details')->where('server_details_id', $id)->whereNull('deleted_at')->get();

        return count($value);
    }

    public function instance_use()
    {
        return $this->hasMany('App\Models\Instance_Use');
    }

    public function os_types_by_id()
    {
        return $this->belongsTo(\App\Models\Os_type::class, 'os_types_id');
    }

    public function database_types_by_id()
    {
        return $this->belongsTo(\App\Models\Database_type::class, 'database_types_id');
    }

    public function return_server_details($id, $return_what)
    {
        $value = DB::table('database_details')->where('database_details.id', $id)
                ->join('server_details', 'database_details.server_details_id', '=', 'server_details.id')
                ->select('server_details.*')
                ->get();

        return $value->pluck($return_what);
    }

    public function database_details_by_id($id)
    {
        if (Auth::guest()) { // IF USER IS NOT LOGGED IN, THEN DON'T SHOW ANYTHING
            $ret_val = [];
        } else {
            $ret_val = DB::table('database_details')->where('server_details_id', $id)->where('db_is_active', 'Y')->whereNull('database_details.deleted_at')->get();
        }

        return $ret_val;
    }

    public function instance_details_by_server_id($id)
    {
        // $user_id = Auth::id();
        $send_all = 'N';
        if (Auth::guest()) {
            $send_all = 'N';
        } elseif (Auth::user()->hasAnyRole(['advance', 'admin', 'superadmin'])) {
            $send_all = 'Y';
        }

        $instance_id_array = [];
        $all_team_id = DB::table('teams')->select('id')->where('team_name', 'All')->first();
        $intance_list = DB::table('instance_details')->where('server_details_id', $id)->whereNull('instance_details.deleted_at')->get();

        if ($send_all == 'Y') {
            return $intance_list;
        } else {
            $user_team_id = DB::table('user_has_teams')->select('team_id')->where('user_id', Auth::id())->get();
            foreach ($intance_list as $ilist) {
                foreach ($user_team_id as $utid) {
                    $instance_team_id = DB::table('instance_has_teams')->where('instance_id', $ilist->id)->where('team_id', $utid->team_id)->get();
                    // echo $utid->team_id . "-----" . $ilist->id;
                    if (count($instance_team_id) > 0) {
                        array_push($instance_id_array, $ilist->id);
                    }
                }
                $all_teams = DB::table('instance_has_teams')->where('instance_id', $ilist->id)->where('team_id', $all_team_id->id)->get();
                if (count($all_teams) > 0) {
                    array_push($instance_id_array, $ilist->id);
                }
            }
            // $ret_val = instance_detail::whereIn('id', $instance_id_array)->where('instance_show_on_site', 'Y')->get();
            $ret_val = DB::table('instance_details')->whereIn('id', $instance_id_array)->where('instance_show_on_site', 'Y')->get();

            return $ret_val;
        }
    }

    public function ml_details_by_server_id($id)
    {
        if (Auth::guest()) { // IF USER IS NOT LOGGED IN, THEN DON'T SHOW ANYTHING
            $ret_val = [];
        } else {
            $ret_val = DB::table('ml_details')->where('server_details_id', $id)->whereNull('deleted_at')->get();
        }

        return $ret_val;
    }

    public function count_instance_details_by_server_id($id)
    {
        $inst_count = DB::table('instance_details')
            ->where('server_details_id', $id)
            ->whereNull('instance_details.deleted_at')
            ->count();

        return $inst_count;
    }

    public function count_database_details_by_server_id($id)
    {
        $db_count = DB::table('database_details')
            ->where('server_details_id', $id)
            ->whereNull('database_details.deleted_at')
            ->count();

        return $db_count;
    }

    public function product_version_by_id($id, $return_what)
    {
        $query = DB::table('product_versions')->where('id', $id)->value($return_what);

        return $query;
    }

    public function product_version_by_pvid($id, $return_what)
    {
        $query = DB::table('product_versions')->where('pv_id', $id)->value($return_what);

        return $query;
    }

    public function product_name_by_id($id, $return_what)
    {
        $query = DB::table('product_names')->where('id', $id)->value($return_what);

        return $query;
    }

    public function server_use_by_id()
    {
        return $this->belongsTo(\App\Models\Server_use::class, 'server_uses_id');
    }

    public function return_team_names($id)
    {
        $instance_team_id = DB::table('instance_has_teams')->where('instance_id', $id)->get();
        $team_array = [];
        if (count($instance_team_id) > 0) {
            foreach ($instance_team_id as $itid) {
                $team_name = DB::table('teams')->where('id', $itid->team_id)->first();
                array_push($team_array, $team_name->team_name);
            }
        }

        return $team_array;
    }

    public function db_size_by_id($id)
    {
        $retval = DB::table('db_sizes')->where('database_details_id', $id)->orderBy('created_at', 'desc')->first();

        return $retval;
    }

    public function getServerPasswordAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function getAdminPasswordAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return $value;
        }
    }

    public function setServerPasswordAttribute($value)
    {
        $this->attributes['server_password'] = Crypt::encryptString($value);
    }

    public function setAdminPasswordAttribute($value)
    {
        $this->attributes['admin_password'] = Crypt::encryptString($value);
    }
}
