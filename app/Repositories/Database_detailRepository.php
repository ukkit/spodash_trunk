<?php

namespace App\Repositories;

use App\Models\Database_detail;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Database_detailRepository
 *
 * @version February 19, 2019, 9:24 am UTC
 *
 * @method Database_detail findWithoutFail($id, $columns = ['*'])
 * @method Database_detail find($id, $columns = ['*'])
 * @method Database_detail first($columns = ['*'])
 */
class Database_detailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'server_details_id',
        'database_types_id',
        'db_sid',
        'db_user',
        'db_pass',
        'db_port',
        'jira_number',
        'db_notes',
        'db_is_active',
        'is_dba',
        'repository_type',
        // 'is_intellicus_repository'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Database_detail::class;
    }
}
