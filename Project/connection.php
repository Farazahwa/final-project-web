<?php 
function connect()
    {
        $host = "localhost";
        $username = "root";
        $password = "reveve";
        $conn = new PDO("mysql:host=$host;dbname=meownya-shop", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
?>