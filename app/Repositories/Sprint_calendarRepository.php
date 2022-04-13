<?php

namespace App\Repositories;

use App\Models\Sprint_calendar;
// use App\Repositories\BaseRepository;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Sprint_calendarRepository
 * @package App\Repositories
 * @version April 16, 2020, 2:04 pm IST
*/

class Sprint_calendarRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'sprint_number',
        'sprint_start_date',
        'sprint_end_date',
        'sprint_end_date_same_as_next_start_date'
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
        return Sprint_calendar::class;
    }
}
