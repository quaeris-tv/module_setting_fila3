<?php

declare(strict_types=1);

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Sushi\Sushi;
use Webmozart\Assert\Assert;

class DatabaseConnection extends Model
{
    use Sushi;

    /**
     * Model Rows.
     *
     * @return array
     */
    public function getRows()
    {
        Assert::isArray($connections = config('database.connections'));

        // $rows = array_filter($connections, fn ($item): bool => 'mysql' === $item['driver']);
        $rows = Arr::map(
            $connections,
            function (array $value, string $key) {
                return [
                    'id' => $key,
                    'name' => $key,
                    'driver' => $value['driver'],
                    'database' => $value['database'],
                ];
            }
        );

        return array_values($rows);
    }
}
