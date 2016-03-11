<?php

/**
 * @file
 * A single location to store configuration.
 */

$siteURL  = "http://".$_SERVER['SERVER_NAME'] ;

if($siteURL == "http://content.liputan6.com") {

    define('CONSUMER_KEY', 'WUpjhgqsY1QTrp5KfRgQg');
    define('CONSUMER_SECRET', 'UcMbCmXg4I0VOpT9VJaXZSULlitUOF6TBAgGtAMhDzA');
    define('OAUTH_TOKEN', '47596019-oHX4un4KM6fa2ZIIdVYvexiWllem6h5NSvrNhAaY');
    define('OAUTH_TOKEN_SECRET', 'mMXthnvTBMTlwkHKToDubu7g2fFbb2Mc06cFsujjJRY');

}else{

    define('CONSUMER_KEY', 'Ti8h6hsBuDLfzutyvybzHA');
    define('CONSUMER_SECRET', 'sykahy5t7QIRo3Gd3DOzn44c1Tle7yBLkh5KrIW4IFs');
    define('OAUTH_TOKEN', '1850831532-v7Wr9L0emyehVjLbSFfURoFeuOrkHRvkYI2BrSQ');
    define('OAUTH_TOKEN_SECRET', 'R8uJxQUgagbQyJUj7uPBGpQjf0wFcyPHglpSj8nNHeM');

}
