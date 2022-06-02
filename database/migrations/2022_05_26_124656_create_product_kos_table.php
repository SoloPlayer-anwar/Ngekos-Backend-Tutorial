<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductKosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_kos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('fasilitas_id')->nullable();
            $table->bigInteger('kota_id')->nullable();
            $table->string('name_kos')->nullable();
            $table->double('rating_kos')->nullable();
            $table->string('tags_kos')->nullable();
            $table->text('description_kos')->nullable();
            $table->integer('price_kos')->nullable();
            $table->text('photo_product')->nullable();
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
        Schema::dropIfExists('product_kos');
    }
}
