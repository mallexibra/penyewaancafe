<?php

session_start();
if (!isset($_SESSION['name'])) {
  header("Location: login.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin</title>
  <link rel="stylesheet" href="../src/style/style.css" />
</head>

<body>
  <nav class="bg-stone-700 fixed top-0 w-full text-white flex justify-between p-3">
    <div class="brand flex gap-3 items-center">
      <img src="../src/assets/image/cafestuff.png" class="w-6" alt="logo" />
      <h1 class="font-extrabold">CAFESTUFF</h1>
    </div>
    <div class="name_admin flex items-center gap-3">
      <h1 class="font-bold"><?php echo $_SESSION['name']; ?></h1>
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
      <a href="dashboard.php" class="hover:bg-stone-800 rounded-md flex items-center gap-3 p-2">
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
      <a href="laporan.php" class="hover:bg-stone-800 sidebar_active rounded-md flex items-center gap-3 p-2">
        <img src="../src/assets/icons/report.png" alt="laporan" class="icon w-8" />
        <h1 class="font-bold text-white sidebar_active hidden md:block group-hover:block">
          Laporan
        </h1>
      </a>
    </section>
    <section class="ml-20 mt-4 md:ml-48">
      <div class="w-full p-5">
        <h1 class="text-center w-full mx-auto block text-2xl text-stone-700 font-extrabold">
          LAPORAN PAGE
        </h1>
      </div>
      <div class="overflow-x-scroll md:w-full md:overflow-x-visible max-w-lg grid place-items-center mx-auto">
        <table class="text-center w-max text-sm text-stone-500">
          <thead class="text-xs text-white uppercase bg-stone-700">
            <th class="p-3">NO</th>
            <th>GAMBAR</th>
            <th>NAMA</th>
            <th>STOK</th>
            <th>KATEGORI</th>
            <th>DESCRIPTION</th>
            <th>ACTION</th>
          </thead>
          <tbody>
            <tr class="bg-white border-b text-stone-900">
              <td class="px-2 py-4 border font-medium whitespace-nowrap">
                1
              </td>
              <td class="px-2 py-4 border font-medium whitespace-nowrap">
                NULL
              </td>
              <td class="px-2 py-4 border font-medium whitespace-nowrap">
                NULL
              </td>
              <td class="px-2 py-4 border font-medium whitespace-nowrap">
                NULL
              </td>
              <td class="px-2 py-4 border font-medium whitespace-nowrap">
                NULL
              </td>
              <td class="px-2 py-4 border font-medium">NULL</td>
              <td class="px-2 py-4 border font-medium whitespace-nowrap">
                <a href="#" class="py-2 px-4 bg-blue-600 hover:bg-blue-500 transition-all duration-300 ease-in-out rounded-md text-white font-semibold">Kirim Pesanan</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </main>
  <footer class="bg-stone-700 p-3 text-sm text-center text-white">
    <p class="font-semibold">Copyright &copy; 2023 by Mallexibra</p>
  </footer>
  <script src="../src/style/scriptAdmin.js"></script>
</body>

</html>