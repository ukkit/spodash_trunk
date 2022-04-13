<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Intellicus_version",
 *      required={"intellicus_version"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="intellicus_version",
 *          description="intellicus_version",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="intellicus_patch",
 *          description="intellicus_patch",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="release_date",
 *          description="release_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="is_active",
 *          description="is_active",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="deleted_at",
 *          description="deleted_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Intellicus_version extends Model
{
    use SoftDeletes;

    public $table = 'intellicus_versions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'intellicus_version',
        'intellicus_patch',
        'release_date',
        'is_active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'intellicus_version' => 'string',
        'intellicus_patch' => 'string',
        'release_date' => 'date',
        'is_active' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'intellicus_version' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function intellicusDetails()
    {
        return $this->hasMany(\App\Models\IntellicusDetail::class, 'intellicus_versions_id');
    }
}
