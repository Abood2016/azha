<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // $table->float('balance', 15, 2)->default(0);
            $table->float('rate', 15, 2)->nullable();
            $table->string('licence_number');
            $table->string('licence_expire_date');
            $table->string('vehicle_brand');
            $table->string('vehicle_model');
            $table->string('vehicle_name');
            $table->string('vehicle_color');
            $table->string('vehicle_registration_number');
            $table->string('vehicle_purchase_year');
            $table->foreignId('service_id')->constrained();
            $table->text('coordinates')->nullable();
            $table->bigInteger('distance')->nullable();
            // $table->text('latitude')->nullable();
            // $table->text('longitude')->nullable();
            $table->tinyInteger('connection')->default(0);
            $table->tinyInteger('available')->default(1);
            $table->tinyInteger('approve')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->text('uid')->nullable();
            $table->string('created_by');

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
        Schema::dropIfExists('drivers');
    }
}
