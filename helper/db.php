<?php

$hostname = "localhost";

$username = "root";

$password = "";

$database = "listsong";

$port = 3306;



mysqli_report(MYSQLI_REPORT_OFF);

$connection = mysqli_connect($hostname, $username, $password, $database, $port);

if (!$connection) {

    die("เชื่อมต่อกับ database ไม่ได้" . mysqli_connect_error());

}

