<?php
$db = "localhost";
$dbname = "TestDB";
$dbuser = "postgres";
$dbpassword = "postgres";

$connection = "";


$connection  = pg_connect("host=$db dbname=$dbname user=$dbuser password=$dbpassword");

if (!$connection) {
    die("ERROR: Could not connect to database $dbname\n");
}

?>