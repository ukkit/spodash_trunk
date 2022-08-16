<?php

namespace App\Http\Requests;

use App\Models\Release_milestone;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRelease_milestoneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // $rules = Release_milestone::$rules;

        $rules = [
            // 'id' => 'integer',
            'release_numbers_id' => 'required|integer',
            'release_start_date' => 'required|date',
            'release_end_date' => 'required|date|after:release_start_date',
            'baseline_start_date' => 'nullable|date|after:release_start_date|before:release_end_date',
            'baseline_end_date' => 'nullable|date|after_or_equal:baseline_start_date|before:release_end_date',
            'number_of_sprints' => 'nullable|boolean',
            'content_complete_start_date' => 'nullable|date|after:release_start_date|before:release_end_date',
            'content_complete_end_date' => 'nullable|date|after_or_equal:content_complete_start_date|before:release_end_date',
            'regressions_start_date' => 'nullable|date|after:release_start_date|before:release_end_date',
            'regressions_end_date' => 'nullable|date|after_or_equal:regressions_start_date|before:release_end_date',
            'enablement_delivery' => 'nullable|string|max:1',
            'enablement_delivery_start_date' => 'nullable|date|after:release_start_date|before:release_end_date',
            'enablement_delivery_end_date' => 'nullable|date|after_or_equal:enablement_delivery_start_date|before:release_end_date',
            'localization_review' => 'nullable|string|max:1',
            'localization_start_date' => 'nullable|date|after:release_start_date|before:release_end_date',
            'localization_end_date' => 'nullable|date|after_or_equal:localization_start_date|before:release_end_date',
            'run_security_scan' => 'nullable|string|max:1',
            'security_scan_start_date' => 'nullable|date|after:release_start_date|before:release_end_date',
            'security_scan_end_date' => 'nullable|date|after_or_equal:security_scan_start_date|before:release_end_date',
            'release_branch_creation_date' => 'nullable|date|after:release_start_date|before:release_end_date',
            'documentation_start_date' => 'nullable|date|after:release_start_date|before:release_end_date',
            'documentation_end_date' => 'nullable|date|after_or_equal:documentation_start_date|before:release_end_date',
            'code_freeze_date' => 'nullable|date|after:release_start_date|before:release_end_date',
            'release_candidate_date' => 'nullable|date|after:release_start_date|before:release_end_date',
            'final_qa_date' => 'nullable|date|after:release_start_date|before:release_end_date',
            'release_build_date' => 'nullable|date|after:release_start_date|before_or_equal:release_end_date',
            'has_pre_release' => 'nullable|string|max:1',
            'pre_release_1_date' => 'nullable|date|after:release_start_date|before:release_end_date',
            'has_pre_release_2' => 'nullable|string|max:1',
            'pre_release_2_date' => 'nullable|date|after_or_equal:pre_release_1_date|before:release_end_date',
            'has_pre_release_3' => 'nullable|string|max:1',
            'pre_release_3_date' => 'nullable|date|after_or_equal:pre_release_2_date|before:release_end_date',
            'has_pre_release_4' => 'nullable|string|max:1',
            'pre_release_4_date' => 'nullable|date|after_or_equal:pre_release_3_date|before:release_end_date',
            'released_date' => 'nullable|date|after_or_equal:release_end_date|before_or_equal:today',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'released_date.after_or_equal' => 'The Release Closure date can be on or after RTM target Date',
            'released_date.before_or_equal' => 'The Release Closure date can be on or before today\'s date.',
            'baseline_start_date.before' => 'The Baseline Start Date must be a date before or equal to RTM Target Date.',
            'baseline_end_date.before' => 'The Baseline End Date must be a date before or equal to RTM Target Date.',
            'content_complete_start_date.before' => 'The CCO Start Date must be a date before or equal to RTM Target Date.',
            'content_complete_end_date.before' => 'The CCO End Date must be a date before or equal to RTM Target Date.',
            'content_complete_end_date.after_or_equal' => 'The CCO End Date must be a date after or equal to CCO Start Date.',
            'regressions_start_date.before' => 'The Regression Testing Start Date must be a date before or equal to RTM Target Date.',
            'regressions_end_date.before' => 'The Regression Testing End Date must be a date before or equal to RTM Target Date.',
            'regressions_end_date.after_or_equal' => 'The Regression Testing End Date must be a date after or equal to Regression Testing End Date.',
            'enablement_delivery_start_date.before' => 'The Enablement Delivery Start Date must be a date before or equal to RTM Target Date.',
            'enablement_delivery_end_date.before' => 'The Enablement Delivery End Date must be a date before or equal to RTM Target Date.',
            'localization_start_date.before' => 'The Localization Testing Start Date must be a date before or equal to RTM Target Date.',
            'localization_end_date.before' => 'The Localization Testing End Date must be a date before or equal to RTM Target Date.',
            'localization_end_date.after_or_equal' => 'The Localization Testing End Date must be a date after or equal to Localization Testing Start Date.',
            'security_scan_start_date.before' => 'The Security Scan Start Date must be a date before or equal to RTM Target Date.',
            'security_scan_end_date.before' => 'The Security Scan Testing End Date must be a date before or equal to RTM Target Date.',
            'release_branch_creation_date.before' => 'The Release Branch Creation Date must be a date before or equal to RTM Target Date.',
            'code_freeze_date.before' => 'The Code Freeze Date must be a date before or equal to RTM Target Date.',
            'release_candidate_date.before' => 'The Release Candidate Build Date must be a date before or equal to RTM Target Date.',
            'final_qa_date.before' => 'The Final QA Date must be a date before or equal to RTM Target Date.',
            'release_build_date.before' => 'The Release Build & Verification Date must be a date before or equal to RTM Target Date.',
        ];
    }
}
