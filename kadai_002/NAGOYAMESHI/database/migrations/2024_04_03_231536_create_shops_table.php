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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->integer('lower_price')->unsigned();
            $table->integer('upper_price')->unsigned();
            $table->time('start_time');
            $table->time('close_time');
            $table->text('regular_holiday');
            $table->string('postal_code')->default('');
            $table->text('address');
            $table->string('phone')->default('');
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
        Schema::dropIfExists('shops');
    }
};
