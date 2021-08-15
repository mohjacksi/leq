<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToHnartnaDengansTable extends Migration
{
    public function up()
    {
        Schema::table('hnartna_dengans', function (Blueprint $table) {
            $table->unsignedBigInteger('leq_id');
            $table->foreign('leq_id', 'leq_fk_4515556')->references('id')->on('leqs');
            $table->unsignedBigInteger('lijna_id');
            $table->foreign('lijna_id', 'lijna_fk_4515557')->references('id')->on('lijnas');
            $table->unsignedBigInteger('bingeh_id');
            $table->foreign('bingeh_id', 'bingeh_fk_4515558')->references('id')->on('bingehs');
            $table->unsignedBigInteger('wistgeh_id');
            $table->foreign('wistgeh_id', 'wistgeh_fk_4515559')->references('id')->on('westgehs');
        });
    }
}
