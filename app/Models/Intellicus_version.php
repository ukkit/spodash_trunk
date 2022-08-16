<?php

namespace App\Models;

use DB;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Intellicus_version extends Model
{
    use SoftDeletes;

    public $table = 'intellicus_versions';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'intellicus_version',
        'intellicus_patch',
        'release_date',
        'is_active',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'intellicus_version' => 'string',
        'intellicus_patch' => 'string',
        'release_date' => 'date',
        'is_active' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'intellicus_version' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function intellicusDetails()
    {
        return $this->hasMany(\App\Models\IntellicusDetail::class, 'intellicus_versions_id');
    }

    public function get_intellicus_details_by_id($id)
    {
        $value = DB::table('intellicus_details')->where('intellicus_versions_id', $id)->whereNull('deleted_at')->get();

        return $value;
    }

    // public function
}
