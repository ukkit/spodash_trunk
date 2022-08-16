<?php

use App\Models\Database_detail;
use App\Repositories\Database_detailRepository;
use Faker\Factory as Faker;

trait MakeDatabase_detailTrait
{
    /**
     * Create fake instance of Database_detail and save it in database
     *
     * @param  array  $databaseDetailFields
     * @return Database_detail
     */
    public function makeDatabase_detail($databaseDetailFields = [])
    {
        /** @var Database_detailRepository $databaseDetailRepo */
        $databaseDetailRepo = App::make(Database_detailRepository::class);
        $theme = $this->fakeDatabase_detailData($databaseDetailFields);

        return $databaseDetailRepo->create($theme);
    }

    /**
     * Get fake instance of Database_detail
     *
     * @param  array  $databaseDetailFields
     * @return Database_detail
     */
    public function fakeDatabase_detail($databaseDetailFields = [])
    {
        return new Database_detail($this->fakeDatabase_detailData($databaseDetailFields));
    }

    /**
     * Get fake data of Database_detail
     *
     * @param  array  $postFields
     * @return array
     */
    public function fakeDatabase_detailData($databaseDetailFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'server_details_id' => $fake->randomDigitNotNull,
            'database_types_id' => $fake->randomDigitNotNull,
            'db_sid' => $fake->word,
            'db_user' => $fake->word,
            'db_pass' => $fake->word,
            'db_port' => $fake->randomDigitNotNull,
            'db_notes' => $fake->text,
            'db_is_active' => $fake->word,
            'is_dba' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
        ], $databaseDetailFields);
    }
}
