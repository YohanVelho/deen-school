<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdminGeneralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_general', function (Blueprint $table) {
            $table->id();
            $table->image("logo");
            $table->string("favicon")->nullable();
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->string("whatsapp")->nullable();
            $table->string("facebook")->nullable();
            $table->string("instagram")->nullable();
            $table->string("youtube")->nullable();
            $table->string("linkedin")->nullable();
            $table->text("script_head")->nullable();
            $table->text("script_body")->nullable();
            $table->text("script_footer")->nullable();
            $table->timestamps();
        });

        DB::table('admin_general')->insert(
            [
                'id' => 1,
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_general');
    }
}
