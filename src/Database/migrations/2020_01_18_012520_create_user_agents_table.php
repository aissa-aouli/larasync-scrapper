<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('user_agents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_agent_string',400)->unique();
            $table->enum('status',['0','1']);
            $table->timestamps();
        });

        Schema::create('proxy_user_agent', function (Blueprint $table) {
            $table->bigInteger('proxy_id')->unsigned();
            $table->foreign('proxy_id','proxy_id')->references('id')->on('proxies')->onDelete('cascade');
            $table->bigInteger('user_agent_id')->unsigned();
            $table->foreign('user_agent_id','user_agent_id')->references('id')->on('user_agents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_agents');
        Schema::dropIfExists('proxy_user_agent');
    }
}
