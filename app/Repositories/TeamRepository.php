<?php

namespace App\Repositories;

use App\Models\Team;
#use App\Repositories\BaseRepository;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TeamRepository
 * @package App\Repositories
 * @version February 25, 2020, 12:50 pm IST
*/

class TeamRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'team_name',
        'team_email'
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
        return Team::class;
    }
}
