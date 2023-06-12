<?php 

$id = $_GET['id'];
include '../src/model/conDB.php';
mysqli_query($mysqli, "DELETE FROM keranjang WHERE id=$id");
echo "<script>window.location.href='keranjang.php'</script>";
