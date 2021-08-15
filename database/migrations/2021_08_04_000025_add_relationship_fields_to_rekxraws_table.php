<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRekxrawsTable extends Migration
{
    public function up()
    {
        Schema::table('rekxraws', function (Blueprint $table) {
            $table->unsignedBigInteger('lijna_id');
            $table->foreign('lijna_id', 'lijna_fk_4515452')->references('id')->on('lijnas');
        });
    }
}
