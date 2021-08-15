<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKandidsTable extends Migration
{
    public function up()
    {
        Schema::create('kandids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nav')->unique();
            $table->string('jimara_kandidi')->unique();
            $table->string('extra')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
