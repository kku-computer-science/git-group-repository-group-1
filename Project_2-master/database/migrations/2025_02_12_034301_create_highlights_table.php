<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHighlightsTable extends Migration
{
    /**
     * Run the migrations.
     *      *
     * @return void

     */
    public function up(): void
    {
        Schema::create('highlights', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // ชื่อของ Highlight
            $table->text('description')->nullable(); // คำอธิบาย
            $table->string('image_url'); // รูปภาพ
            $table->integer('priority')->default(1); // ลำดับความสำคัญ
            $table->enum('status', ['active', 'inactive'])->default('active'); // สถานะ
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('highlights');
    }
}
