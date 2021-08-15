<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRejaBeshdarboyansTable extends Migration
{
    public function up()
    {
        Schema::table('reja_beshdarboyans', function (Blueprint $table) {
            $table->unsignedBigInteger('leq_id')->nullable();
            $table->foreign('leq_id', 'leq_fk_4518252')->references('id')->on('leqs');
            $table->unsignedBigInteger('lijna_id')->nullable();
            $table->foreign('lijna_id', 'lijna_fk_4518253')->references('id')->on('lijnas');
            $table->unsignedBigInteger('bingeh_id')->nullable();
            $table->foreign('bingeh_id', 'bingeh_fk_4518254')->references('id')->on('bingehs');
        });
    }
}
