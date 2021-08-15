<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLijnasTable extends Migration
{
    public function up()
    {
        Schema::table('lijnas', function (Blueprint $table) {
            $table->unsignedBigInteger('leq_id')->nullable();
            $table->foreign('leq_id', 'leq_fk_4515447')->references('id')->on('leqs');
        });
    }
}
