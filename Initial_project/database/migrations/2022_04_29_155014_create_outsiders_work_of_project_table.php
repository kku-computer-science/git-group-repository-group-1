<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutsidersWorkOfProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outsiders_work_of_project', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('outsider_id');
            $table->unsignedBigInteger('research_project_id');
            $table->foreign('outsider_id')->references('id')->on('outsiders')->onUpdate('cascade')->onDelete('cascade')->onDelete('cascade');
            $table->foreign('research_project_id')->references('id')->on('research_projects')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outsiders_work_of_project');
    }
}
