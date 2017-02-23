<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PatientList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_list', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room');
            $table->string('patient_name', 50);
            $table->string('bed_name', 200);
            $table->string('monitored_bed', 200);
            $table->string('side_room', 50);
            $table->date('admit_dttm');
            $table->date('ed_dttm');
            $table->date('medfit_dttm');
            $table->integer('patient_hosp_id');
            $table->string('ip_spell_id', 200);
            $table->date('disch_dttm')->nullable();
            $table->string('curr_spec_desc', 200);
            $table->string('curr_bay_desc', 200);
            $table->string('curr_bed_desc', 200);
            $table->date('ward_start_dttm');
            $table->integer('ward_stay');
            $table->string('disch_delay_rsn_desc', 200);
            $table->integer('hfq_proforma_ext_id');
            $table->string('proforma_type', 200);
            $table->string('proforma_name', 200);
            $table->date('proforma_dttm');
            $table->date('news');
            $table->date('date_time');
            $table->string('actual_ward_pending', 200);
            $table->string('preferred_ward', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('patient_list');
    }
}
