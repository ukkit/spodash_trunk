<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Os_type",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="os_family",
 *          description="os_family",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="os_short_name",
 *          description="os_short_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="os_long_name",
 *          description="os_long_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="os_patchset",
 *          description="os_patchset",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="os_is_active",
 *          description="os_is_active",
 *          type="string"
 *      )
 * )
 */
class Os_type extends Model
{
    use SoftDeletes;

    public $table = 'os_types';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'os_family',
        'os_short_name',
        'os_long_name',
        'os_patchset',
        'os_is_active',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'os_family' => 'string',
        'os_short_name' => 'string',
        'os_long_name' => 'string',
        'os_patchset' => 'string',
        'os_is_active' => 'string',
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
}
