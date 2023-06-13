<?php

include '../src/model/conDB.php';
$id = $_GET['id'];
$table = $_GET['tb'];
$page = $_GET['page'];

$result = mysqli_query($mysqli, "DELETE FROM $table WHERE id = $id");
if ($result) {
    $_SESSION['alert'] = "Data berhasil dihapus!";
    header("Location: $page.php");
    exit();
}
