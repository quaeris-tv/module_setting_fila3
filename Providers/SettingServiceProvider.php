<?php

declare(strict_types=1);

namespace Modules\Setting\Providers;

use Modules\Xot\Providers\XotBaseServiceProvider;
use Modules\Xot\Services\BladeService;

/**
 * ---
 */
class SettingServiceProvider extends XotBaseServiceProvider
{
    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

    public string $module_name = 'setting';
}