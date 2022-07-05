<?php

namespace App\Repositories;

use App\Models\Ml_build;
use InfyOm\Generator\Common\BaseRepository;
// use App\Repositories\BaseRepository;

/**
 * Class Ml_buildRepository
 * @package App\Repositories
 * @version June 6, 2022, 12:09 pm IST
 */

class Ml_buildRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ml_version',
        'ml_build',
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
        return Ml_build::class;
    }
}
