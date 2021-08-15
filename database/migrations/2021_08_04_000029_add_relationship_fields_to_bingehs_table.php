<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBingehsTable extends Migration
{
    public function up()
    {
        Schema::table('bingehs', function (Blueprint $table) {
            $table->unsignedBigInteger('lijna_id');
            $table->foreign('lijna_id', 'lijna_fk_4515462')->references('id')->on('lijnas');
            $table->unsignedBigInteger('rekxraw_id')->nullable();
            $table->foreign('rekxraw_id', 'rekxraw_fk_4515469')->references('id')->on('rekxraws');
        });
    }
}
