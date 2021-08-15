<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDengenLayenetsiyasisTable extends Migration
{
    public function up()
    {
        Schema::create('dengen_layenetsiyasis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('jimara_dengan');
            $table->string('extra_1')->nullable();
            $table->string('extra_2')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
