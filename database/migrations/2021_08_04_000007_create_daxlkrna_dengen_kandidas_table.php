<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaxlkrnaDengenKandidasTable extends Migration
{
    public function up()
    {
        Schema::create('daxlkrna_dengen_kandidas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('jimara_dengan');
            $table->string('extra_1')->nullable();
            $table->string('extra_2')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
