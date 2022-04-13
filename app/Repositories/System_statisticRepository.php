<?php

namespace App\Repositories;

use App\Models\System_statistic;
// use App\Repositories\BaseRepository;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class System_statisticRepository
 * @package App\Repositories
 * @version January 14, 2021, 11:16 am IST
*/

class System_statisticRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'total_instance_details',
        'active_instance_details',
        'deleted_instance_details',
        'auto_upgrade_enabled_instances',
        'total_server_details',
        'active_server_details',
        'deleted_server_details',
        'total_database_details',
        'active_database_details',
        'deleted_database_details',
        'total_intellicus_details',
        'deleted_intellicus_details',
        'total_pai_details',
        'deleted_pai_details',
        'total_product_versions',
        'deleted_product_versions',
        'total_release_builds',
        'total_users',
        'total_teams',
        'deleted_teams',
        'total_action_histories',
        'deleted_action_histories',
        'total_intellicus_versions',
        'deleted_intellicus_versions',
        'avengers_instances',
        'dragons_instances',
        'jl_instances',
        'seekers_instances',
        'guardians_instances',
        'transformers_instances',
        'pm_instances',
        'incredibles_instances'
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
        return System_statistic::class;
    }
}
