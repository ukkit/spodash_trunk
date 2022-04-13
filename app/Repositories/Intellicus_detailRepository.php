<?php

namespace App\Repositories;

use App\Models\Intellicus_detail;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Intellicus_detailRepository
 * @package App\Repositories
 * @version August 30, 2020, 11:36 am IST
*/

class Intellicus_detailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'intellicus_name',
        'server_details_id',
        'database_details_id',
        'intellicus_port',
        'intellicus_login',
        'intellicus_pwd',
        'intellicus_version',
        'intellicus_patch',
        'intellicus_install_path',
        'intellicus_memory',
        'is_https',
        'jdk_type',
        'jdk_version',
        'is_active',
        'check_fail_count'
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
        return Intellicus_detail::class;
    }
}
