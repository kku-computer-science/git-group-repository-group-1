<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academicworks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("ac_name");
            $table->string("ac_type")->nullable();
            $table->string("ac_sourcetitle")->nullable();
            $table->date("ac_year")->nullable();
            $table->string("ac_refnumber")->nullable();
            $table->string("ac_page")->nullable();
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
        Schema::dropIfExists('academicworks');
    }
}
