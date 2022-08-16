<?php

namespace App\Models;

use DB;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Action_history extends Model
{
    use SoftDeletes;

    public $table = 'action_histories';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'unique_id',
        'users_id',
        'instance_details_id',
        'jenkins_build_id',
        'action',
        'start_time',
        'end_time',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'unique_id' => 'string',
        'users_id' => 'integer',
        'instance_details_id' => 'integer',
        'jenkins_build_id' => 'integer',
        'action' => 'string',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'status' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id' => 'required',
        'unique_id' => 'required',
        'users_id' => 'required',
        'jenkins_build_id' => 'required',
        'action' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
        'status' => 'required',
    ];

    public function users()
    {
        return $this->belongsTo(\App\User::class, 'users_id');
    }

    public function instance_details()
    {
        return $this->belongsTo(\App\Models\Instance_detail::class, 'instance_details_id');
    }

    public function return_product_versions_by_pvid($pvid)
    {
        $value = DB::table('product_versions')
                        ->where('pv_id', $pvid)
                        ->first();

        return $value;
    }

    public function return_product_versions_by_id($id)
    {
        $value = DB::table('product_versions')
                        ->where('id', $id)
                        ->first();

        return $value;
    }

    public function return_pai_versions_by_pvid($pvid)
    {
        $value = DB::table('pai_builds')
                        ->where('pv_id', $pvid)
                        ->first();

        return $value;
    }

    public function return_pai_versions_by_id($id)
    {
        $value = DB::table('pai_builds')
                        ->where('id', $id)
                        ->first();

        return $value;
    }

    public function return_version_data($version)
    {
        $query = Action_history::join('product_versions', 'product_versions.id', '=', 'action_histories.old_build_id')
                                ->where('product_versions.product_ver_number', $version)
                                ->select('action_histories.*', 'product_versions.product_ver_number')
                                ->get();

        return $query;
    }
}
