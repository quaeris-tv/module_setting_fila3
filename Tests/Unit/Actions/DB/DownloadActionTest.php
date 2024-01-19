<?php

namespace Modules\Setting\Tests\Unit\Actions\DB;

use Modules\Setting\Actions\DB\DownloadAction;
use Tests\TestCase;

/**
 * Class DownloadActionTest.
 *
 * @covers \Modules\Setting\Actions\DB\DownloadAction
 */
final class DownloadActionTest extends TestCase
{
    private DownloadAction $downloadAction;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->downloadAction = new DownloadAction();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->downloadAction);
    }

    public function testExecute(): void
    {
        /** @todo This test is incomplete. */
        self::markTestIncomplete();
    }
}
