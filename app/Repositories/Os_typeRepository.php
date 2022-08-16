<?php

namespace App\Repositories;

use App\Models\Os_type;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Os_typeRepository
 *
 * @version February 18, 2019, 11:05 am UTC
 *
 * @method Os_type findWithoutFail($id, $columns = ['*'])
 * @method Os_type find($id, $columns = ['*'])
 * @method Os_type first($columns = ['*'])
 */
class Os_typeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'os_family',
        'os_short_name',
        'os_long_name',
        'os_patchset',
        'os_is_active',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Os_type::class;
    }
}
