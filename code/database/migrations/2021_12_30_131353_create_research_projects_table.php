<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearchProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_projects', function (Blueprint $table) {
            $table->id();
            $table->string('Project_name_TH');
            $table->string('Project_name_EN');
            $table->date('Project_start')->nullable();
            $table->date('Project_end')->nullable();
            $table->string('Funder')->nullable();
            $table->integer('Budget')->nullable();
            $table->longText('Note')->nullable();
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
        Schema::dropIfExists('research_prejects');
    }
}
