<?php

namespace App\Repositories;

use App\Models\Server_use;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Server_useRepository
 *
 * @version January 25, 2019, 1:20 pm UTC
 *
 * @method Server_use findWithoutFail($id, $columns = ['*'])
 * @method Server_use find($id, $columns = ['*'])
 * @method Server_use first($columns = ['*'])
 */
class Server_useRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'server_details_id',
        'use_short_name',
        'use_long_name',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Server_use::class;
    }
}
