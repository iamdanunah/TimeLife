<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ .'/../sys/db_connect.php';
include_once __DIR__ .'/../sys/user_data.php';


?>
