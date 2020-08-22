<?php
$host = "localhost";
$dbname = "pos_db";
$username = "root";
$password  = "";

$dsn = "mysql:host=$host;dbname=$dbname";

$pdo = new PDO($dsn, $username, $password);
