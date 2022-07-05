<?php

namespace App\Repositories;

use App\Models\Ml_detail;
// use App\Repositories\BaseRepository;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Ml_detailRepository
 * @package App\Repositories
 * @version November 29, 2021, 10:54 am IST
 */

class Ml_detailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'server_details_id',
        'instance_details_id',
        'intellicus_details_id',
        'database_details_id',
        'ml_builds_id',
        'ml_name',
        'zeppelin_port',
        'zeppelin_user',
        'zeppelin_pwd',
        'installed_path',
        'notes'
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
        return Ml_detail::class;
    }
}
