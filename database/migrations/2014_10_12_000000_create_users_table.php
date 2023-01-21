<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('fcm_token')->nullable();
            $table->string('expires_at')->nullable();
            $table->string('password');
            $table->tinyInteger('role');
            $table->rememberToken();
            $table->text('profile_photo_path')->nullable();
            $table->boolean('is_new')->default(false);
            $table->boolean('push_notification')->default(true);
            $table->boolean('is_from_socialite')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
