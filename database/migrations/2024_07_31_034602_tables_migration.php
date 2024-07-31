<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablesMigration extends Migration
{

    /**
     * User table
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('init_password')->nullable();
            $table->string('password');
            $table->string('organization')->nullable();
            $table->integer('user_org_id')->nullable();
            $table->integer('role_id')->default(2);
            $table->date('birthday')->nullable();
            $table->dateTime('email_verified_at')->nullable();
            $table->integer('email_verified')->default(1);
            $table->string('email_verification_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('org_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type_name');
            $table->string('type_name_eng');
            $table->integer('user_limit');
            $table->json('grades');
            $table->timestamps();
        });

        // organization table
        Schema::create('organization', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('user_limit');
            $table->integer('status');
            $table->integer('type_id');
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('parent_id')->nullable();
            $table->timestamps();
        });

        // book table
        Schema::create('book', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->boolean('agreement')->nullable();
            $table->string('cover_file')->nullable();
            $table->string('author')->nullable();
            $table->integer('user_id');
            $table->boolean('isPublic')->nullable();
            $table->string('fileUrl')->nullable();
            $table->integer('org_id')->nullable();
            $table->integer('topic_id')->nullable();
            $table->integer('cat_id')->nullable();
            $table->integer('view')->nullable();
            $table->integer('sub_cat')->nullable();
            $table->integer('grade')->nullable();
            $table->string('link_pretest')->nullable();
            $table->string('link_test')->nullable();
            $table->string('type_book')->nullable();
            $table->string('video_url')->nullable();
            $table->timestamps();
        });
        // banner table
        Schema::create('banner', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('banner_file');
            $table->timestamps();
        });
        // topics table
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('subcat_id')->unsigned();
            $table->integer('grade_id')->unsigned();
            $table->timestamps();
        });
        
        Schema::create('grade', function (Blueprint $table) {
            $table->increments('grade_id');
            $table->string('title');
            $table->timestamps();
        });
        Schema::create('subcat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });


        Schema::create('view_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('content_id')->index();
            $table->integer('user')->index();
            $table->timestamps();
        });

        
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('organization');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('view_history');
        Schema::dropIfExists('subcat');
        Schema::dropIfExists('grade');
        Schema::dropIfExists('books');
        Schema::dropIfExists('org_type');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('topics');
        Schema::dropIfExists('banner');

    }
}

