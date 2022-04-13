<?php

namespace App\Repositories;

use App\Models\Sf_build;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Sf_buildRepository
 * @package App\Repositories
 * @version March 2, 2022, 6:56 pm IST
*/

class Sf_buildRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'sf_pai_version',
        'sf_pai_build',
        'pv_id',
        'is_release_build'
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
        return Sf_build::class;
    }
}
