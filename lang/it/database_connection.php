<?php return array (
  'navigation' => 
  array (
    'name' => 'Database Connection',
    'plural' => 'Database Connections',
    'group' => 
    array (
      'name' => 'Settings',
    ),
    'sort' => 26,
    'label' => 'database connection.navigation',
    'icon' => 'database connection.navigation',
  ),
  'fields' => 
  array (
    'name' => 'Nome',
    'guard_name' => 'Guard',
    'permissions' => 'Permessi',
    'updated_at' => 'Aggiornato il',
    'first_name' => 'Nome',
    'last_name' => 'Cognome',
    'select_all' => 
    array (
      'name' => 'Seleziona Tutti',
      'message' => '',
    ),
  ),
  'actions' => 
  array (
    'database-backup' => 
    array (
      'label' => '',
      'tooltip' => 'Backup Database',
      'icon' => 'heroicon-o-arrow-down-on-square-stack',
    ),
    'import' => 
    array (
      'fields' => 
      array (
        'import_file' => 'Seleziona un file XLS o CSV da caricare',
      ),
    ),
    'export' => 
    array (
      'filename_prefix' => 'Aree al',
      'columns' => 
      array (
        'name' => 'Nome area',
        'parent_name' => 'Nome area livello superiore',
      ),
    ),
  ),
  'model' => 
  array (
    'label' => 'database connection.model',
  ),
);