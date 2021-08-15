<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLeqsTable extends Migration
{
    public function up()
    {
        Schema::table('leqs', function (Blueprint $table) {
            $table->unsignedBigInteger('layene_siyasi_id');
            $table->foreign('layene_siyasi_id', 'layene_siyasi_fk_4517039')->references('id')->on('layenetsiyasis');
        });
    }
}
