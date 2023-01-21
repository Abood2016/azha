<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained();
            $table->foreignId('subcategory_id')->nullable()->constrained('sub_categories')->nullOnDelete();
            $table->foreignId('recruiter_id')->nullable()->constrained('recruiters')->cascadeOnDelete();

            $table->string('region')->nullable();
            $table->string('execution_time')->nullable();
            $table->string('number_person')->nullable();
            $table->string('place_type')->nullable();
            $table->string('photography_type')->nullable();
            $table->string('paper_type')->nullable();
            $table->string('conditioning_type')->nullable();
            $table->string('car_type')->nullable();
            $table->string('count_photos')->nullable();
            $table->string('count_videos')->nullable();
            $table->string('polish_type')->nullable();
            $table->string('delivery_area')->nullable();
            $table->string('residential_unit')->nullable();
            $table->string('count_workers')->nullable();
            $table->string('spare_parts')->nullable();
            $table->string('year_production')->nullable();
//            $table->tinyInteger('approve')->default(0);
            $table->tinyInteger('status')->default(0); // 0 pending 1 accepted 2 cancel  // completed
            $table->text('image')->nullable();
            $table->text('message')->nullable();


            $table->string('name');
//            $table->float('base_fare', 15, 2)->nullable();
//            $table->float('minimum_fare', 15, 2)->nullable();
//            $table->float('per_minute', 15, 2)->nullable();
//            $table->float('per_km', 15, 2)->nullable();
//            $table->float('commission', 15, 2)->nullable();


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
        Schema::dropIfExists('services');
    }
}
