<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHnartnaRejaBeshdarboyansTable extends Migration
{
    public function up()
    {
        Schema::create('hnartna_reja_beshdarboyans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('hejmar');
            $table->datetime('dem');
            $table->longText('tebini')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
