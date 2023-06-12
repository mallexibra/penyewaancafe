<?php

session_start();
include '../src/model/conDB.php';

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit();
}

$id = $_SESSION['id_user'];

$query = mysqli_query($mysqli, "SELECT * FROM user WHERE id = $id");
$row = mysqli_fetch_assoc($query);

$check = mysqli_query($mysqli, "SELECT id FROM transaksi WHERE id_user=$id");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CAFESTUFF | Profile User</title>
  <link rel="stylesheet" href="../src/style/style.css?v=<?php echo time(); ?>" />
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
  <main class="mt-20 min-h-screen max-w-md mx-auto">
    <div class="profile max-w-md md:flex md:justify-center md:items-center mx-auto">
      <!-- <img src="../src/assets/image/card.jpg" class="w-44 h-44 shadow-lg ring-2 ring-stone-800 mx-auto rounded-md object-cover object-center" alt="profile_user" /> -->
      <div class="flex flex-col mt-4 md:text-left text-center">
        <h1 class="font-bold text-center text-stone-800"><?= $row['nama'] ?></h1>
        <p class="text-xs text-center">@<?= $row['username'] ?> | <?= $row['alamat'] ?></p>
        <div class="text-xs flex justify-center items-center gap-3 font-bold mt-3">
          <a href="produk.php" class="bg-stone-800 inline-block text-white px-3 py-2 rounded-md">
            Sewa Sekarang
          </a>
          <a href="editprofile.php?id=<?= $row['id'] ?>" class="bg-stone-400 text-stone-800 px-3 py-2 rounded-md">
            Edit Profile
          </a>
        </div>
      </div>
    </div>
    <div class="riwayat mt-12">
      <h1 class="text-center font-bold my-7">Riwayat Pemesanan</h1>
      <section>
        <?php while ($row = mysqli_fetch_assoc($check)) : ?>
          <?php
          $a = $row['id'];
          $br = mysqli_query($mysqli, "SELECT SUM(jumlah) AS jumlah FROM detail_transaksi WHERE id_transaksi = $a");
          $c = mysqli_fetch_assoc($br);
          ?>
          <a href="checkout.php?idtrx=<?= $row['id'] ?>" class="bg-stone-800 relative mb-5 text-white block p-3 rounded-md">
            <img src="../src/assets/icons/arrow-to-top-24.png" class="absolute right-2 top-2" alt="arrow-to-top" />
            <h1 class="font-bold">Pemesanan Nomor #<?= $row['id'] ?></h1>
            <p class="text-xs"><?= $c['jumlah'] ?> Barang</p>
          </a>
        <?php endwhile; ?>
      </section>
    </div>
  </main>
  <footer class="bg-stone-700 p-3 text-sm text-center text-white mt-6">
    <p class="font-semibold">Copyright &copy; 2023 by Mallexibra</p>
  </footer>
  <script src="../src/style/script.js"></script>
</body>

</html>