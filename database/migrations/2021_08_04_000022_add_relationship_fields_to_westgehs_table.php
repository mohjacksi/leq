<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWestgehsTable extends Migration
{
    public function up()
    {
        Schema::table('westgehs', function (Blueprint $table) {
            $table->unsignedBigInteger('bingeh_id');
            $table->foreign('bingeh_id', 'bingeh_fk_4515478')->references('id')->on('bingehs');
        });
    }
}
