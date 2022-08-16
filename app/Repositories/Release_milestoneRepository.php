<?php

namespace App\Repositories;

use App\Models\Release_milestone;
// use App\Repositories\BaseRepository;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Release_milestoneRepository
 *
 * @version April 24, 2020, 12:20 pm IST
 */
class Release_milestoneRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'release_numbers_id',
        'release_start_date',
        'release_end_date',
        'baseline_start_date',
        'baseline_end_date',
        'number_of_sprints',
        'content_complete_start_date',
        'content_complete_end_date',
        'regressions_start_date',
        'regressions_end_date',
        'enablement_delivery',
        'enablement_delivery_start_date',
        'enablement_delivery_end_date',
        'localization_review',
        'localization_start_date',
        'localization_end_date',
        'run_security_scan',
        'security_scan_start_date',
        'security_scan_end_date',
        'release_branch_creation_date',
        'documentation_start_date',
        'documentation_end_date',
        'code_freeze_date',
        'release_candidate_date',
        'final_qa_date',
        'release_build_date',
        'has_pre_release',
        'pre_release_1_date',
        'has_pre_release_2',
        'pre_release_2_date',
        'has_pre_release_3',
        'pre_release_3_date',
        'has_pre_release_4',
        'pre_release_4_date',
        'milestone_notes',
        'released_date',
        'baseline_comments',
        'content_complete_comments',
        'regressions_comments',
        'enablement_delivery_comments',
        'localization_comments',
        'security_scan_comments',
        'release_branch_creation_comments',
        'documentation_comments',
        'code_freeze_comments',
        'release_candidate_comments',
        'final_qa_comments',
        'release_build_comments',
        'pre_release_1_comments',
        'pre_release_2_comments',
        'pre_release_3_comments',
        'pre_release_4_comments',
        'contrast_scan_start_date',
        'contrast_scan_end_date',
        'contrast_scan_comments',
        'owasp_scan_start_date',
        'owasp_scan_end_date',
        'owasp_scan_comments',
        'webinspect_scan_start_date',
        'webinspect_scan_end_date',
        'webinspect_scan_comments',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Release_milestone::class;
    }
}
