<?php

session_start();
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit();
}

include '../src/model/conDB.php';
$id = $_SESSION['id_user'];
$query = mysqli_query($mysqli, "SELECT kr.id AS idkr, kr.total AS total, kr.hari AS hari, kr.jumlah AS jumlah , pr.gambar AS gambar, pr.nama AS nama  FROM keranjang AS kr JOIN produk AS pr ON kr.id_produk = pr.id WHERE kr.id_user=$id");
$queryCount = mysqli_query($mysqli, "SELECT COUNT(id) AS jmlBarang FROM keranjang WHERE id_user=$id");
$count = mysqli_fetch_assoc($queryCount);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CAFESTUFF | Keranjang</title>
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
  <main class="mt-20 min-h-screen">
    <div class="mx-auto max-w-4xl p-3 sm:p-0">
      <h1 class="text-center text-lg text-stone-800 font-bold">
        Keranjang Penyewaan
      </h1>
      <div class="my-5 max-w-md mx-auto">
        <?php $total = 0; ?>
        <?php if (mysqli_num_rows($query) > 0) : ?>
          <?php while ($row = mysqli_fetch_assoc($query)) : ?>
            <span class="flex gap-4 p-3 rounded-md ring-2 my-3 ring-stone-800 justify-between items-center shadow-lg">
              <img src="../src/assets/produk/<?= $row['gambar'] ?>" class="w-24 rounded-sm" alt="cafe" />
              <span class="flex flex-col justify-start">
                <h1 class="font-bold"><?= $row['nama'] ?></h1>
                <div class="text-xs">
                  <span>Jumlah: <?= $row['jumlah'] ?></span> |
                  <span>Waktu: <?= $row['hari'] ?> hari</span>
                </div>
              </span>
              <span>
                <a href="deletekeranjang.php?id=<?= $row['idkr'] ?>" onclick="return confirm('Apakah anda yakin untuk menghapusnya?')" class="px-2 py-1 bg-rose-700 text-white rounded-md text-xs font-semibold">Delete</a>
              </span>
            </span>
            <?php $total = $total + (int)$row['total']; ?>
          <?php endwhile; ?>
          <div class="max-w-md mx-auto">
            <div class="bg-stone-800 rounded-md flex justify-between items-center p-3 text-white">
              <div>
                <h1 class="font-bold"><?= $count['jmlBarang'] ?> Barang</h1>
                <p class="text-xs">Total Bayar: Rp. <?php echo $total; ?></p>
              </div>
              <a href="check.php?total=<?= $total ?>" class="bg-stone-600 px-3 py-2 inline-block text-xs font-semibold rounded-md hover:bg-stone-700 transition-all duration-300">
                Bayar Sekarang
              </a>
            </div>
          </div>
        <?php else : ?>
          <h1 class="text-center text-stone-700 font-bold">Masih Kosong ...</h1>
        <?php endif; ?>
      </div>
    </div>
  </main>
  <footer class="bg-stone-700 p-3 text-sm text-center text-white mt-6">
    <p class="font-semibold">Copyright &copy; 2023 by KELOMPOK 3</p>
  </footer>
  <script src="../src/style/script.js"></script>
</body>

</html>