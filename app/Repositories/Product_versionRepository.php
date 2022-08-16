<?php

namespace App\Repositories;

use App\Models\Product_version;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Product_versionRepository
 *
 * @version February 18, 2019, 1:47 pm UTC
 *
 * @method Product_version findWithoutFail($id, $columns = ['*'])
 * @method Product_version find($id, $columns = ['*'])
 * @method Product_version first($columns = ['*'])
 */
class Product_versionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_ver_number',
        'product_build_numer',
        'pv_id',
        'is_release_build',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Product_version::class;
    }
}
