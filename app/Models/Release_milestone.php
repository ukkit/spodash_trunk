<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\Models\Sprint_calendar;
use Carbon\Carbon;

class Release_milestone extends Model
{
    use SoftDeletes;

    public $table = 'release_milestones';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
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
        'webinspect_scan_comments'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'release_numbers_id' => 'integer',
        'release_start_date' => 'date',
        'release_end_date' => 'date',
        'baseline_start_date' => 'date',
        'baseline_end_date' => 'date',
        'number_of_sprints' => 'boolean',
        'content_complete_start_date' => 'date',
        'content_complete_end_date' => 'date',
        'regressions_start_date' => 'date',
        'regressions_end_date' => 'date',
        'enablement_delivery' => 'string',
        'enablement_delivery_start_date' => 'date',
        'enablement_delivery_end_date' => 'date',
        'localization_review' => 'string',
        'localization_start_date' => 'date',
        'localization_end_date' => 'date',
        'run_security_scan' => 'string',
        'security_scan_start_date' => 'date',
        'security_scan_end_date' => 'date',
        'release_branch_creation_date' => 'date',
        'documentation_start_date' => 'date',
        'documentation_end_date' => 'date',
        'code_freeze_date' => 'date',
        'release_candidate_date' => 'date',
        'final_qa_date' => 'date',
        'release_build_date' => 'date',
        'has_pre_release' => 'string',
        'pre_release_1_date' => 'date',
        'has_pre_release_2' => 'string',
        'pre_release_2_date' => 'date',
        'has_pre_release_3' => 'string',
        'pre_release_3_date' => 'date',
        'has_pre_release_4' => 'string',
        'pre_release_4_date' => 'date',
        'milestone_notes' => 'string',
        'released_date' => 'date',
        'baseline_comments' => 'string',
        'content_complete_comments' => 'string',
        'regressions_comments' => 'string',
        'enablement_delivery_comments' => 'string',
        'localization_comments' => 'string',
        'security_scan_comments' => 'string',
        'release_branch_creation_comments' => 'string',
        'documentation_comments' => 'string',
        'code_freeze_comments' => 'string',
        'release_candidate_comments' => 'string',
        'final_qa_comments' => 'string',
        'release_build_comments' => 'string',
        'pre_release_1_comments' => 'string',
        'pre_release_2_comments' => 'string',
        'pre_release_3_comments' => 'string',
        'pre_release_4_comments' => 'string',
        'contrast_scan_start_date' => 'date',
        'contrast_scan_end_date' => 'date',
        'contrast_scan_comments' => 'string',
        'owasp_scan_start_date' => 'date',
        'owasp_scan_end_date' => 'date',
        'owasp_scan_comments' => 'string',
        'webinspect_scan_start_date' => 'date',
        'webinspect_scan_end_date' => 'date',
        'webinspect_scan_comments' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'release_numbers_id' => 'required',
        'release_start_date' => 'required',
        'release_end_date' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function releaseNumbers()
    {
        return $this->belongsTo(\App\Models\ReleaseNumber::class, 'release_numbers_id');
    }

    // public function return_db_details($id, $return_what)
    // {
    // $value = DB::table('database_details')->where('database_details.id', $id)
    //             ->join('database_types', 'database_details.database_types_id', '=', 'database_types.id')
    //             ->select('database_types.*')
    //             ->get();
    //     return ($value->pluck($return_what));
    // }

    public static function product_name_by_id ($id, $what)
    {
        $value = DB::table('release_numbers')->where('release_numbers.id', $id)
                ->join('product_names', 'product_names.id', '=', 'release_numbers.product_names_id')
                ->select('product_names.*')
                ->get();

        // return $value;
        // dd($value);
        return ($value->pluck($what));
    }
    public function release_number_by_id ($id)
    {
        $value = DB::table('release_numbers')
                ->where('id',$id)
                ->first();

        return $value;
    }

    public function sprint_by_date ($date)
    {
        $list = Sprint_calendar::all();
        $date = (Carbon::parse($date)->toDateString());
        $start = null;
        $end = null;

        foreach($list as $li) {
            $li_date = Carbon::parse($li->sprint_start_date)->toDateString();
            if ($li_date >= $date) {
                return $li->sprint_number;
            }
        }
    }

    public function sprint_details_by_number ($sprint)
    {
        $list = Sprint_calendar::all();

        foreach($list as $li) {
            if ($li->sprint_number == $sprint) {
                return $li;
            }
        }
    }

}
