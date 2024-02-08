<?php

declare(strict_types=1);

namespace Modules\Setting\Tests\Unit\Database\Seeders;

use Modules\Setting\Database\Seeders\SettingDatabaseSeeder;
use Tests\TestCase;

/**
 * Class SettingDatabaseSeederTest.
 *
 * @covers \Modules\Setting\Database\Seeders\SettingDatabaseSeeder
 */
final class SettingDatabaseSeederTest extends TestCase
{
    private SettingDatabaseSeeder $settingDatabaseSeeder;

    protected function setUp(): void
    {
        parent::setUp();

        /* @todo Correctly instantiate tested object to use it. */
        $this->settingDatabaseSeeder = new SettingDatabaseSeeder();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->settingDatabaseSeeder);
    }

    public function testRun(): void
    {
        /* @todo This test is incomplete. */
        self::markTestIncomplete();
    }
}
