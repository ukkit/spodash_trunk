<?php

namespace App\Models;

use DB;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class Intellicus_detail extends Model
{
    use SoftDeletes;

    public $table = 'intellicus_details';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'intellicus_name',
        'server_details_id',
        'intellicus_versions_id',
        'database_details_id',
        'intellicus_port',
        'intellicus_login',
        'intellicus_pwd',
        'intellicus_install_path',
        'intellicus_memory',
        'is_https',
        'jdk_type',
        'jdk_version',
        'is_active',
        'check_fail_count',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'intellicus_name' => 'string',
        'server_details_id' => 'integer',
        'database_details_id' => 'integer',
        'intellicus_versions_id' => 'integer',
        'intellicus_port' => 'integer',
        'intellicus_login' => 'string',
        'intellicus_pwd' => 'string',
        'intellicus_install_path' => 'string',
        'intellicus_memory' => 'integer',
        'is_https' => 'string',
        'jdk_type' => 'string',
        'jdk_version' => 'string',
        'is_active' => 'string',
        'check_fail_count' => 'integer',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'intellicus_name' => 'required',
        'server_details_id' => 'required',
        'intellicus_versions_id' => 'required',
        'intellicus_login' => 'required',
        'intellicus_pwd' => 'required',
        'intellicus_port' => 'required',
        'intellicus_memory' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function serverDetails()
    {
        return $this->belongsTo(\App\Models\Server_detail::class, 'server_details_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function instanceDetails()
    {
        return $this->hasMany(\App\Models\Instance_detail::class, 'intellicus_details_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function intellicusVersions()
    {
        return $this->hasMany(\App\Models\Intellicus_version::class, 'intellicus_versions_id');
    }

    public function instance_detail()
    {
        return $this->hasMany('App\Models\Instance_detail');
    }

    public function server_detail()
    {
        return $this->hasMany('App\Models\Server_detail');
    }

    public function database_detail()
    {
        return $this->hasMany('App\Models\Database_detail');
    }

    public function intellicus_version()
    {
        return $this->hasMany('App\Models\Intellicus_version');
    }

    public function server_details_by_id()
    {
        return $this->belongsTo('App\Models\Server_detail', 'server_details_id');
    }

    public function database_details_by_id()
    {
        return $this->belongsTo('App\Models\Database_detail', 'database_details_id');
    }

    public function return_server_details($id, $return_what)
    {
        $value = DB::table('server_details')->where('id', $id)
               ->get();

        return $value->pluck($return_what);
        // return $value;
    }

    public function return_intellicus_version_details($id, $return_what)
    {
        $value = DB::table('intellicus_versions')->where('id', $id)
               ->get();

        return $value->pluck($return_what);
        // return $value;
    }

    public function getIntellicusPwdAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function setIntellicusPwdAttribute($value)
    {
        $this->attributes['intellicus_pwd'] = Crypt::encryptString($value);
    }

    public function getIntellicusVersionbyID($id)
    {
        $retval = DB::table('intellicus_versions')->where('id', $id)->get();
        // return ($retval[0]->id);
        return $retval;
    }
}
