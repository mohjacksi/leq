<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekxrawsTable extends Migration
{
    public function up()
    {
        Schema::create('rekxraws', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('code_rekxraw')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
