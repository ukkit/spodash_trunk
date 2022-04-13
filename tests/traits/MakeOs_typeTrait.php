<?php

use Faker\Factory as Faker;
use App\Models\Os_type;
use App\Repositories\Os_typeRepository;

trait MakeOs_typeTrait
{
    /**
     * Create fake instance of Os_type and save it in database
     *
     * @param array $osTypeFields
     * @return Os_type
     */
    public function makeOs_type($osTypeFields = [])
    {
        /** @var Os_typeRepository $osTypeRepo */
        $osTypeRepo = App::make(Os_typeRepository::class);
        $theme = $this->fakeOs_typeData($osTypeFields);
        return $osTypeRepo->create($theme);
    }

    /**
     * Get fake instance of Os_type
     *
     * @param array $osTypeFields
     * @return Os_type
     */
    public function fakeOs_type($osTypeFields = [])
    {
        return new Os_type($this->fakeOs_typeData($osTypeFields));
    }

    /**
     * Get fake data of Os_type
     *
     * @param array $postFields
     * @return array
     */
    public function fakeOs_typeData($osTypeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'os_short_name' => $fake->word,
            'os_long_name' => $fake->word,
            'os_patchset' => $fake->word,
            'os_is_active' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $osTypeFields);
    }
}
