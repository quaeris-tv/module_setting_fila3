<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;
use Spatie\LaravelSettings\Migrations\SettingsMigrator;

class CreateSettingsTable extends XotBaseMigration
{
    /**
     * Undocumented function.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            function (Blueprint $table): void {
                $table->uuid('id')->primary();
                $table->string('group');
                $table->string('name');
                $table->boolean('locked')->default(false);
                $table->json('payload');
                $table->timestamps();
                $table->unique(['group', 'name']);
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                app(SettingsMigrator::class)->add('general.site_name', 'Spatie');
                app(SettingsMigrator::class)->add('general.site_active', 'Spatie');
                app(SettingsMigrator::class)->add('general.logo', 'logo.png');
                // if (! $this->hasColumn('from')) {
                //    $table->string('from')->nullable();
                // }
            }
        );
    }
}
