<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearchGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_groups', function (Blueprint $table) {

            $table->id();
            $table->string("Group_name_TH");
            $table->string("Group_name_EN");
            $table->longText("Group_detail_TH")->nullable();
            $table->longText("Group_detail_EN")->nullable();
            $table->longText("Group_desc_TH")->nullable();
            $table->longText("Group_desc_EN")->nullable();
            $table->string("Group_image")->nullable();
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
        Schema::dropIfExists('research_group');
    }
}
