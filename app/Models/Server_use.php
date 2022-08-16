<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Server_use
 *
 * @version January 25, 2019, 1:20 pm UTC
 *
 * @property \App\Models\ServerDetail serverDetail
 * @property \Illuminate\Database\Eloquent\Collection serverDetails
 * @property int server_details_id
 * @property string use_short_name
 * @property string use_long_name
 */
class Server_use extends Model
{
    use SoftDeletes;

    public $table = 'server_uses';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'server_details_id',
        'use_short_name',
        'use_long_name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'server_details_id' => 'integer',
        'use_short_name' => 'string',
        'use_long_name' => 'string',
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
    public function serverDetail()
    {
        return $this->belongsTo(\App\Models\ServerDetail::class);
    }

    public function server_detail()
    {
        return $this->hasMany(\App\Models\Server_detail::class);
    }
}
