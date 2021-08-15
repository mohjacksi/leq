<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDaxlkrnaDengenKandidasTable extends Migration
{
    public function up()
    {
        Schema::table('daxlkrna_dengen_kandidas', function (Blueprint $table) {
            $table->unsignedBigInteger('leq_id');
            $table->foreign('leq_id', 'leq_fk_4517100')->references('id')->on('leqs');
            $table->unsignedBigInteger('lijna_id');
            $table->foreign('lijna_id', 'lijna_fk_4517101')->references('id')->on('lijnas');
            $table->unsignedBigInteger('bingeh_id');
            $table->foreign('bingeh_id', 'bingeh_fk_4517102')->references('id')->on('bingehs');
            $table->unsignedBigInteger('westgeh_id');
            $table->foreign('westgeh_id', 'westgeh_fk_4517103')->references('id')->on('westgehs');
            $table->unsignedBigInteger('layenesiyasi_id');
            $table->foreign('layenesiyasi_id', 'layenesiyasi_fk_4517104')->references('id')->on('layenetsiyasis');
            $table->unsignedBigInteger('jimara_kandidi_id');
            $table->foreign('jimara_kandidi_id', 'jimara_kandidi_fk_4515524')->references('id')->on('kandids');
        });
    }
}
