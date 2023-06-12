<?php

session_start();
include '../src/model/conDB.php';

if (!isset($_SESSION['user'])) {
  echo "<script>window.location.href = 'login.php'</script>";
  exit();
}

if (!isset($_GET['id'])) {
  echo "Error: ID parameter is missing.";
  exit();
}

$id = $_GET['id'];
$query = mysqli_query($mysqli, "SELECT * FROM produk WHERE id = $id");
$row = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CAFESTUFF | Detail Produk</title>
  <link rel="stylesheet" href="../src/style/style.css" />
</head>

<body class="font-poppins">
  <nav class="bg-stone-800/90 backdrop-blur-sm fixed top-0 z-10 w-full p-4 text-white">
    <div class="relative flex justify-center md:justify-between items-center mx-auto max-w-4xl">
      <div class="nav_brand flex justify-center items-center gap-3">
        <img src="../src/assets/image/cafestuff.png" alt="logo" class="w-6" />
        <h1 class="sm:text-2xl text-xl font-extrabold">CAFESTUFF</h1>
      </div>
      <img class="absolute right-0 w-9 md:hidden cursor-pointer" src="../src/assets/icons/burger_menu.png" alt="burger_menu" id="burger_menu" />
      <div id="sidebar" class="list_item text-sm font-medium fixed md:static md:bg-transparent bg-stone-800/90 w-[70%] h-screen md:h-auto top-[60px] right-0 hidden md:flex md:flex-row flex-col md:justify-end justify-center items-center gap-7">
        <ul class="flex flex-col md:flex-row text-center gap-7">
          <li>
            <a class="hover:scale-110 text-sm inline-block" href="../index.php">Dashboard</a>
          </li>
          <li>
            <a class="hover:scale-110 text-sm inline-block" href="produk.php">Sewa Barang</a>
          </li>
          <li>
            <a class="hover:scale-110 text-sm inline-block" href="keranjang.php">Keranjang</a>
          </li>
          <?php if (isset($_SESSION['user'])) : ?>
            <li>
              <a class="hover:scale-110 text-sm inline-block" href="editprofile.php">Edit Profile</a>
            </li>
            <li>
              <a class="hover:scale-110 text-sm font-bold inline-block" href="profile.php"><?= $_SESSION['user'] ?></a>
            </li>
            <li>
              <a class="px-3 py-1 text-yellow-400 hover:bg-yellow-400 hover:text-stone-800 font-semibold transition-all ease-in-out duration-150 border-2 border-yellow-400 rounded-sm" href="logout.php">Logout</a>
            </li>
          <?php else : ?>
        </ul>
        <div class="btn flex md:flex-row flex-col md:flex-wrap text-center gap-7">
          <a class="bg-yellow-400 hover:bg-transparent hover:text-yellow-400 transition-all ease-in-out duration-150 border-2 border-yellow-400 px-3 py-1 rounded-sm text-stone-800 font-semibold" href="signup.php">Sign Up</a>
          <a class="px-3 py-1 text-yellow-400 hover:bg-yellow-400 hover:text-stone-800 font-semibold transition-all ease-in-out duration-150 border-2 border-yellow-400 rounded-sm" href="login.php">Login</a>
        </div>
      <?php endif; ?>
      </div>
    </div>
  </nav>
  <main class="mt-16 min-h-screen">
    <div class="mx-auto max-w-4xl p-3 sm:p-0">
      <div class="p-2 ring-2 ring-stone-700 rounded-md">
        <img src="../src/assets/produk/<?= $row['gambar'] ?>" alt="produk" class="block w-full rounded-md" />
        <div class="details mt-3">
          <h1 class="font-bold text-lg">Deskripsi</h1>
          <p class="text-xs">
            <?= $row['deskripsi'] ?>
          </p>
          <h1 class="font-bold text-lg mt-3">Harga (Rp.)</h1>
          <p class="text-xs font-medium">Rp. <?= $row['harga'] ?> / day</p>
          <h1 class="font-bold text-lg mt-3">Pemesanan</h1>
          <form action="" method="get">
            <input type="text" class="hidden" name="id" id="id" value="<?= $id ?>">
            <input type="text" class="hidden" name="harga" id="harga" value="<?= $row['harga'] ?>">
            <label for="waktu" class="text-xs font-medium block mb-3">
              <span>Waktu: </span>
              <input type="number" name="waktu" id="waktu" class="p-1 outline-none border border-stone-800 rounded" />
              <span>Hari</span>
            </label>
            <label for="jumlah" class="text-xs font-medium block">
              <span>Jumlah: </span>
              <input type="number" name="jumlah" id="jumlah" class="p-1 outline-none border border-stone-800 rounded" />
              <span>Barang</span>
            </label>
            <button name="addcart" class="my-3 font-bold bg-stone-800 text-white p-2 w-full rounded-md">
              Tambahkan ke keranjang
            </button>
          </form>
          <?php
          if (isset($_GET['addcart'])) {
            $iduser = $_SESSION['id_user'];
            $idproduk = $_GET['id'];
            $hari = $_GET['waktu'];
            $jumlah = $_GET['jumlah'];
            $total = $_GET['harga'] * $jumlah * $hari;
            $insert = mysqli_query($mysqli, "INSERT INTO keranjang (id_produk, id_user, hari, total, jumlah) VALUES( $idproduk, $iduser, $hari, $total, $jumlah)");
            if ($insert) {
              echo "<script>window.location.href='keranjang.php'</script>";
              exit();
            }
          } ?>
        </div>
      </div>
    </div>
  </main>
  <footer class="bg-stone-700 p-3 text-sm text-center text-white mt-6">
    <p class="font-semibold">Copyright &copy; 2023 by Mallexibra</p>
  </footer>
  <script src="../src/style/script.js"></script>
</body>

</html>