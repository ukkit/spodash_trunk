<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product_name
 *
 * @version January 24, 2019, 8:20 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection InstanceDetail
 * @property \Illuminate\Database\Eloquent\Collection serverDetails
 * @property string product_short_name
 * @property string product_long_name
 * @property string product_is_active
 */
class Product_name extends Model
{
    use SoftDeletes;

    public $table = 'product_names';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'product_short_name',
        'product_long_name',
        'product_is_active',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_short_name' => 'string',
        'product_long_name' => 'string',
        'product_is_active' => 'string',
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
    public function instanceDetails()
    {
        return $this->hasMany(\App\Models\InstanceDetail::class);
    }

    public function product_version()
    {
        return $this->hasMany('App\Models\Product_version');
    }
}
