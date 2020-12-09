<?php
    define('USER', 'phpadmin');
    define('PASSWORD', 's9H1*L@SNC*2NOkrDgIsMGHgl');
    define('HOST', 'localhost');
    define('DATABASE', 'NyuMeet');
    try {
        $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
?>