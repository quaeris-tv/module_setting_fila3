<?php

declare(strict_types=1);

namespace Modules\Setting\Tests\Unit\Database\Factories;

use Modules\Setting\Database\Factories\SettingFactory;
use Tests\TestCase;

/**
 * Class SettingFactoryTest.
 *
 * @covers \Modules\Setting\Database\Factories\SettingFactory
 */
final class SettingFactoryTest extends TestCase
{
    private SettingFactory $settingFactory;

    protected function setUp(): void
    {
        parent::setUp();

        /* @todo Correctly instantiate tested object to use it. */
        $this->settingFactory = new SettingFactory();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->settingFactory);
    }

    public function testDefinition(): void
    {
        /* @todo This test is incomplete. */
        self::markTestIncomplete();
    }
}
