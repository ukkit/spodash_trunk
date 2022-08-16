<?php

use App\Models\Instance_detail;
use App\Repositories\Instance_detailRepository;
use Faker\Factory as Faker;

trait MakeInstance_detailTrait
{
    /**
     * Create fake instance of Instance_detail and save it in database
     *
     * @param  array  $instanceDetailFields
     * @return Instance_detail
     */
    public function makeInstance_detail($instanceDetailFields = [])
    {
        /** @var Instance_detailRepository $instanceDetailRepo */
        $instanceDetailRepo = App::make(Instance_detailRepository::class);
        $theme = $this->fakeInstance_detailData($instanceDetailFields);

        return $instanceDetailRepo->create($theme);
    }

    /**
     * Get fake instance of Instance_detail
     *
     * @param  array  $instanceDetailFields
     * @return Instance_detail
     */
    public function fakeInstance_detail($instanceDetailFields = [])
    {
        return new Instance_detail($this->fakeInstance_detailData($instanceDetailFields));
    }

    /**
     * Get fake data of Instance_detail
     *
     * @param  array  $postFields
     * @return array
     */
    public function fakeInstance_detailData($instanceDetailFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'server_details_id' => $fake->randomDigitNotNull,
            'product_names_id' => $fake->randomDigitNotNull,
            'product_versions_id' => $fake->randomDigitNotNull,
            'database_details_id' => $fake->randomDigitNotNull,
            'instance_name' => $fake->word,
            'instance_tomcat_port' => $fake->randomDigitNotNull,
            'instance_login' => $fake->word,
            'instance_pwd' => $fake->word,
            'instance_is_auto_upgraded' => $fake->word,
            'instance_is_active' => $fake->word,
            'instance_show_on_site' => $fake->word,
            'instance_status' => $fake->word,
            'instance_owner' => $fake->word,
            'instance_note' => $fake->text,
            'instance_install_path' => $fake->word,
            'instance_shared_dir' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
        ], $instanceDetailFields);
    }
}
