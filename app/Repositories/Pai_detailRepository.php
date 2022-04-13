<?php

namespace App\Repositories;

use App\Models\Pai_detail;
use InfyOm\Generator\Common\BaseRepository;
// use App\Repositories\BaseRepository;

/**
 * Class Pai_detailRepository
 * @package App\Repositories
 * @version September 22, 2020, 2:32 pm IST
*/

class Pai_detailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'server_details_id',
        'ambari_details_id',
        'pai_type',
        'pai_user',
        'pai_pwd',
        'pai_db',
        'pai_port'
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
        return Pai_detail::class;
    }
}
