<?php

namespace App\Repositories;

use App\Models\Action_history;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Action_historyRepository
 * @package App\Repositories
 * @version August 3, 2019, 12:01 pm UTC
*/

class Action_historyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'unique_id',
        'users_id',
        'instance_details_id',
        'jenkins_build_id',
        'action',
        'start_time',
        'end_time',
        'status'
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
        return Action_history::class;
    }
}
