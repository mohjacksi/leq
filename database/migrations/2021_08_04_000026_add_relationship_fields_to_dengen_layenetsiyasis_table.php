<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDengenLayenetsiyasisTable extends Migration
{
    public function up()
    {
        Schema::table('dengen_layenetsiyasis', function (Blueprint $table) {
            $table->unsignedBigInteger('leq_id');
            $table->foreign('leq_id', 'leq_fk_4517941')->references('id')->on('leqs');
            $table->unsignedBigInteger('lijna_id');
            $table->foreign('lijna_id', 'lijna_fk_4517942')->references('id')->on('lijnas');
            $table->unsignedBigInteger('bingeh_id');
            $table->foreign('bingeh_id', 'bingeh_fk_4517943')->references('id')->on('bingehs');
            $table->unsignedBigInteger('westgeh_id');
            $table->foreign('westgeh_id', 'westgeh_fk_4517944')->references('id')->on('westgehs');
            $table->unsignedBigInteger('layene_siyasi_id');
            $table->foreign('layene_siyasi_id', 'layene_siyasi_fk_4515509')->references('id')->on('layenetsiyasis');
        });
    }
}
