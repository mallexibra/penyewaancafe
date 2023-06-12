<?php

session_start();
include '../src/model/conDB.php';

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit();
}

if (isset($_GET['search'])) {
  $keyword = $_GET['search'];
  $query = mysqli_query($mysqli, "SELECT * FROM produk WHERE nama LIKE '%" . $keyword . "%'");
} else {
  $query = mysqli_query($mysqli, "SELECT * FROM produk");
}

$category = mysqli_query($mysqli, "SELECT * FROM kategori_produk");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CAFESTUFF | Sewa Barang</title>
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
              <a class="hover:scale-110 text-sm font-bold inline-block" href="profile.php?id=<?= $_SESSION['id_user'] ?>"><?= $_SESSION['user'] ?></a>
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
  <main class="mt-16 w-full min-h-screen">
    <div class="mx-auto max-w-4xl px-3 sm:p-0">
      <form method="get" class="search p-3 flex justify-center items-center gap-3">
        <input class="bg-stone-700/50 ring-2 ring-stone-700 outline-none placeholder:italic placeholder:text-stone-300 p-2 rounded-md w-3/4" type="text" placeholder="Cari barangmu disini" name="search" id="search" />
        <button class="bg-stone-700 p-3 text-white rounded-md text-sm">
          Search
        </button>
      </form>
      <div class="category flex gap-x-3 overflow-x-scroll p-3" id="category">
        <span class="active_category px-3 py-2 ring-2 ring-stone-700 cursor-pointer rounded-md" name="all" id="category_item">Semua</span>
        <?php while ($row = mysqli_fetch_assoc($category)) : ?>
          <span class="ring-2 ring-stone-700 block min-w-max cursor-pointer rounded-md px-3 py-2" name="<?= $row['id'] ?>" id="category_item"><?= $row['nama'] ?></span>
        <?php endwhile; ?>
      </div>
      <section class="mt-3 flex gap-4 justify-center flex-wrap" id="produk">
        <?php while ($row = mysqli_fetch_assoc($query)) : ?>
          <span class="card w-52 inline-flex flex-col bg-stone-500 text-white rounded-md overflow-hidden ring-2 ring-stone-700">
            <img src="../src/assets/produk/<?= $row['gambar'] ?>" alt="" class="w-52 rounded-sm inline-block" />
            <div class="p-2">
              <h2 class="font-bold"><?= $row['nama'] ?></h2>
              <p class="text-xs pb-2">Rp. <?= $row['harga'] ?> / day</p>
              <a class="bg-stone-800 hover:bg-stone-700 block text-center rounded-md text-xs font-bold p-2" href="detailproduk.php?id=<?= $row['id'] ?>">Lihat Detail</a>
            </div>
          </span>
        <?php endwhile; ?>
      </section>
    </div>
  </main>
  <footer class="bg-stone-700 p-3 text-sm text-center text-white mt-6">
    <p class="font-semibold">Copyright &copy; 2023 by Mallexibra</p>
  </footer>

  <script src="../src/style/script.js"></script>
  <script>
    const category = document.getElementById("category");
    const category_item = document.querySelectorAll("#category_item");
    const page = document.getElementById("produk");
    category_item.forEach((e) => {
      e.addEventListener("click", () => {
        category_item.forEach((i) => {
          i.classList.remove("active_category")
        })
        e.classList.add("active_category");
        let id = e.getAttribute('name');
        if (id == "all") {
          fetchDataAll(page);
        } else {
          fetchData(id, page);
        }
      })
    })

    function fetchData(id, page) {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          page.innerHTML = xhr.responseText;
        }
      };
      xhr.open("GET", "fetch_data.php?id=" + id, true);
      xhr.send();
    }

    function fetchDataAll(page) {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          page.innerHTML = xhr.responseText;
        }
      };
      xhr.open("GET", "fetch_data_all.php", true);
      xhr.send();
    }
  </script>
</body>

</html>