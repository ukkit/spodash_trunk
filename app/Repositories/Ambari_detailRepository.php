<?php

namespace App\Repositories;

use App\Models\Ambari_detail;
// use App\Repositories\BaseRepository;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Ambari_detailRepository
 * @package App\Repositories
 * @version September 22, 2020, 12:30 pm IST
*/

class Ambari_detailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ambari_name',
        'ambari_url',
        'ambari_user',
        'ambari_pwd'
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
        return Ambari_detail::class;
    }
}
