<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayenetsiyasisTable extends Migration
{
    public function up()
    {
        Schema::create('layenetsiyasis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('code_siyasi');
            $table->integer('jimara_kandida');
            $table->string('extra')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
