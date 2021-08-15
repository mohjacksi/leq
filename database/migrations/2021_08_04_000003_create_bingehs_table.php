<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBingehsTable extends Migration
{
    public function up()
    {
        Schema::create('bingehs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('bingeh_code')->unique();
            $table->integer('jimara_dengderan')->nullable();
            $table->string('jimara_rekxistiya')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
