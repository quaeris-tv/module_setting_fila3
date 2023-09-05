<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;
use Spatie\LaravelSettings\Migrations\SettingsMigrator;

final class CreateSettingsTable extends XotBaseMigration
{
    /**
     * Undocumented function.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            static function (Blueprint $blueprint) : void {
                $blueprint->id();
                $blueprint->string('group');
                $blueprint->string('name');
                $blueprint->boolean('locked')->default(false);
                $blueprint->json('payload');
                $blueprint->timestamps();
                $blueprint->unique(['group', 'name']);
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            static function (Blueprint $blueprint) : void {
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
