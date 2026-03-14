<?php



$connect = new mysqli("localhost","u3299792_root","Leha2776parfenov","u3299792_gradehub");


if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
