<?php

use Faker\Factory as Faker;
use App\Models\Database_type;
use App\Repositories\Database_typeRepository;

trait MakeDatabase_typeTrait
{
    /**
     * Create fake instance of Database_type and save it in database
     *
     * @param array $databaseTypeFields
     * @return Database_type
     */
    public function makeDatabase_type($databaseTypeFields = [])
    {
        /** @var Database_typeRepository $databaseTypeRepo */
        $databaseTypeRepo = App::make(Database_typeRepository::class);
        $theme = $this->fakeDatabase_typeData($databaseTypeFields);
        return $databaseTypeRepo->create($theme);
    }

    /**
     * Get fake instance of Database_type
     *
     * @param array $databaseTypeFields
     * @return Database_type
     */
    public function fakeDatabase_type($databaseTypeFields = [])
    {
        return new Database_type($this->fakeDatabase_typeData($databaseTypeFields));
    }

    /**
     * Get fake data of Database_type
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDatabase_typeData($databaseTypeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'db_short_name' => $fake->word,
            'db_long_name' => $fake->word,
            'db_patchset' => $fake->word,
            'db_is_active' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $databaseTypeFields);
    }
}
