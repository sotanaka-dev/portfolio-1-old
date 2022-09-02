<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // public function up()
    // {
    //     Schema::create('members', function (Blueprint $table) {
    //         $table->increments('id');
    //         $table->string('name');
    //         $table->string('address');
    //         $table->string('email');
    //         $table->string('tel');
    //         $table->string('password');
    //         $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
    //         $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
    //         $table->softDeletes();
    //     });
    // }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::dropIfExists('members');
    // }
}