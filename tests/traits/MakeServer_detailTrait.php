<?php

use Faker\Factory as Faker;
use App\Models\Server_detail;
use App\Repositories\Server_detailRepository;

trait MakeServer_detailTrait
{
    /**
     * Create fake instance of Server_detail and save it in database
     *
     * @param array $serverDetailFields
     * @return Server_detail
     */
    public function makeServer_detail($serverDetailFields = [])
    {
        /** @var Server_detailRepository $serverDetailRepo */
        $serverDetailRepo = App::make(Server_detailRepository::class);
        $theme = $this->fakeServer_detailData($serverDetailFields);
        return $serverDetailRepo->create($theme);
    }

    /**
     * Get fake instance of Server_detail
     *
     * @param array $serverDetailFields
     * @return Server_detail
     */
    public function fakeServer_detail($serverDetailFields = [])
    {
        return new Server_detail($this->fakeServer_detailData($serverDetailFields));
    }

    /**
     * Get fake data of Server_detail
     *
     * @param array $postFields
     * @return array
     */
    public function fakeServer_detailData($serverDetailFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'os_types_id' => $fake->randomDigitNotNull,
            'database_types_id' => $fake->randomDigitNotNull,
            'server_uses_id' => $fake->randomDigitNotNull,
            'server_name' => $fake->word,
            'server_ip' => $fake->word,
            'server_class' => $fake->word,
            'server_location' => $fake->word,
            'server_ram_gb' => $fake->randomDigitNotNull,
            'server_hdd_gb' => $fake->randomDigitNotNull,
            'server_cpu_cores' => $fake->randomDigitNotNull,
            'server_is_active' => $fake->word,
            'server_show_on_site' => $fake->word,
            'server_owner' => $fake->word,
            'server_note' => $fake->text,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $serverDetailFields);
    }
}
