# Soluzioni Tecniche - Modulo Setting

## Problemi Identificati e Soluzioni

### 1. Gestione Configurazioni (`Modules/Setting/Actions/ManageSettingAction.php`)
```php
// Problema: Gestione configurazioni non ottimizzata
public function execute(SettingData $data) {
    // Gestione sincrona delle configurazioni
}

// Soluzione proposta:
class ManageSettingAction {
    public function execute(SettingData $data): void {
        $this->validateSettingData($data);
        
        match ($data->operation) {
            'create' => $this->createSetting($data),
            'update' => $this->updateSetting($data),
            'delete' => $this->deleteSetting($data)
        };
    }
    
    private function createSetting(SettingData $data): void {
        DB::transaction(function() use ($data) {
            $setting = Setting::create([
                'key' => $data->key,
                'value' => $this->encryptIfNeeded($data->value),
                'type' => $data->type,
                'group' => $data->group
            ]);
            
            $this->invalidateCache($setting);
            $this->logSettingChange($setting, 'created');
        });
    }
    
    private function updateSetting(SettingData $data): void {
        DB::transaction(function() use ($data) {
            $setting = Setting::findOrFail($data->id);
            
            $setting->update([
                'value' => $this->encryptIfNeeded($data->value),
                'updated_at' => now()
            ]);
            
            $this->invalidateCache($setting);
            $this->logSettingChange($setting, 'updated');
        });
    }
    
    private function deleteSetting(SettingData $data): void {
        DB::transaction(function() use ($data) {
            $setting = Setting::findOrFail($data->id);
            
            $this->invalidateCache($setting);
            $this->logSettingChange($setting, 'deleted');
            
            $setting->delete();
        });
    }
}
```

### 2. Cache Management (`Modules/Setting/Services/SettingCacheService.php`)
```php
// Problema: Gestione cache non efficiente
public function cacheSetting($setting) {
    // Cache base delle impostazioni
}

// Soluzione proposta:
class SettingCacheService {
    private $cache;
    private $config;
    
    public function cacheSettingValue(Setting $setting): void {
        $key = "setting_{$setting->key}";
        
        $this->cache->tags(['settings', $setting->group])
            ->put($key, [
                'value' => $setting->value,
                'type' => $setting->type,
                'updated_at' => $setting->updated_at
            ], $this->config->get('settings.cache.ttl'));
    }
    
    public function getCachedValue(string $key): mixed {
        return $this->cache->tags(['settings'])
            ->remember($key, 
                $this->config->get('settings.cache.ttl'),
                fn() => $this->fetchSettingValue($key)
            );
    }
    
    public function invalidateSettingCache(Setting $setting): void {
        $this->cache->tags([
            'settings',
            $setting->group
        ])->flush();
    }
}
```

### 3. Validazione Impostazioni (`Modules/Setting/Services/SettingValidationService.php`)
```php
// Problema: Validazione non ottimizzata
public function validate($setting) {
    // Validazione base delle impostazioni
}

// Soluzione proposta:
class SettingValidationService {
    private $validators;
    private $logger;
    
    public function validateSetting(Setting $setting): bool {
        $validator = $this->getValidator($setting->type);
        
        try {
            $result = $validator->validate(
                value: $setting->value,
                rules: $this->getRules($setting),
                context: $this->getContext($setting)
            );
            
            $this->logValidationSuccess($setting);
            
            return $result;
            
        } catch (ValidationException $e) {
            $this->handleValidationFailure($setting, $e);
            throw $e;
        }
    }
    
    private function getRules(Setting $setting): array {
        return match ($setting->type) {
            'email' => ['email', 'max:255'],
            'url' => ['url', 'max:2048'],
            'number' => ['numeric', 'min:0'],
            'boolean' => ['boolean'],
            default => ['string', 'max:1000']
        };
    }
    
    private function getContext(Setting $setting): array {
        return [
            'group' => $setting->group,
            'environment' => app()->environment(),
            'user_id' => auth()->id()
        ];
    }
}
```

## Ottimizzazioni Database

### 1. Indici e Struttura
```sql
-- In: database/migrations/optimize_settings_tables.php
CREATE INDEX settings_key_group_idx ON settings (key, group);
CREATE INDEX setting_history_setting_idx ON setting_history (setting_id, created_at);
CREATE INDEX setting_values_type_idx ON setting_values (type) WHERE active = true;
```

### 2. Query Optimization
```php
// In: Modules/Setting/Models/Setting.php
class Setting extends Model {
    public function scopeByGroup($query, $group) {
        return $query->where('group', $group)
                    ->where('active', true)
                    ->orderBy('key');
    }
    
    public function scopeModifiedRecently($query) {
        return $query->where('updated_at', '>=', now()->subHours(24))
                    ->with(['history'])
                    ->orderBy('updated_at', 'desc');
    }
}
```

## Cache Strategy

### 1. Cache Configuration
```php
// In: Modules/Setting/Config/cache.php
return [
    'ttl' => [
        'setting_value' => 3600,    // 1 hour
        'setting_group' => 1800,    // 30 minutes
        'setting_list' => 7200     // 2 hours
    ],
    'tags' => [
        'settings',
        'groups',
        'values'
    ]
];
```

### 2. Cache Implementation
```php
// In: Modules/Setting/Services/GroupCacheService.php
class GroupCacheService {
    public function getCachedGroupSettings(string $group): array {
        return Cache::tags(['settings', "group_{$group}"])
            ->remember("group_settings_{$group}", 
                config('settings.cache.ttl.setting_group'),
                fn() => $this->fetchGroupSettings($group)
            );
    }
    
    public function invalidateGroupCache(string $group): void {
        Cache::tags(['settings', "group_{$group}"])->flush();
    }
}
```

## Rate Limiting

### 1. Setting Update Limits
```php
// In: Modules/Setting/Services/SettingRateLimitService.php
class SettingRateLimitService {
    public function canUpdateSetting(User $user): bool {
        $key = "settings:{$user->id}:updates";
        
        return Redis::throttle($key)
            ->allow(config('settings.limits.updates_per_minute'))
            ->every(60)
            ->then(
                fn() => true,
                fn() => false
            );
    }
    
    public function trackSettingUpdate(User $user): void {
        Redis::incr("settings:{$user->id}:count");
        Redis::expire("settings:{$user->id}:count", 3600);
    }
}
```

## Monitoring

### 1. Setting Changes Monitoring
```php
// In: Modules/Setting/Monitoring/SettingMonitor.php
class SettingMonitor {
    public function trackSettingMetrics(): void {
        collect(config('settings.groups'))->each(function($group) {
            $metrics = $this->getGroupMetrics($group);
            
            Metrics::gauge("settings.count", $metrics['count'], [
                'group' => $group
            ]);
            
            Metrics::histogram("settings.changes", $metrics['changes_last_hour'], [
                'group' => $group
            ]);
            
            if ($metrics['changes_last_hour'] > config('settings.thresholds.changes')) {
                Log::warning("High number of setting changes detected", [
                    'group' => $group,
                    'changes' => $metrics['changes_last_hour']
                ]);
            }
        });
    }
}
```

### 2. Health Check
```php
// In: Modules/Setting/Health/SettingHealthCheck.php
class SettingHealthCheck extends Check {
    public function run(): Result {
        $invalidSettings = Setting::where('validation_status', 'failed')
            ->where('updated_at', '>=', now()->subHour())
            ->count();
            
        $missingRequired = Setting::whereNull('value')
            ->whereIn('key', config('settings.required_keys'))
            ->count();
            
        if ($invalidSettings > 0) {
            return Result::failed("Found {$invalidSettings} invalid settings");
        }
        
        if ($missingRequired > 0) {
            return Result::failed("Missing {$missingRequired} required settings");
        }
        
        return Result::ok();
    }
}
```

## Testing

### 1. Setting Management Tests
```php
// In: Modules/Setting/Tests/Unit/SettingManagementTest.php
class SettingManagementTest extends TestCase {
    public function test_setting_creation() {
        $data = SettingData::factory()->create([
            'key' => 'test_setting',
            'value' => 'test_value',
            'group' => 'testing'
        ]);
        
        $result = app(ManageSettingAction::class)->execute($data);
        
        $this->assertDatabaseHas('settings', [
            'key' => 'test_setting',
            'group' => 'testing'
        ]);
    }
}
```

### 2. Validation Tests
```php
// In: Modules/Setting/Tests/Feature/ValidationTest.php
class ValidationTest extends TestCase {
    public function test_setting_validation() {
        $setting = Setting::factory()->create([
            'type' => 'email',
            'value' => 'invalid-email'
        ]);
        
        $service = app(SettingValidationService::class);
        
        $this->expectException(ValidationException::class);
        
        $service->validateSetting($setting);
    }
}
```

## Note di Implementazione

1. Priorità di Intervento:
   - Ottimizzazione gestione configurazioni
   - Implementazione validazione avanzata
   - Miglioramento caching
   - Implementazione monitoraggio

2. Monitoraggio:
   - Tracciamento modifiche
   - Monitoraggio validazioni
   - Analisi performance
   - Alerting automatico

3. Manutenzione:
   - Pulizia configurazioni obsolete
   - Ottimizzazione cache
   - Review sicurezza
   - Aggiornamento validazioni 