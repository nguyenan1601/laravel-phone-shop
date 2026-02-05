<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('brand', 50);
            $table->decimal('price', 12, 2);
            $table->string('description', 255)->nullable();
            $table->string('color', 50)->nullable();
            $table->string('storage', 50)->nullable();
            $table->integer('stockQuantity')->default(0);
            $table->string('imgUrl', 255)->nullable();
            $table->foreignId('status_id')->constrained('phone_statuses');
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
        Schema::dropIfExists('phones');
    }
};
