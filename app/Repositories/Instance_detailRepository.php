<?php

namespace App\Repositories;

use App\Models\Instance_detail;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Instance_detailRepository
 * @package App\Repositories
 * @version February 19, 2019, 1:24 pm UTC
 *
 * @method Instance_detail findWithoutFail($id, $columns = ['*'])
 * @method Instance_detail find($id, $columns = ['*'])
 * @method Instance_detail first($columns = ['*'])
*/
class Instance_detailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'server_details_id',
        'product_names_id',
        'product_versions_id',
        'database_details_id',
        'intellicus_details_id',
        'pai_details_id',
        'ml_details_id',
        'pv_id',
        'pai_pv_id',
        'sf_pv_id',
        'instance_name',
        'instance_tomcat_port',
        'instance_ap_port',
        'instance_web_port',
        'instance_login',
        'instance_pwd',
        'show_instance_login',
        'enable_instance_auto_login',
        'jenkins_url',
        'jenkins_uname',
        'jenkins_pwd',
        'jenkins_token',
        'instance_is_auto_upgraded',
        'instance_is_active',
        'instance_show_on_site',
        'is_https',
        'running_jenkins_job',
        'show_jenkins_build',
        'instance_status',
        'db_backup_enabled',
        'instance_owner',
        'instance_note',
        'instance_install_path',
        'instance_shared_dir',
        'instance_jira',
        'tomcat_service_name',
        'ap_service_name',
        'instance_web_min_heap_size',
        'instance_web_max_heap_size',
        'instance_ap_min_heap_size',
        'instance_ap_max_heap_size',
        'jdk_type',
        'jdk_version',
		'qa_intentionally_disabled',
        'in_use',
        'in_use_msg',
        'webserver_version',
        'is_insight_enabled',
        'is_contrast_configured',
        'snowflake_configured',
        'check_fail_count'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Instance_detail::class;
    }
}
