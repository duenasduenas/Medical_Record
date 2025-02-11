<?php
$db = "localhost";
$dbname = "TestDB";
$dbuser = "postgres";
$dbpassword = "postgres";

$connection = "";


$connection  = pg_connect("host=$db dbname=$dbname user=$dbuser password=$dbpassword");


if ($connection) {
    echo "Connected to database $dbname\n";
} else {
    echo "Could not connect to database $dbname\n";
}

?>