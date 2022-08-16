<?php

namespace App\Repositories;

use App\Models\Database_type;
use DB;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Database_typeRepository
 *
 * @version February 18, 2019, 10:54 am UTC
 *
 * @method Database_type findWithoutFail($id, $columns = ['*'])
 * @method Database_type find($id, $columns = ['*'])
 * @method Database_type first($columns = ['*'])
 */
class Database_typeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'db_short_name',
        'db_long_name',
        'db_patchset',
        'db_is_active',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Database_type::class;
        // return Database_type::select('db_short_name', 'db_long_name')->get();
    }
}
