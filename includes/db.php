<?php

$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_pwd'] = '1234';
$db['db_name'] = 'cms';

foreach( $db as $key => $value ){
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);

// if($connection){
//     echo "Connected";
// }

?>