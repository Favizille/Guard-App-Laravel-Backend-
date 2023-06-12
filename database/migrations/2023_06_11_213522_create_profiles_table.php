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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->string("first_name");
            $table->string("last_name");
            $table->string("address");
            $table->string("phone_number")->unique();
            $table->bigInteger("NIN")->unique();
            $table->string("state_of_origin");
            $table->string("state_of_residence");
            $table->string("date_of_birth");
            // $table->string("image");
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
        Schema::dropIfExists('profiles');
    }
};
