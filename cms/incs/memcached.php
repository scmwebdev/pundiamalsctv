<?php
if (!defined('INC_DIR')) exit('No direct script access allowed');


// --------------------------------------------------------------------------
// Servers
// --------------------------------------------------------------------------

if (in_array(HOST, array('local', 'devil'))) :

$memcached['servers'] = array(
    'default' => array(
        'host'       => '192.168.7.97',
        'port'       => '11211',
        'weight'     => '1',
        'persistent' => FALSE,
    ),
);

else :

$memcached['servers'] = array(
    'default' => array(
        'host'       => '192.168.7.97',
        'port'       => '11211',
        'weight'     => '1',
        'persistent' => FALSE,
    ),

    'backup' => array(
        'host'       => '192.168.7.97',
        'port'       => '11211',
        'weight'     => '1',
        'persistent' => FALSE,
    ),
    'backup1' => array(
        'host'       => '192.168.7.97',
        'port'       => '11211',
        'weight'     => '1',
        'persistent' => FALSE,
    ),
);

endif;

// --------------------------------------------------------------------------
// Configuration
// --------------------------------------------------------------------------
$memcached['config'] = array(

    // Prefixes every key value (useful for multi environment setups)
	'prefix'                 => 'web:',

	// Default: FALSE or MEMCACHE_COMPRESSED Compression Method (Memcache only).
    'compression'            => FALSE,

    // Not necessary if you already are using 'compression'
	// Controls the minimum value length before attempting to compress
	// automatically.
    'auto_compress_tresh'    => FALSE,

	// Specifies the minimum amount of savings to actually store the value
	//compressed. The supplied value must be between 0 and 1.
    'auto_compress_savings'  => 0.2,

    // Default content expiration value (in seconds) if not expire = 0
	'expiration'             => 0,

	// Default time between the delete command and the actual delete action
	// occurs (in seconds)
    'delete_expiration'      => 0

);
