<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('referral_discount', 10, 2);
            $table->string('nakrutka_api_key')->default('9cadeeff0a651343158adce698c04d57');
            $table->string('paypal_client_id')->default('AZbaAaz0x2RoGv-nJc3CfUc_TuIBo46P6dt1pddthq4ggRtLpJ2tpJRHldEA7A0Jvc5WOpC5EmJReEys');
            $table->string('paypal_secret')->default('EGhGFs0_biXf-QSyiBP5DRsL9dTuDYH_VORnmjXws5LALQX5jcEyTnKaTxWx_hW_OTEiCW0HXmEZj6IO');
            $table->string('paypal_mode')->default('sandbox');
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
        Schema::dropIfExists('settings');
    }
}
