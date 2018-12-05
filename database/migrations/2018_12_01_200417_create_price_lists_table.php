<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cheat_category_id')->unsigned();
            $table->integer('cheat_id')->unsigned()->unique();
            $table->string('name')->default('');
            $table->text('desc');
            $table->integer('min')->default(0);
            $table->integer('max')->default(0);
            $table->decimal('min_price')->default(2.9);
            $table->decimal('max_price')->default(2.9);
            $table->string('locale')->default('ru');
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
        Schema::dropIfExists('price_lists');
    }
}
