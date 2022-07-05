<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ml_build extends Model
{
    use SoftDeletes;

    public $table = 'ml_builds';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'ml_version',
        'ml_build',
        'pv_id',
        'is_release_build'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ml_version' => 'string',
        'ml_build' => 'integer',
        'pv_id' => 'string',
        'is_release_build' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ml_version' => 'required',
        'ml_build' => 'required',
        'pv_id' => 'required',
        'is_release_build' => 'required'
    ];
}
