<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkTruckTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('park_truck', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('park_id');       // ИД автопарка
            $table->unsignedBigInteger('truck_id');      // ИД машины
            $table->timestamps();

            $table->foreign('park_id')
                ->references('id')
                ->on('parks');

            $table->foreign('truck_id')
                ->references('id')
                ->on('trucks');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('park_truck', function (Blueprint $table) {
            $table->dropForeign(['park_id']);
            $table->dropForeign(['truck_id']);
        });

        Schema::dropIfExists('park_truck');
    }
}
