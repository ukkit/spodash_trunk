<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class Dba_detail extends Model
{
    use SoftDeletes;

    public $table = 'dba_details';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'server_details_id',
        'dba_user',
        'dba_password',
        'db_sid',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'server_details_id' => 'integer',
        'dba_user' => 'string',
        'dba_password' => 'string',
        'db_sid' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'server_details_id' => 'required',
        'dba_user' => 'required',
        'dba_password' => 'required',
        'db_sid' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function serverDetails()
    {
        return $this->belongsTo(\App\Models\ServerDetail::class, 'server_details_id');
    }

    public function server_details_by_id()
    {
        return $this->belongsTo(\App\Models\Server_detail::class, 'server_details_id');
    }

    public function getDbaPasswordAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function setDbaPasswordAttribute($value)
    {
        $this->attributes['dba_password'] = Crypt::encryptString($value);
    }
}
