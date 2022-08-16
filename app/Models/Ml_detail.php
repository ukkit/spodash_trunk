<?php

namespace App\Models;

use DB;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class Ml_detail extends Model
{
    use SoftDeletes;

    public $table = 'ml_details';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'server_details_id',
        'instance_details_id',
        'intellicus_details_id',
        'database_details_id',
        'ml_builds_id',
        'ml_name',
        'zeppelin_port',
        'zeppelin_user',
        'zeppelin_pwd',
        'installed_path',
        'notes',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'server_details_id' => 'integer',
        'instance_details_id' => 'integer',
        'intellicus_details_id' => 'integer',
        'database_details_id' => 'integer',
        'ml_builds_id' => 'integer',
        'ml_name' => 'string',
        'zeppelin_port' => 'integer',
        'zeppelin_user' => 'string',
        'zeppelin_pwd' => 'string',
        'installed_path' => 'string',
        'notes' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'server_details_id' => 'required',
        'ml_builds_id' => 'required',
        'ml_name' => 'required',
        'zeppelin_port' => 'required',
        'zeppelin_user' => 'required',
        'zeppelin_pwd' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function databaseDetails()
    {
        return $this->belongsTo(\App\Models\Database_detail::class, 'database_details_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function instanceDetails()
    {
        return $this->belongsTo(\App\Models\Instance_detail::class, 'instance_details_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function intellicusDetails()
    {
        return $this->belongsTo(\App\Models\Intellicus_detail::class, 'intellicus_details_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function mlBuilds()
    {
        return $this->belongsTo(\App\Models\Ml_build::class, 'ml_builds_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function serverDetails()
    {
        return $this->belongsTo(\App\Models\Server_detail::class, 'server_details_id');
        // return $this->belongsTo(App\Models\Server_detail::class, 'server_details_id');
    }

    public function server_detail()
    {
        return $this->hasMany('App\Models\Server_detail');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function instanceDetail1s()
    {
        return $this->hasMany(\App\Models\InstanceDetail::class, 'ml_details_id');
    }

    public function return_intellicus_version_details($id, $return_what)
    {
        $value = DB::table('intellicus_versions')->where('id', $id)->get();

        return $value->pluck($return_what);
        // return $value;
    }

    public function getZeppelinPwdAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function setZeppelinPwdAttribute($value)
    {
        $this->attributes['zeppelin_pwd'] = Crypt::encryptString($value);
    }
}
