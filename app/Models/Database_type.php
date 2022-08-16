<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Database_type",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="db_short_name",
 *          description="db_short_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="db_long_name",
 *          description="db_long_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="db_patchset",
 *          description="db_patchset",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="db_is_active",
 *          description="db_is_active",
 *          type="string"
 *      )
 * )
 */
class Database_type extends Model
{
    use SoftDeletes;

    public $table = 'database_types';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'db_short_name',
        'db_long_name',
        'db_patchset',
        'db_is_active',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'db_short_name' => 'string',
        'db_long_name' => 'string',
        'db_patchset' => 'string',
        'db_is_active' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function serverDetails()
    {
        return $this->hasMany(\App\Models\ServerDetail::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function databaseDetails()
    {
        return $this->hasMany(\App\Models\DatabaseDetail::class);
    }

    public function instanceDetails()
    {
        return $this->hasMany(\App\Models\InstanceDetail::class);
    }

    public function instance_detail()
    {
        return $this->hasMany(\App\Models\Instance_detail::class);
    }

    public function server_detail()
    {
        return $this->hasMany(\App\Models\Server_detail::class);
    }
}
