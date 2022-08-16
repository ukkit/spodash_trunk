<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pai_build extends Model
{
    use SoftDeletes;

    public $table = 'pai_builds';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'pai_version',
        'pai_build',
        'pv_id',
        'is_release_build',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pai_version' => 'string',
        'pai_build' => 'integer',
        'pv_id' => 'string',
        'is_release_build' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'pai_version' => 'required',
        'pai_build' => 'required',
        'pv_id' => 'required',
        'is_release_build' => 'required',
    ];

    public function actionHistories()
    {
        return $this->hasMany(\App\Models\ActionHistory::class, 'new_pai_build_id');
    }

    public function actionHistory1s()
    {
        return $this->hasMany(\App\Models\ActionHistory::class, 'old_pai_build_id');
    }

    public function instance_list_by_pvid($pvid)
    {
        $value = Instance_detail::where('pai_pv_id', $pvid)->whereNull('deleted_at')->get();

        return $value;
    }

    public function instance_list_by_pai_pvid($pvid)
    {
        $value = Instance_detail::where('pai_pv_id', $pvid)->whereNull('deleted_at')->get();

        return $value;
    }

    public function product_names_by_id($id)
    {
        return Product_name::where('id', $id)->first();
    }
}
