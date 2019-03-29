<?php
include 'dbh.php';
session_start();
$time = $_POST['time'];

$data1 = implode(" ", $time);
$data = explode(" ", $data1);
