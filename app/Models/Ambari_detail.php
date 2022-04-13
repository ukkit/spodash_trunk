<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;


class Ambari_detail extends Model
{
    use SoftDeletes;

    public $table = 'ambari_details';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'ambari_name',
        'ambari_url',
        'ambari_user',
        'ambari_pwd'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ambari_name' => 'string',
        'ambari_url' => 'string',
        'ambari_user' => 'string',
        'ambari_pwd' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ambari_name' => 'required',
        'ambari_url' => 'required',
        'ambari_user' => 'required',
        'ambari_pwd' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function hadoopDetails()
    {
        return $this->hasMany(\App\Models\HadoopDetail::class, 'ambari_details_id');
    }

    public function getAmbariPwdAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function setAmbariPwdAttribute($value)
    {
        $this->attributes['ambari_pwd'] = Crypt::encryptString($value);
    }
}
