<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->string('id');
            $table->string('username');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('twitter_username')->nullable();
            $table->string('portfolio_url')->nullable();
            $table->text('bio')->nullable();
            $table->string('location')->nullable();
            $table->string('instagram_username')->nullable();
            $table->string('profile_image')->nullable();
            $table->integer('total_collections');
            $table->integer('total_likes');
            $table->integer('total_photos');
            $table->integer('total_views');
            $table->boolean('for_hire');
            $table->string('paypal_email')->nullable();
            $table->integer('followers_count');
            $table->integer('following_count');
            $table->boolean('allow_messages');
            $table->integer('numeric_id');
            $table->integer('downloads');
            $table->timestamp('updated_external');
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
}
