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
            $table->string('last_name')->nullable();
            $table->string('twitter_username')->nullable();
            $table->string('portfolio_url')->nullable();
            $table->text('bio')->nullable();
            $table->string('location')->nullable();
            $table->string('instagram_username')->nullable();
            $table->string('profile_image')->nullable();
            $table->integer('total_collections')->default(0);
            $table->integer('total_likes')->default(0);
            $table->integer('total_photos')->default(0);
            $table->integer('total_views')->default(0);
            $table->boolean('for_hire');
            $table->string('paypal_email')->nullable();
            $table->integer('followers_count')->default(0);
            $table->integer('following_count')->default(0);
            $table->boolean('allow_messages');
            $table->integer('numeric_id')->default(0);
            $table->integer('downloads')->default(0);
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
