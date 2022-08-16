<?php

namespace App\Repositories;

use App\Models\Intellicus_version;
use InfyOm\Generator\Common\BaseRepository;

// use App\Repositories\BaseRepository;

/**
 * Class Intellicus_versionRepository
 *
 * @version September 1, 2020, 10:49 am IST
 */
class Intellicus_versionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'intellicus_version',
        'intellicus_patch',
        'release_date',
        'is_active',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Intellicus_version::class;
    }
}
