<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReleaseMilestonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('release_milestones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('release_numbers_id');
            $table->date('release_start_date');
            $table->date('release_end_date'); //RTM Target Date
            $table->date('baseline_start_date')->nullable();
            $table->date('baseline_end_date')->nullable();
            $table->tinyInteger('number_of_sprints')->nullable();
            $table->date('content_complete_start_date')->nullable();
            $table->date('content_complete_end_date')->nullable();
            $table->date('regressions_start_date')->nullable();
            $table->date('regressions_end_date')->nullable();
            $table->char('enablement_delivery',1)->nullable()->default('Y');
            $table->date('enablement_delivery_start_date')->nullable();
            $table->date('enablement_delivery_end_date')->nullable();
            $table->char('localization_review',1)->nullable()->default('Y');
            $table->date('localization_start_date')->nullable();
            $table->date('localization_end_date')->nullable();
            $table->char('run_security_scan',1)->nullable()->default('Y');
            $table->date('security_scan_start_date')->nullable();
            $table->date('security_scan_end_date')->nullable();
            $table->date('release_branch_creation_date')->nullable();
            $table->date('documentation_start_date')->nullable();
            $table->date('documentation_end_date')->nullable();
            $table->date('code_freeze_date')->nullable();
            $table->date('release_candidate_date')->nullable(); //Release Candidate Build Date
            $table->date('final_qa_date')->nullable();
            $table->date('release_build_date')->nullable(); //Release Build and Verification Date
            $table->char('has_pre_release',1)->nullable()->default('N');
            $table->date('pre_release_1_date')->nullable();
            $table->char('has_pre_release_2',1)->nullable()->default('N');
            $table->date('pre_release_2_date')->nullable();
            $table->char('has_pre_release_3',1)->nullable()->default('N');
            $table->date('pre_release_3_date')->nullable();
            $table->char('has_pre_release_4',1)->nullable()->default('N');
            $table->date('pre_release_4_date')->nullable();
            $table->longText('milestone_notes')->nullable();
            $table->date('released_date')->nullable(); //Date on which release was made
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('release_numbers_id')->references('id')->on('release_numbers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('release_milestones');
    }
}
