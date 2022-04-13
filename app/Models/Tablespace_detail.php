<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tablespace_detail extends Model
{
    use SoftDeletes;

    public $table = 'tablespace_details';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'database_details_id',
        'pai_details_id',
        'tablespace_name',
        'used_space',
        'free_space',
        'total_space'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'database_details_id' => 'integer',
        'pai_details_id' => 'integer',
        'tablespace_name' => 'string',
        'used_space' => 'integer',
        'free_space' => 'integer',
        'total_space' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'database_details_id' => 'required',
        'tablespace_name' => 'required',
        'used_space' => 'required',
        'free_space' => 'required',
        'total_space' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function databaseDetails()
    {
        return $this->belongsTo(\App\Models\DatabaseDetail::class, 'database_details_id');
    }

    public function paiDetails()
    {
        return $this->belongsTo(\App\Models\PaiDetail::class, 'pai_details_id');
    }
}
