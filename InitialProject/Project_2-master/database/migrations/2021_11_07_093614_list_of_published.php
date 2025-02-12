<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListOfPublished extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('source_papers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('source_data_id');
            $table->foreign('source_data_id')
                ->references('id')
                ->on('source_data')
                ->onDelete('cascade');

            $table->unsignedBigInteger('paper_id');
            $table->foreign('paper_id')
                ->references('id')
                ->on('papers')
                ->onDelete('cascade');
                });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
