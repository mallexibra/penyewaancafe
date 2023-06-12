<?php

session_start();
include '../src/model/conDB.php';

$id = $_GET['idtransaksi'];
$status = $_GET['status'];

if ($status == "PENDING") {
    mysqli_query($mysqli, "UPDATE transaksi SET status='SUCCESS' WHERE id=$id");
} elseif ($status == "SUCCESS") {
    mysqli_query($mysqli, "UPDATE transaksi SET status='RETURNED' WHERE id=$id");
}

header("Location: laporan.php");
