<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGithubrepositoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('githubrepositories', function (Blueprint $table) {
            $table->id();
            $table->string('repositoryname');
            // $table->string('username');
            $table->foreignId('user_id'); //need to track id of corresponding user for this repo
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('githubrepositories');
    }
}
