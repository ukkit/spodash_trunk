<?php

namespace App\Models;

use Auth;
use DB;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sofa\Eloquence\Eloquence;

class Instance_detail extends Model
{
    use SoftDeletes;
    use Eloquence;

    public $table = 'instance_details';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'server_details_id',
        'product_names_id',
        'product_versions_id',
        'database_details_id',
        'intellicus_details_id',
        'pai_details_id',
        'ml_details_id',
        'pv_id',
        'pai_pv_id',
        'sf_pv_id',
        'instance_name',
        'instance_tomcat_port',
        'instance_ap_port',
        'instance_web_port',
        'instance_login',
        'instance_pwd',
        'show_instance_login',
        'enable_instance_auto_login',
        'jenkins_url',
        'jenkins_uname',
        'jenkins_pwd',
        'jenkins_token',
        'instance_is_auto_upgraded',
        'instance_is_active',
        'instance_show_on_site',
        'is_https',
        'running_jenkins_job',
        'show_jenkins_build',
        'instance_status',
        'db_backup_enabled',
        'instance_owner',
        'instance_note',
        'instance_install_path',
        'instance_shared_dir',
        'instance_jira',
        'escm_type',
        'tomcat_service_name',
        'ap_service_name',
        'instance_web_min_heap_size',
        'instance_web_max_heap_size',
        'instance_ap_min_heap_size',
        'instance_ap_max_heap_size',
        'jdk_type',
        'jdk_version',
        'qa_intentionally_disabled',
        'in_use',
        'in_use_msg',
        'webserver_version',
        'is_insight_enabled',
        'is_contrast_configured',
        'snowflake_configured',
        'pai_foundation',
        'check_fail_count',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'server_details_id' => 'integer',
        'product_names_id' => 'integer',
        'product_versions_id' => 'integer',
        'database_details_id' => 'integer',
        'intellicus_details_id' => 'integer',
        'pai_details_id' => 'integer',
        'ml_details_id' => 'integer',
        'pv_id' => 'string',
        'pai_pv_id' => 'string',
        'sf_pv_id' => 'string',
        'instance_name' => 'string',
        'instance_tomcat_port' => 'integer',
        'instance_ap_port' => 'integer',
        'instance_web_port' => 'integer',
        'instance_login' => 'string',
        'instance_pwd' => 'string',
        'show_instance_login' => 'string',
        'enable_instance_auto_login' => 'string',
        'jenkins_url' => 'string',
        'jenkins_uname' => 'string',
        'jenkins_pwd' => 'string',
        'jenkins_token' => 'string',
        'instance_is_auto_upgraded' => 'string',
        'instance_is_active' => 'string',
        'instance_show_on_site' => 'string',
        'show_jenkins_build' => 'string',
        'is_https' => 'string',
        'running_jenkins_job' => 'string',
        // 'is_upgrading' => 'string',
        'instance_status' => 'string',
        'db_backup_enabled' => 'string',
        'instance_owner' => 'string',
        'instance_note' => 'string',
        'instance_install_path' => 'string',
        'instance_shared_dir' => 'string',
        'instance_jira' => 'string',
        'escm_type' => 'string',
        'tomcat_service_name' => 'string',
        'ap_service_name' => 'string',
        'instance_web_min_heap_size' => 'integer',
        'instance_web_max_heap_size' => 'integer',
        'instance_ap_min_heap_size' => 'integer',
        'instance_ap_max_heap_size' => 'integer',
        'jdk_type' => 'string',
        'jdk_version' => 'string',
        'in_use' => 'string',
        'in_use_msg' => 'string',
        'qa_intentionally_disabled' => 'string',
        'webserver_version' => 'string',
        'is_insight_enabled' => 'string',
        'is_contrast_configured' => 'string',
        'snowflake_configured' => 'string',
        'pai_foundation' => 'string',
        'check_fail_count' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'jdk_type' => 'required',
        'jdk_version' => 'required',
    ];

    public function productName()
    {
        return $this->belongsTo(\App\Models\Product_name::class);
    }

    public function databaseType()
    {
        return $this->hasMany(\App\Models\Database_type::class);
    }

    public function productVersion()
    {
        return $this->belongsTo(\App\Models\Product_version::class);
    }

    public function serverDetail()
    {
        return $this->belongsTo(\App\Models\Server_detail::class);
    }

    public function mlDetail()
    {
        return $this->belongsTo(\App\Models\Ml_detail::class, 'ml_details_id');
    }

    public function product_version()
    {
        return $this->belongsTo(\App\Models\Product_version::class);
    }

    public function product_name()
    {
        return $this->belongsTo(\App\Models\Product_name::class);
    }

    public function server_detail()
    {
        return $this->belongsTo(\App\Models\Server_detail::class);
    }

    public function database_type()
    {
        return $this->hasMany(\App\Models\Database_type::class);
    }

    public function database_detail()
    {
        return $this->belongsTo(\App\Models\Database_detail::class);
    }

    public function sf_builds_by_pvid($pvid)
    {
        $value = DB::table('sf_builds')
            ->where('pv_id', $pvid)
            ->select('sf_builds.*')
            ->first();

        return $value;
    }

    public function product_versions_by_id() // This is not to be used
    {
        return $this->belongsTo(\App\Models\Product_version::class, 'product_versions_id');
    }

    public function return_product_versions_by_pvid($pvid, $return_what)
    {
        $value = DB::table('product_versions')
            ->where('pv_id', $pvid)
            ->select('product_versions.*')
            ->get();

        return $value->pluck($return_what);
    }

    public function product_versions_by_pvid($pvid)
    {
        $value = DB::table('product_versions')
            ->where('pv_id', $pvid)
            ->select('product_versions.*')
            ->first();

        return $value;
    }

    public function pai_versions_by_pvid($pvid)
    {
        $value = DB::table('pai_builds')
            ->where('pv_id', $pvid)
            ->select('pai_builds.*')
            ->first();

        return $value;
    }

    public function latest_sf_build_number_by_version($version)
    {
        $value = DB::table('sf_builds')
            ->where('sf_pai_version', $version)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->first();

        return $value;
    }

    public function server_details_by_id()
    {
        return $this->belongsTo(\App\Models\Server_detail::class, 'server_details_id');
    }

    public function product_names_by_id()
    {
        return $this->belongsTo(\App\Models\Product_name::class, 'product_names_id');
    }

    public function database_details_by_id()
    {
        return $this->belongsTo(\App\Models\Database_detail::class, 'database_details_id');
    }

    public function intellicus_details_by_id()
    {
        return $this->belongsTo(\App\Models\Intellicus_detail::class, 'intellicus_details_id');
    }

    public function return_db_details($id, $return_what)
    {
        $value = DB::table('database_details')->select($return_what)->where('id', $id)->first();

        return $value->$return_what;
    }

    public function return_db_type($id, $return_what)
    {
        $value = DB::table('database_details')->where('database_details.id', $id)
            ->join('database_types', 'database_details.database_types_id', '=', 'database_types.id')
            ->select('database_types.*')
            ->get();

        return $value->pluck($return_what);
    }

    public function return_db_server_details($id)
    // public function return_db_server_details($id,$return_what)
    {
        $value = DB::table('database_details')->where('database_details.id', $id)
            ->join('server_details', 'database_details.server_details_id', '=', 'server_details.id')
            ->select('server_details.*')
            ->first();
        // return $value->pluck($return_what);
        return $value;
    }

    public function return_server_details_by_id($id, $return_what)
    {
        $value = DB::table('server_details')->where('id', $id)->get();

        return $value->pluck($return_what);
    }

    public function return_ambari_details_by_id($id, $return_what)
    {
        $value = DB::table('ambari_details')->where('id', $id)->get();

        return $value->pluck($return_what);
    }

    public function return_os_details($id, $return_what)
    {
        $value = DB::table('server_details')->where('server_details.id', $id)
            ->join('os_types', 'server_details.os_types_id', '=', 'os_types.id')
            ->select('os_types.*')
            ->get();

        return $value->pluck($return_what);
    }

    public function latest_build_number_by_version($version)
    {
        $value = DB::table('product_versions')
            ->where('product_ver_number', $version)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->first();

        return $value;
    }

    public function latest_pai_build_number_by_version($version)
    {
        $value = DB::table('pai_builds')
            ->where('pai_version', $version)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->first();

        return $value;
    }

    public function return_build_creation_date($version, $build)
    {
        $value = DB::table('product_versions')
            ->select('created_at')
            ->where('product_ver_number', $version)
            ->where('product_build_numer', $build)
            ->orderBy('created_at', 'desc')
            ->first();
        // $value = DB::table('product_versions')->where('product_ver_number',$version)->max('product_build_numer');
        return $value;
    }

    public function return_pai_build_creation_date($version, $build)
    {
        $value = DB::table('pai_builds')
            ->select('created_at')
            ->where('pai_version', $version)
            ->where('pai_build', $build)
            ->orderBy('created_at', 'desc')
            ->first();
        // $value = DB::table('product_versions')->where('product_ver_number',$version)->max('product_build_numer');
        return $value;
    }

    public function get_username_by_id($id)
    {
        $value = DB::table('users')->where('id', $id)
            ->select('name')
            ->first();

        return $value;
    }

    public function return_action_history_details($id)
    {
        $value = DB::table('action_histories')->where('instance_details_id', $id)
            ->select('action_histories.*')
            ->orderBy('start_time', 'desc')
            ->first();

        return $value;
    }

    public function return_all_action_history_by_id($id)
    {
        $value = DB::table('action_histories')->where('instance_details_id', $id)
            ->select('action_histories.*')
            ->orderBy('start_time', 'desc')
            ->take(10)
            ->get();

        return $value;
    }

    public function check_user_rights_for_instance($id)
    {
        $retval = null;
        $uid = Auth::user()->id;
        $team = DB::table('user_has_teams')->where('user_id', $uid)->get();
        $team_id = array_pluck($team, 'team_id');
        $all_team_id = DB::table('teams')->select('id')->where('team_name', 'All')->first();
        // dd($all_team_id->id);
        // $is_all_teams = DB::table('teams')->

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

    public function return_team_names($id, $return_what)
    {
        $instance_team_details = DB::table('instance_has_teams')->where('instance_id', $id)->get();
        $team_array = [];
        if (count($instance_team_details) > 0) {
            foreach ($instance_team_details as $itid) {
                $team_name = DB::table('teams')->where('id', $itid->team_id)->first();
                array_push($team_array, $team_name->$return_what);
            }
        }

        return $team_array;
    }

    public function return_team_details($id)
    {
        $instance_team_id = DB::table('instance_has_teams')->where('instance_id', $id)->get();
        $team_details = null;
        if (count($instance_team_id) > 0) {
            foreach ($instance_team_id as $itid) {
                $team_details = DB::table('teams')->where('id', $itid->team_id)->first();
            }
        }

        return $team_details;
    }

    public function return_intellicus_version_details($id, $return_what)
    {
        $value = DB::table('intellicus_versions')->where('id', $id)->get();

        return $value->pluck($return_what);
    }

    public function return_database_type($id)
    {
        $dbt_result = DB::table('database_details')->select('database_types_id')->where('id', $id)->first();
        $dbt = DB::table('database_types')->select('db_short_name')->where('id', $dbt_result->database_types_id)->first();

        if (strtolower(substr($dbt->db_short_name, 0, 3)) == 'mss') {
            $retval = 'mssql';
        } elseif (strtolower(substr($dbt->db_short_name, 0, 3)) == 'ora') {
            $retval = 'oracle';
        } elseif (strtolower(substr($dbt->db_short_name, 0, 3)) == 'had') {
            $retval = 'hadoop';
        } else {
            $retval = null;
        }

        return $retval;
    }

    public function get_ml_build($id)
    {
        $value = DB::table('ml_builds')->where('id', $id)->first();

        return $value;
    }
}
