<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (HOST == 'local.') :

$memcached['servers'] = array(
    'default' => array(
        'host'       => '127.0.0.1',
        'port'       => '11211',
        'weight'     => '1',
        'persistent' => FALSE,
    ),
);

elseif (HOST == 'devil.') :

$memcached['servers'] = array(
    'default' => array(
        'host'       => '127.0.0.1',
        'port'       => '11211',
        'weight'     => '1',
        'persistent' => FALSE,
    ),
);

else :

$memcached['servers'] = array(
    'default' => array(
        'host'       => '127.0.0.1',
        'port'       => '11211',
        'weight'     => '1',
        'persistent' => FALSE,
    ),

    'backup' => array(
        'host'       => '127.0.0.1',
        'port'       => '11211',
        'weight'     => '1',
        'persistent' => FALSE,
    ),
    'backup2' => array(
        'host'       => '127.0.0.1',
        'port'       => '11211',
        'weight'     => '1',
        'persistent' => FALSE,
    ),
);

endif;

$memcached['config'] = array(

    'prefix'                 => 'web:',       // Prefixes every key value (useful for multi environment setups)
    'compression'            => FALSE,        // Default: FALSE or MEMCACHE_COMPRESSED Compression Method (Memcache only).

    // Not necessary if you already are using 'compression'
    'auto_compress_tresh'    => FALSE,        // Controls the minimum value length before attempting to compress automatically.
    'auto_compress_savings'  => 0.2,          // Specifies the minimum amount of savings to actually store the value compressed. The supplied value must be between 0 and 1.

    'expiration'             => 300,          // Default content expiration value (in seconds) if not expire = 0
    'delete_expiration'      => 0             // Default time between the delete command and the actual delete action occurs (in seconds)

);


$config['memcached'] = $memcached;
