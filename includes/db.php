<?php

$db['host'] = "localhost";
$db['user'] = "root";
$db['pw'] = "";
$db['name'] = "cms";

foreach ($db as $key => $value) {
    define('DB_' . strtoupper($key), $value);
}

$connection =  mysqli_connect(DB_HOST, DB_USER, DB_PW, DB_NAME);

if ($connection) {
    #code...
}