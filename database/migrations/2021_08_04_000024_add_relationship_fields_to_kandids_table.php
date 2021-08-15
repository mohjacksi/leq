<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToKandidsTable extends Migration
{
    public function up()
    {
        Schema::table('kandids', function (Blueprint $table) {
            $table->unsignedBigInteger('layene_siyasi_id')->nullable();
            $table->foreign('layene_siyasi_id', 'layene_siyasi_fk_4515496')->references('id')->on('layenetsiyasis');
        });
    }
}
