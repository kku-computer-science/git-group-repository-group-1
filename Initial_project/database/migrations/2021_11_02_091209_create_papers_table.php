<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("paper_name");
            $table->string("paper_type")->nullable();
            $table->string("paper_sourcetitle")->nullable();
            $table->string("paper_url")->nullable();
            $table->date("paper_yearpub")->nullable();
            $table->string("paper_volume")->nullable();
            $table->string("paper_issue")->nullable();
            $table->integer("paper_citation")->nullable();
            $table->string("paper_page")->nullable();
            $table->string("paper_doi")->nullable();
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
        Schema::dropIfExists('papers');
    }
}
