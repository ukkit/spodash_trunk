<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Instance_detail;

class Sf_build extends Model
{
    use SoftDeletes;

    public $table = 'sf_builds';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'sf_pai_version',
        'sf_pai_build',
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
        'sf_pai_version' => 'string',
        'sf_pai_build' => 'integer',
        'pv_id' => 'string',
        'is_release_build' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'sf_pai_version' => 'required',
        'sf_pai_build' => 'required',
        'pv_id' => 'required',
        'is_release_build' => 'required'
    ];

    public function instance_list_by_pvid($pvid)
    {
        $value = Instance_detail::where('sf_pv_id', $pvid)->whereNull('deleted_at')->get();
        return $value;
    }

}
