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

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CAFESTUFF | Edit Profile</title>
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
    <h1 class="text-center font-bold text-2xl my-3">EDIT PROFILE</h1>
    <form action="" method="post" class="flex flex-col">
      <!-- <img src="../src/assets/image/card.jpg" class="block w-44 h-44 ring-2 ring-stone-800 rounded-md mx-auto object-cover" alt="image_profile" />
      <label for="profile" class="mx-auto flex flex-row items-center cursor-pointer gap-3 text-blue-700 font-semibold my-3">
        <img src="../src/assets/icons/camera.png" class="w-5" alt="icon_camera" />
        <span>Ubah Profile</span>
        <input type="file" class="hidden" name="profile" id="profile" />
      </label> -->
      <label for="nama" class="flex flex-col my-3">
        <span class="font-semibold">Nama</span>
        <input type="text" class="w-full text-xs ring-2 ring-stone-700 p-2 rounded-md" value="<?= $row['nama'] ?>" placeholder="Nama anda ..." name="nama" id="nama" />
      </label>
      <label for="username" class="flex flex-col my-3">
        <span class="font-semibold">Username</span>
        <input type="text" class="w-full text-xs ring-2 ring-stone-700 p-2 rounded-md" value="<?= $row['username'] ?>" placeholder="Username anda ..." name="username" id="username" />
      </label>
      <label for="password" class="flex flex-col my-3">
        <span class="font-semibold">Password</span>
        <input type="password" class="w-full text-xs ring-2 ring-stone-700 p-2 rounded-md" value="<?= $row['password'] ?>" placeholder="Password anda ..." name="password" id="password" />
      </label>
      <label for="alamat" class="flex flex-col my-3">
        <span class="font-semibold">Alamat</span>
        <input type="text" class="w-full text-xs ring-2 ring-stone-700 p-2 rounded-md" value="<?= $row['alamat'] ?>" placeholder="Alamat anda ..." name="alamat" id="alamat" />
      </label>
      <button name="edit" class="w-full bg-stone-700 shadow-md p-2 rounded-md text-white hover:bg-stone-800 transition-all duration-300 font-bold" type="submit">
        Edit Profile
      </button>
      <button name="delete" class="w-full bg-rose-600 shadow-md p-2 my-3 rounded-md text-white hover:bg-rose-700 transition-all duration-300 font-bold" type="submit">
        Delete Profile
      </button>
    </form>
  </main>
  <footer class="bg-stone-700 p-3 text-sm text-center text-white mt-6">
    <p class="font-semibold">Copyright &copy; 2023 by KELOMPOK 3</p>
  </footer>
  <?php

  if (isset($_POST['edit'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $alamat = $_POST['alamat'];

    if (mysqli_query($mysqli, "UPDATE user SET nama='$nama', username='$username', password='$password', alamat='$alamat' WHERE id=$id")) {
      var_dump($_POST);
      echo "<script>window.location.href='profile.php?id=" . $row['id'] .  "'</script>";
      exit();
    }
  } elseif (isset($_POST['delete'])) {
    if (mysqli_query($mysqli, "DELETE FROM user WHERE id = $id")) {
      echo "<script>window.location.href='login.php'</script>";
      exit();
    }
  }

  ?>
  <script src="../src/style/script.js"></script>
</body>

</html>