<?php

namespace App\Models;

use DB;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class Pai_detail extends Model
{
    use SoftDeletes;

    public $table = 'pai_details';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'server_details_id',
        'ambari_details_id',
        'pai_type',
        'pai_user',
        'pai_pwd',
        'pai_db',
        'pai_port',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'server_details_id' => 'integer',
        'ambari_details_id' => 'integer',
        'pai_type' => 'string',
        'pai_user' => 'string',
        'pai_pwd' => 'string',
        'pai_db' => 'string',
        'pai_port' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'server_details_id' => 'required',
        'pai_type' => 'required',
        'pai_user' => 'required',
        'pai_pwd' => 'required',
        'pai_db' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function ambariDetails()
    {
        return $this->belongsTo(\App\Models\Ambari_detail::class, 'ambari_details_id');
    }

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
        return $this->hasMany(\App\Models\Instance_detail::class, 'pai_details_id');
    }

    public function server_details_by_id()
    {
        return $this->belongsTo(\App\Models\Server_detail::class, 'server_details_id');
    }

    public function tablespace_details_by_id($id)
    {
        $retval = DB::table('tablespace_details')->where('pai_details_id', $id)->orderBy('created_at', 'desc')->first();

        return $retval;
    }

    public function setPaiPwdAttribute($value)
    {
        if (! empty($value)) {
            $this->attributes['pai_pwd'] = Crypt::encryptString($value);
        }
    }

    public function getPaiPwdAttribute($value)
    {
        if (! empty($value)) {
            try {
                return Crypt::decryptString($value);
            } catch (DecryptException $e) {
                return $e;
            }
        }
    }
}
