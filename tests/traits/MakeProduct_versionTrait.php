<?php

use App\Models\Product_version;
use App\Repositories\Product_versionRepository;
use Faker\Factory as Faker;

trait MakeProduct_versionTrait
{
    /**
     * Create fake instance of Product_version and save it in database
     *
     * @param  array  $productVersionFields
     * @return Product_version
     */
    public function makeProduct_version($productVersionFields = [])
    {
        /** @var Product_versionRepository $productVersionRepo */
        $productVersionRepo = App::make(Product_versionRepository::class);
        $theme = $this->fakeProduct_versionData($productVersionFields);

        return $productVersionRepo->create($theme);
    }

    /**
     * Get fake instance of Product_version
     *
     * @param  array  $productVersionFields
     * @return Product_version
     */
    public function fakeProduct_version($productVersionFields = [])
    {
        return new Product_version($this->fakeProduct_versionData($productVersionFields));
    }

    /**
     * Get fake data of Product_version
     *
     * @param  array  $postFields
     * @return array
     */
    public function fakeProduct_versionData($productVersionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'product_ver_number' => $fake->word,
            'product_build_numer' => $fake->randomDigitNotNull,
            'pv_id' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
        ], $productVersionFields);
    }
}
