<?php

session_start();
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit();
}

if (!isset($_GET['idtrx'])) {
  echo "<script>window.location.href='keranjang.php'</script>";
}

include '../src/model/conDB.php';
$idtrx = $_GET['idtrx'];

$query = mysqli_query($mysqli, "SELECT dtl.jumlah AS jumlah, dtl.hari AS hari, dtl.total AS harga ,pr.nama AS nama, usr.nama AS namauser, usr.alamat AS alamat, trx.status AS status FROM detail_transaksi AS dtl LEFT JOIN produk AS pr ON dtl.id_produk = pr.id LEFT JOIN user AS usr ON dtl.id_user = usr.id LEFT JOIN transaksi AS trx ON trx.id = dtl.id_transaksi WHERE dtl.id_transaksi = $idtrx")

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CAFESTUFF | Nota Pembayaran</title>
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
  <main class="mt-20 min-h-screen">
    <h1 class="text-center text-xl text-stone-800 font-bold my-5">
      NOTA PEMBAYARAN
    </h1>
    <div class="max-w-md mx-auto">
      <table class="table-auto text-center w-full text-sm text-stone-500">
        <thead class="text-xs text-stone-700 uppercase bg-stone-100">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Hari</th>
            <th>Harga</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          $alamat = "";
          $hargabayar = 0;
          $status; ?>
          <?php while ($row = mysqli_fetch_assoc($query)) : ?>
            <tr class="bg-white border-b text-stone-900">
              <th scope="row" class="px-2 py-4 font-medium whitespace-nowrap">
                <?= $no ?>
              </th>
              <td><?= $row['nama'] ?></td>
              <td><?= $row['jumlah'] ?></td>
              <td><?= $row['hari'] ?></td>
              <td>Rp. <?= $row['harga'] ?></td>
            </tr>
            <?php $no++;
            $alamat = $row['alamat'];
            $hargabayar = $hargabayar + $row['harga'];
            $status = $row['status'] ?>
          <?php endwhile; ?>
          <tr class="bg-white border-b text-stone-900">
            <th scope="row" colspan="4" class="p-2 font-semibold text-xs whitespace-nowrap">
              TOTAL BAYAR
            </th>
            <th scope="row" class="p-2 font-semibold text-xs whitespace-nowrap">
              Rp. <?= $hargabayar; ?>
            </th>
          </tr>
        </tbody>
      </table>
      <div class="card mt-7 bg-stone-700 p-3 rounded-md text-white">
        <h1 class="font-bold text-base">
          ID PESANAN #<?= $idtrx ?>
          <span class="bg-stone-600 text-center p-1 rounded-md mt-5 ml-3 font-semibold text-xs"><?= $status ?></span>
        </h1>
        <p class="text-xs my-3">
          Akan dikirimkan ke <?= $alamat ?>
        </p>
        <p class="text-xs font-bold">
          Siapkan uang sebesar
          <span class="bg-yellow-600 ml-3 py-1 px-3 inline-block">Rp. <?= $hargabayar; ?></span>
        </p>
      </div>
    </div>
  </main>
  <footer class="bg-stone-700 p-3 text-sm text-center text-white mt-6">
    <p class="font-semibold">Copyright &copy; 2023 by Mallexibra</p>
  </footer>
  <script src="../src/style/script.js"></script>
</body>

</html>