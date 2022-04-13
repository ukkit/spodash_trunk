<?php

namespace App\Repositories;

use App\Models\Tablespace_detail;
use InfyOm\Generator\Common\BaseRepository;

// use App\Repositories\BaseRepository;

/**
 * Class Tablespace_detailRepository
 * @package App\Repositories
 * @version February 10, 2021, 4:35 pm IST
*/

class Tablespace_detailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'database_details_id',
        'pai_details_id',
        'tablespace_name',
        'used_space',
        'free_space',
        'total_space'
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
        return Tablespace_detail::class;
    }
}
