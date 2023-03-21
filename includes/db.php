<?php 

require_once 'rb.php'; 

R::setup('mysql:host=localhost;dbname=example_users', 'root', '');

if (!R::testConnection()) {
    exit('Failed to connect to the database');
}

?>