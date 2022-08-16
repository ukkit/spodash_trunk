<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product_version extends Model
{
    use SoftDeletes;

    public $table = 'product_versions';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'product_ver_number',
        'product_build_numer',
        'pv_id',
        'is_release_build',
    ];

    protected $casts = [
        'id' => 'integer',
        'product_ver_number' => 'string',
        'product_build_numer' => 'integer',
        'pv_id' => 'string',
        'is_release_build' => 'string',
    ];

    public static $rules = [

    ];

    public function instanceDetails()
    {
        return $this->hasMany(\App\Models\InstanceDetail::class);
    }

    public function product_names()
    {
        return $this->belongsTo(\App\Models\Product_name::class);
    }

    public function instance_detail()
    {
        return $this->hasMany(\App\Models\Instance_detail::class);
    }

    public function instance_list_by_pvid($pvid)
    {
        $value = Instance_detail::where('pv_id', $pvid)->whereNull('deleted_at')->get();

        return $value;
    }

    public function product_names_by_id($id)
    {
        return Product_name::where('id', $id)->first();
    }
}
