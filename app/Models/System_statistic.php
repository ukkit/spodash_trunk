<?php

namespace App\Models;

use DB;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class System_statistic extends Model
{
    // use SoftDeletes;

    public $table = 'system_statistics';

    // const CREATED_AT = 'created_at';
    // const UPDATED_AT = 'updated_at';

    // protected $dates = ['deleted_at'];

    public $fillable = [
        'action_histories_id',
        'user_id',
        'product_short_name',
        'spm_version',
        'pai_version',
        'action',
        'start_time',
        'start_time',
        'time_taken',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'action_histories_id' => 'integer',
        'user_id' => 'integer',
        'product_short_name' => 'string',
        'spm_version' => 'string',
        'pai_version' => 'string',
        'action' => 'string',
        'start_time' => 'datetime',
        'start_time' => 'datetime',
        'time_taken' => 'time',
        'status' => 'string',
    ];

    public static $rules = [

    ];

    public function data_for_release($release)
    {
        $value = DB::table('action_stats')->where('spm_version', $release)->orWhere('pai_version', $release)->get();

        return $value;
    }
}
