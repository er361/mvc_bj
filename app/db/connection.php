<?php
/**
 * Created by PhpStorm.
 * User: Miracle-
 * Date: 03.03.2019
 * Time: 22:53
 */

include_once "SimpleOrm.class.php";

$host = 'localhost';
$username = 'root';
$password = '';


// Connect to the database using mysqli
$conn = new mysqli($host, $username, $password);

if ($conn->connect_error)
    die(sprintf('Unable to connect to the database. %s', $conn->connect_error));

// Tell Simple ORM to use the connection you just created.
SimpleOrm::useConnection($conn, 'bj');