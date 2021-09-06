<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRejaBeshdarboyansTable extends Migration
{
    public function up()
    {
        Schema::create('reja_beshdarboyans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('demjimer')->nullable();
            $table->integer('jimara_beshdarboyan');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
