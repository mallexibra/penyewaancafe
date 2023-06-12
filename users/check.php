<?php

session_start();
$id = $_SESSION['id_user'];
$total = $_GET['total'];
include '../src/model/conDB.php';


mysqli_query($mysqli, "INSERT INTO transaksi (id_user, total) VALUES( $id, $total)");
$querytrx = mysqli_query($mysqli, "SELECT * FROM transaksi ORDER BY id DESC");
$row = mysqli_fetch_assoc($querytrx);

mysqli_query($mysqli, "INSERT INTO detail_transaksi (id_produk, id_user, hari, total, jumlah, id_transaksi)
                       SELECT id_produk, id_user, hari, total, jumlah, " . $row['id'] . " 
                       FROM keranjang");

mysqli_query($mysqli, "DELETE FROM keranjang");

echo "<script>window.location.href='keranjang.php'</script>";
