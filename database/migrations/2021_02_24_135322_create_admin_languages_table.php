<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdminLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_languages', function (Blueprint $table) {
            $table->id();
            $table->string("icon")->nullable();
            $table->string("name");
            $table->string("slug");
            $table->boolean('active')->default(1);
            $table->integer("position")->nullable();
            $table->timestamps();
        });

        DB::table('admin_languages')->insert(
            [
                'name' => 'Português',
                'slug' => 'pt'
            ],
            [
                'name' => 'Espanhol',
                'slug' => 'es'
            ],
            [
                'name' => 'Inglês',
                'slug' => 'en'
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
        Schema::dropIfExists('admin_languages');
    }
}
