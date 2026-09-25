<?php
if (session_status() === PHP_SESSION_NONE) {
    // session_start();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

$local = true; 

if ($local) {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'shbtechmed';
    $site = "http://localhost/office_php_project/shbtechmed/";
} else {
    $host = 'localhost';
    $username = 'u799879276_shbtechmed';
    $password = '4d|dkCz&aW=';
    $dbName = 'u799879276_shbtechmed';
    $site = 'https://shbtechmed.com/';
}

global $site;

$conn = new mysqli($host, $username, $password, $dbName);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

?>