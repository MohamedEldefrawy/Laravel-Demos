<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('comment')->nullable(false);
            $table->timestamps();
            $table->unsignedBigInteger('user_Id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer("commentable_id");
            $table->string("commentable_type");
        });
    }
};
