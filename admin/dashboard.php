<?php

session_start();
include '../src/model/conDB.php';
if (!isset($_SESSION['name'])) {
  header("Location: login.php");
  exit();
}

$result = mysqli_query($mysqli, "SELECT * FROM user");

$query = mysqli_query($mysqli, "SELECT p.id AS id_produk, p.gambar, p.nama AS nama_produk, p.harga, p.stok, kp.nama AS nama_kategori, p.deskripsi FROM produk AS p INNER JOIN kategori_produk AS kp ON p.kategori = kp.id");
$laporan = mysqli_query($mysqli, "SELECT trx.id AS id, usr.nama AS nama, trx.tanggal AS tanggal, trx.total AS total, trx.status AS status FROM transaksi AS trx LEFT JOIN user AS usr ON trx.id_user = usr.id WHERE trx.id_user = usr.id");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin</title>
  <link rel="stylesheet" href="../src/style/style.css?v=<?php echo time(); ?>" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>

<body>
  <nav class="bg-stone-700 fixed top-0 w-full text-white flex justify-between p-3">
    <div class="brand flex gap-3 items-center">
      <img src="../src/assets/image/cafestuff.png" class="w-6" alt="logo" />
      <h1 class="font-extrabold">CAFESTUFF</h1>
    </div>
    <div class="name_admin flex items-center gap-3">
      <h1 class="font-bold"><?php echo $_SESSION["name"]; ?></h1>
      <img src="../src/assets/icons/arrow.png" class="w-5 rotate-180 cursor-pointer" id="arrow_nav_admin" alt="arrow" />
      <ul class="bg-stone-600 text-xs hidden overflow-hidden font-semibold border border-stone-500 absolute right-3 -bottom-5 rounded" id="nav_admin">
        <li>
          <a href="logout.php" class="px-2 py-1 inline-block transition-all duration-300 ease-in-out hover:bg-stone-800">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <main class="min-h-screen mt-12">
    <section class="sidebar flex flex-col gap-6 w-max md:min-w-max fixed left-0 min-h-screen px-3 py-10 bg-stone-700 group">
      <a href="dashboard.php" class="hover:bg-stone-800 sidebar_active rounded-md flex items-center gap-3 p-2">
        <img src="../src/assets/icons/home.png" alt="home" class="icon w-8" />
        <h1 class="font-bold text-white hidden md:block group-hover:block">
          Dashboard
        </h1>
      </a>
      <a href="users.php" class="hover:bg-stone-800 rounded-md flex items-center gap-3 p-2">
        <img src="../src/assets/icons/user.png" alt="user" class="icon w-8" />
        <h1 class="font-bold text-white hidden md:block group-hover:block">
          Data Users
        </h1>
      </a>
      <a href="produk.php" class="hover:bg-stone-800 rounded-md flex items-center gap-3 p-2">
        <img src="../src/assets/icons/product.png" alt="produk" class="icon w-8" />
        <h1 class="font-bold text-white hidden md:block group-hover:block">
          Data Produk
        </h1>
      </a>
      <a href="laporan.php" class="hover:bg-stone-800 rounded-md flex items-center gap-3 p-2">
        <img src="../src/assets/icons/report.png" alt="laporan" class="icon w-8" />
        <h1 class="font-bold text-white hidden md:block group-hover:block">
          Laporan
        </h1>
      </a>
    </section>
    <section class="ml-20 mt-4 md:ml-48">
      <div class="w-full p-5">
        <h1 class="text-center w-full mx-auto block text-2xl text-stone-700 font-extrabold">
          DASHBOARD PAGE
        </h1>
      </div>
      <div class="max-w-xl mx-auto">
        <canvas id="myChart"></canvas>
      </div>
      <div class="overflow-x-scroll my-8 grid place-items-center mx-auto">
        <table class="text-center w-max text-sm text-stone-500">
          <thead class="text-xs text-white uppercase bg-stone-700">
            <th class="p-3">NO</th>
            <th>NAMA</th>
            <th>USERNAME</th>
            <th>PASSWORD</th>
            <th>ALAMAT</th>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
              <tr class="bg-white border-b text-stone-900">
                <td class="px-2 py-4 border font-medium whitespace-nowrap">
                  <?= $no ?>
                </td>
                <td class="px-2 py-4 border font-medium whitespace-nowrap">
                  <?= $row['nama'] ?>
                </td>
                <td class="px-2 py-4 border font-medium whitespace-nowrap">
                  <?= $row['username'] ?>
                </td>
                <td class="px-2 py-4 border font-medium whitespace-nowrap">
                  <?= $row['password'] ?>
                </td>
                <td class="px-2 py-4 border font-medium">
                  <?= $row['alamat'] ?>
                </td>
              </tr>
              <?php $no++; ?>
            <?php endwhile ?>
          </tbody>
        </table>
      </div>
      <div class="overflow-x-scroll my-8 grid place-items-center mx-auto">
        <table class="text-center w-max text-sm text-stone-500">
          <thead class="text-xs text-white uppercase bg-stone-700">
            <th class="p-3">NO</th>
            <th>GAMBAR</th>
            <th>NAMA</th>
            <th>HARGA</th>
            <th>STOK</th>
            <th>KATEGORI</th>
            <th>DESCRIPTION</th>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($query)) : ?>
              <tr class="bg-white border-b text-stone-900">
                <td class="px-2 py-4 border font-medium whitespace-nowrap">
                  <?= $no ?>
                </td>
                <td class="px-2 py-4 border font-medium whitespace-nowrap">
                  <img src="../src/assets/produk/<?= $row['gambar'] ?>" alt="Gambar Produk" width="120px">
                </td>
                <td class="px-2 py-4 border font-medium whitespace-nowrap">
                  <?= $row['nama_produk'] ?>
                </td>
                <td class="px-2 py-4 border font-medium whitespace-nowrap">
                  Rp. <?= $row['harga'] ?>
                </td>
                <td class="px-2 py-4 border font-medium whitespace-nowrap">
                  <?= $row['stok'] ?>
                </td>
                <td class="px-2 py-4 border font-medium whitespace-nowrap">
                  <?= $row['nama_kategori'] ?>
                </td>
                <td class="px-2 py-4 border font-medium" width="400">
                  <?= $row['deskripsi'] ?>
                </td>
              </tr>
              <?php $no++; ?>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
      <div class="overflow-x-scroll my-8 grid place-items-center mx-auto">
        <table class="text-center w-max text-sm text-stone-500">
          <thead class="text-xs text-white uppercase bg-stone-700">
            <th class="p-3">NO</th>
            <th>NAMA</th>
            <th>TANGGAL</th>
            <th>TOTAL</th>
            <th>STATUS</th>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($laporan)) : ?>
              <tr class="bg-white border-b text-stone-900">
                <td class="px-2 py-4 border font-medium whitespace-nowrap">
                  <?= $no ?>
                </td>
                <td class="px-2 py-4 border font-medium whitespace-nowrap">
                  <?= $row['nama'] ?>
                </td>
                <td class="px-2 py-4 border font-medium whitespace-nowrap">
                  <?= $row['tanggal'] ?>
                </td>
                <td class="px-2 py-4 border font-medium whitespace-nowrap">
                  <?= $row['total'] ?>
                </td>
                <td class="px-2 py-4 border font-medium whitespace-nowrap">
                  <a href="status.php?idtransaksi=<?= $row['id'] ?>&status=<?= $row['status'] ?>" class="py-2 px-4 bg-blue-600 hover:bg-blue-500 transition-all duration-300 ease-in-out rounded-md text-white font-semibold"><?= $row['status'] ?></a>
                </td>
              </tr>
              <?php $no++; ?>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>
  <footer class="bg-stone-700 p-3 text-sm text-center text-white">
    <p class="font-semibold">Copyright &copy; 2023 by Mallexibra</p>
  </footer>
  <script src="../src/style/scriptAdmin.js"></script>

  <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["PENDING", "SUCCESS", "RETURNED"],
        datasets: [{
          label: '',
          data: [
            <?php
            $jumlah_pending = mysqli_query($mysqli, "select * from transaksi where status='PENDING'");
            echo mysqli_num_rows($jumlah_pending);
            ?>,
            <?php
            $jumlah_success = mysqli_query($mysqli, "select * from transaksi where status='SUCCESS'");
            echo mysqli_num_rows($jumlah_success);
            ?>,
            <?php
            $jumlahreturned = mysqli_query($mysqli, "select * from transaksi where status='RETURNED'");
            echo mysqli_num_rows($jumlahreturned);
            ?>,
          ],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)'
          ],
          borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              // beginAtZero: false
            }
          }]
        }
      }
    });
  </script>
</body>

</html>