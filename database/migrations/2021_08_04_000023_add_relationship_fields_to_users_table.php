<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('lijna_id')->nullable();
            $table->foreign('lijna_id', 'lijna_fk_4516383')->references('id')->on('lijnas');
            $table->unsignedBigInteger('bingeh_id')->nullable();
            $table->foreign('bingeh_id', 'bingeh_fk_4516384')->references('id')->on('bingehs');
            $table->unsignedBigInteger('user_type_id')->nullable();
            $table->foreign('user_type_id', 'user_type_fk_4533825')->references('id')->on('user_types');
        });
    }
}
