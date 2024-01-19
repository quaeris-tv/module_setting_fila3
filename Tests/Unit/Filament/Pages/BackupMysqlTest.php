<?php

namespace Modules\Setting\Tests\Unit\Filament\Pages;

use Modules\Setting\Filament\Pages\BackupMysql;
use Tests\TestCase;

/**
 * Class BackupMysqlTest.
 *
 * @covers \Modules\Setting\Filament\Pages\BackupMysql
 */
final class BackupMysqlTest extends TestCase
{
    private BackupMysql $backupMysql;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->backupMysql = new BackupMysql();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->backupMysql);
    }

    public function testDownload(): void
    {
        /** @todo This test is incomplete. */
        self::markTestIncomplete();
    }
}
