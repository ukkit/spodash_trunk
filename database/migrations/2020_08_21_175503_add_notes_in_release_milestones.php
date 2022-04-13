<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotesInReleaseMilestones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('release_milestones', function (Blueprint $table) {
            $table->mediumText('baseline_comments')->after('baseline_end_date')->nullable();
            $table->mediumText('content_complete_comments')->after('content_complete_end_date')->nullable();
            $table->mediumText('regressions_comments')->after('regressions_end_date')->nullable();
            $table->mediumText('enablement_delivery_comments')->after('enablement_delivery_end_date')->nullable();
            $table->mediumText('localization_comments')->after('localization_end_date')->nullable();
            $table->mediumText('security_scan_comments')->after('security_scan_end_date')->nullable();
            $table->mediumText('release_branch_creation_comments')->after('release_branch_creation_date')->nullable();
            $table->mediumText('documentation_comments')->after('documentation_end_date')->nullable();
            $table->mediumText('code_freeze_comments')->after('code_freeze_date')->nullable();
            $table->mediumText('release_candidate_comments')->after('release_candidate_date')->nullable();
            $table->mediumText('final_qa_comments')->after('final_qa_date')->nullable();
            $table->mediumText('release_build_comments')->after('release_build_date')->nullable();
            $table->mediumText('pre_release_1_comments')->after('pre_release_1_date')->nullable();
            $table->mediumText('pre_release_2_comments')->after('pre_release_2_date')->nullable();
            $table->mediumText('pre_release_3_comments')->after('pre_release_3_date')->nullable();
            $table->mediumText('pre_release_4_comments')->after('pre_release_4_date')->nullable();
            $table->date('contrast_scan_start_date')->after('security_scan_comments')->nullable();
            $table->date('contrast_scan_end_date')->after('contrast_scan_start_date')->nullable();
            $table->mediumText('contrast_scan_comments')->after('contrast_scan_end_date')->nullable();
            $table->date('owasp_scan_start_date')->after('contrast_scan_comments')->nullable();
            $table->date('owasp_scan_end_date')->after('owasp_scan_start_date')->nullable();
            $table->mediumText('owasp_scan_comments')->after('owasp_scan_end_date')->nullable();
            $table->date('webinspect_scan_start_date')->after('owasp_scan_comments')->nullable();
            $table->date('webinspect_scan_end_date')->after('webinspect_scan_start_date')->nullable();
            $table->mediumText('webinspect_scan_comments')->after('webinspect_scan_end_date')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('release_milestones', function (Blueprint $table) {
            $table->dropColumn('baseline_comments');
            $table->dropColumn('content_complete_comments');
            $table->dropColumn('regressions_comments');
            $table->dropColumn('enablement_delivery_comments');
            $table->dropColumn('localization_comments');
            $table->dropColumn('security_scan_comments');
            $table->dropColumn('release_branch_creation_comments');
            $table->dropColumn('documentation_comments');
            $table->dropColumn('code_freeze_comments');
            $table->dropColumn('release_candidate_comments');
            $table->dropColumn('final_qa_comments');
            $table->dropColumn('release_build_comments');
            $table->dropColumn('pre_release_1_comments');
            $table->dropColumn('pre_release_2_comments');
            $table->dropColumn('pre_release_3_comments');
            $table->dropColumn('pre_release_4_comments');
            $table->dropColumn('contrast_scan_start_date');
            $table->dropColumn('contrast_scan_end_date');
            $table->dropColumn('contrast_scan_comments');
            $table->dropColumn('owasp_scan_start_date');
            $table->dropColumn('owasp_scan_end_date');
            $table->dropColumn('owasp_scan_comments');
            $table->dropColumn('webinspect_scan_start_date');
            $table->dropColumn('webinspect_scan_end_date');
            $table->dropColumn('webinspect_scan_comments');
        });
    }
}
