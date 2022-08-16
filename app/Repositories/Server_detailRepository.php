<?php

namespace App\Repositories;

use App\Models\Server_detail;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Server_detailRepository
 *
 * @version February 19, 2019, 11:38 am UTC
 *
 * @method Server_detail findWithoutFail($id, $columns = ['*'])
 * @method Server_detail find($id, $columns = ['*'])
 * @method Server_detail first($columns = ['*'])
 */
class Server_detailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'os_types_id',
        'database_types_id',
        'server_uses_id',
        'server_name',
        'server_ip',
        'server_class',
        'server_location',
        'server_ram_gb',
        'server_hdd_gb',
        'server_cpu_cores',
        'server_user',
        'server_password',
        'admin_user',
        'admin_password',
        'server_is_active',
        'server_show_on_site',
        'server_owner',
        'server_note',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Server_detail::class;
    }
}
