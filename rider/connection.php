<?php

$Host = 'localhost';
$DB_DATABASE='sassolut_getitdone';
$DB_USERNAME='sassolut_zee';
$DB_PASSWORD='Zeshansubhan1@';

$conn = mysqli_connect($Host, $DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

