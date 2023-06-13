<?php

if (!isset($_GET['id'])) {
    header("Location: produk.php");
}

$id = $_GET['id'];
include '../src/model/conDB.php';
if (mysqli_query($mysqli, "DELETE FROM keranjang WHERE id=$id")) {
    echo "<script>alert('Sepertinya ada yang salah')</script>";
    echo "<script>window.location.href='keranjang.php'</script>";
} else {
    echo "<script>alert('Produk dihapus dari keranjang!')</script>";
    echo "<script>window.location.href='keranjang.php'</script>";
}
