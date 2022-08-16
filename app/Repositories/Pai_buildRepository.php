<?php

namespace App\Repositories;

use App\Models\Pai_build;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Pai_buildRepository
 *
 * @version March 2, 2022, 6:55 pm IST
 */
class Pai_buildRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pai_version',
        'pai_build',
        'pv_id',
        'is_release_build',
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
        return Pai_build::class;
    }
}
