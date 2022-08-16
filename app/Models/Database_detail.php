<?php

namespace App\Models;

use DB;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Database_detail extends Model
{
    use SoftDeletes;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

    public $table = 'database_details';
    // protected $softCascade = ['cascade_soft_delete_instance_detail'];

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'gen_dbd_id',
        'server_details_id',
        'database_types_id',
        'ambari_details_id',
        'db_sid',
        'db_user',
        'db_pass',
        'db_port',
        'jira_number',
        'db_notes',
        'db_is_active',
        'is_dba',
        'repository_type',
        // 'is_intellicus_repository'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'gen_dbd_id' => 'string',
        'server_details_id' => 'integer',
        'database_types_id' => 'integer',
        'ambari_details_id' => 'integer',
        'db_sid' => 'string',
        'db_user' => 'string',
        'db_pass' => 'string',
        'db_port' => 'integer',
        'jira_number' => 'string',
        'db_notes' => 'string',
        'db_is_active' => 'string',
        'is_dba' => 'string',
        'repository_type' => 'string',
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
    public function serverDetail()
    {
        return $this->belongsTo(\App\Models\ServerDetail::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function instanceDetails()
    {
        return $this->hasMany(\App\Models\InstanceDetail::class);
    }

    public function cascade_soft_delete_instance_detail()
    {
        return $this->hasMany(\App\Models\Instance_detail::class, 'database_details_id');
    }

    public function server_details_by_id()
    {
        return $this->belongsTo(\App\Models\Server_detail::class, 'server_details_id');
    }

    public function database_types_by_id()
    {
        return $this->belongsTo(\App\Models\Database_type::class, 'database_types_id');
    }

    public function ambari_details_by_id()
    {
        return $this->belongsTo(\App\Models\Ambari_detail::class, 'ambari_details_id');
    }

    public function tablespace_details_by_id($id)
    {
        $retval = DB::table('tablespace_details')->where('database_details_id', $id)->orderBy('created_at', 'desc')->first();

        return $retval;
    }

    public function db_size_by_id($id)
    {
        $retval = DB::table('db_sizes')->where('database_details_id', $id)->orderBy('created_at', 'desc')->first();

        return $retval;
    }

    // public function db_size_by_id($id)
    // {
    //     $retval = DB::table('database_sizes')->where('database_details_id', $id)->orderBy('created_at', 'desc')->first();
    //     return $retval;
    // }
}
