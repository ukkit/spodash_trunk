<?php

namespace App\Repositories;

use App\Models\Product_name;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Product_nameRepository
 *
 * @version January 24, 2019, 8:20 am UTC
 *
 * @method Product_name findWithoutFail($id, $columns = ['*'])
 * @method Product_name find($id, $columns = ['*'])
 * @method Product_name first($columns = ['*'])
 */
class Product_nameRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_short_name',
        'product_long_name',
        'product_is_active',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Product_name::class;
    }
}
