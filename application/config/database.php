<?php  
if(!DEFINED('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
*/

$active_group = 'nexo';
$active_record = TRUE;

$db['nexo']['hostname'] = 'localhost';
$db['nexo']['username'] = 'root';
$db['nexo']['password'] = '';
$db['nexo']['database'] = 'nexo';
$db['nexo']['dbdriver'] = 'mysql';
$db['nexo']['dbprefix'] = 'nexo_';
$db['nexo']['pconnect'] = TRUE;
$db['nexo']['db_debug'] = TRUE;
$db['nexo']['cache_on'] = FALSE;
$db['nexo']['cachedir'] = '';
$db['nexo']['char_set'] = 'utf8';
$db['nexo']['dbcollat'] = 'utf8_general_ci';
$db['nexo']['swap_pre'] = '';
$db['nexo']['autoinit'] = TRUE;
$db['nexo']['stricton'] = FALSE;

$db['auth']['hostname'] = 'localhost';
$db['auth']['username'] = 'root';
$db['auth']['password'] = '';
$db['auth']['database'] = 'auth';
$db['auth']['dbdriver'] = 'mysql';
$db['auth']['dbprefix'] = '';
$db['auth']['pconnect'] = TRUE;
$db['auth']['db_debug'] = TRUE;
$db['auth']['cache_on'] = FALSE;
$db['auth']['cachedir'] = '';
$db['auth']['char_set'] = 'utf8';
$db['auth']['dbcollat'] = 'utf8_general_ci';
$db['auth']['swap_pre'] = '';
$db['auth']['autoinit'] = TRUE;
$db['auth']['stricton'] = FALSE;
$db['auth']['port'] = 3306;


/* End of file database.php */
/* Location: ./application/config/database.php */