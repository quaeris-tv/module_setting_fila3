<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Xot\Database\Migrations\XotBaseMigration;

use Spatie\LaravelSettings\Migrations\SettingsMigrator;

class CreateSettingsTable extends XotBaseMigration
{
    public function up()
    {
        // -- CREATE --
        $this->tableCreate(
            function (Blueprint $table) {
                $table->id();

                $table->string('group');
                $table->string('name');
                $table->boolean('locked')->default(false);
                $table->json('payload');

                $table->timestamps();

                $table->unique(['group', 'name']);
                app(SettingsMigrator::class)->add('general.site_name', 'Spatie');
                app(SettingsMigrator::class)->add('general.site_active', 'Spatie');
                app(SettingsMigrator::class)->add('general.logo', 'logo.png');
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table) {

                //if (! $this->hasColumn('from')) {
                //    $table->string('from')->nullable();
                //}
            }
        );
    }


};