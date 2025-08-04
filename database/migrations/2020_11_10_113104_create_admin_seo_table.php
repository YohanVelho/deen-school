<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_seo', function (Blueprint $table) {
            $table->id();
            $table->string("link");
            $table->string("title");
            $table->string("description")->nullable();
            $table->string("keywords")->nullable();
            $table->string("canonical")->nullable();
            $table->string("seo_img")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_seo');
    }
}
