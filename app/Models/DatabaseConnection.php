<?php

declare(strict_types=1);

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DatabaseConnection extends Model
{
    protected $fillable = [
        'name',
        'driver',
        'host',
        'port',
        'database',
        'username',
        'password',
        'charset',
        'collation',
        'prefix',
        'strict',
        'engine',
        'options',
        'status',
    ];

    protected $casts = [
        'port' => 'integer',
        'strict' => 'boolean',
        'options' => 'array',
    ];

    public function testConnection(): bool
    {
        try {
            $config = [
                'driver' => $this->driver,
                'host' => $this->host,
                'port' => $this->port,
                'database' => $this->database,
                'username' => $this->username,
                'password' => $this->password,
                'charset' => $this->charset ?? 'utf8mb4',
                'collation' => $this->collation ?? 'utf8mb4_unicode_ci',
                'prefix' => $this->prefix,
                'strict' => $this->strict,
                'engine' => $this->engine,
            ];

            if (! empty($this->options)) {
                $config = array_merge($config, $this->options);
            }

            Config::set('database.connections.test_connection', $config);
            DB::connection('test_connection')->getPdo();

            return true;
        } catch (\Exception $e) {
            report($e);

            return false;
        }
    }
}
