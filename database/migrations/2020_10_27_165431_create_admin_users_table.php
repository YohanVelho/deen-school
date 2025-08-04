<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('password', 100);
            $table->text('permissions');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

        DB::table('admin_users')->insert(
            [
                'name' => 'Suporte NOMAD',
                'email' => 'suporte@wearenomad.dev',
                'password' => '$2y$10$ReBR3/mz7OisJ6F3BaMg4uRaPSPnL.Mi9ShBbT5PpfiBbVubhQXkm', // #N0m@d
                'permissions' => '["1","2","3","4","5","6","7","8"]'
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
        Schema::dropIfExists('admin_users');
    }
}
