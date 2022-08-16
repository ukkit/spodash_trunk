<?php

namespace App\Repositories;

use App\Models\Dba_detail;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Dba_detailRepository
 *
 * @version May 27, 2021, 10:42 am IST
 */
class Dba_detailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'server_details_id',
        'dba_user',
        'dba_password',
        'db_sid',
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
        return Dba_detail::class;
    }
}
