<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdminModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_modules', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('controller', 100)->nullable();
            $table->string('icon', 50);
            $table->string('url', 50)->nullable();
            $table->boolean('crud')->default(1);
            $table->boolean('action')->default(0);
            $table->integer('position')->default(0);
            $table->foreignId('parent')->nullable()->constrained('admin_modules');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

        DB::table('admin_modules')->insert([
            [
                'id' => 1,
                'name' => 'Empresa',
                'controller' => 'GeneralController',
                'icon' => 'business',
                'url' => 'empresa',
                'position' => 1,
                'parent' => null
            ],
            [
                'id' => 2,
                'name' => 'Newsletter',
                'controller' => 'NewsletterController',
                'icon' => 'email',
                'url' => 'newsletter',
                'position' => 2,
                'parent' => null
            ],
            [
                'id' => 3,
                'name' => 'SEO',
                'controller' => 'SeoController',
                'icon' => 'insights',
                'url' => 'seo',
                'position' => 3,
                'parent' => null
            ],
            [
                'id' => 4,
                'name' => 'Configurações',
                'controller' => null,
                'icon' => 'settings',
                'url' => null,
                'position' => 4,
                'parent' => null
            ],
            [
                'id' => 5,
                'name' => 'Usuários',
                'controller' => 'UserController',
                'icon' => 'person',
                'url' => 'usuarios',
                'position' => 5,
                'parent' => 4
            ],
            [
                'id' => 6,
                'name' => 'Línguas',
                'controller' => 'LanguageController',
                'icon' => 'translate',
                'url' => 'linguas',
                'position' => 6,
                'parent' => 4
            ],
            [
                'id' => 7,
                'name' => 'Dicionário',
                'controller' => 'DictionaryController',
                'icon' => 'translate',
                'url' => 'traducao',
                'position' => 7,
                'parent' => 4
            ],
            [
                'id' => 8,
                'name' => 'Módulos',
                'controller' => 'ModuleController',
                'icon' => 'dashboard',
                'url' => 'modulos',
                'position' => 8,
                'parent' => 4
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_modules');
    }
}
