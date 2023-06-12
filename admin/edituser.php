<?php

session_start();
include '../src/model/conDB.php';
if (!isset($_SESSION['name'])) {
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];
$result = mysqli_query($mysqli, "SELECT * FROM user WHERE id = $id");
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ADMIN | Edit User</title>
  <link rel="stylesheet" href="../src/style/style.css" />
</head>

<body>
  <nav class="bg-stone-700 fixed top-0 w-full text-white">
    <div class="max-w-4xl mx-auto flex justify-between p-3">
      <div class="brand flex gap-3 items-center">
        <img src="../src/assets/image/cafestuff.png" class="w-6" alt="logo" />
        <h1 class="font-extrabold">CAFESTUFF</h1>
      </div>
      <div class="name_admin flex items-center gap-3">
        <h1 class="font-bold"><?php echo $_SESSION['name']; ?></h1>
      </div>
    </div>
  </nav>
  <main class="min-h-screen mt-12">
    <div class="w-full p-5">
      <h1 class="text-center w-full mx-auto block text-2xl text-stone-700 font-extrabold">
        EDIT USER
      </h1>
    </div>
    <form action="" method="post" class="mt-4 p-8 text-white max-w-2xl mx-4 my-4 sm:mx-auto flex flex-col rounded-md bg-stone-800 border border-stone-950">
      <label for="nama" class="my-3 flex flex-col">
        <span class="font-semibold">Nama User</span>
        <input type="text" class="p-2 text-stone-800 placeholder:italic placeholder:text-xs outline-none rounded" placeholder="Tambahkan nama ..." value="<?= $row['nama'] ?>" name="nama" id="nama" />
      </label>
      <label for="username" class="my-3 flex flex-col">
        <span class="font-semibold">Username</span>
        <input type="text" class="p-2 text-stone-800 placeholder:italic placeholder:text-xs outline-none rounded" placeholder="Tambahkan username ..." value="<?= $row['username'] ?>" name="username" id="username" />
      </label>
      <label for="password" class="my-3 flex flex-col">
        <span class="font-semibold">Password</span>
        <input type="text" class="p-2 text-stone-800 placeholder:italic placeholder:text-xs outline-none rounded" placeholder="Tambahkan password ..." value="<?= $row['password'] ?>" name="password" id="password" maxlength="8" />
      </label>
      <label for="alamat" class="my-3 flex flex-col">
        <span class="font-semibold">Alamat</span>
        <textarea class="p-2 text-stone-800 placeholder:italic placeholder:text-xs outline-none rounded" placeholder="Tambahkan alamat anda ..." name="alamat" id="alamat" cols="30" rows="3"><?= $row['alamat'] ?></textarea>
      </label>
      <button type="submit" name="edituser" class="bg-yellow-500 p-2 rounded font-semibold text-stone-800 hover:bg-yellow-400 transition-all duration-300">
        EDIT USER
      </button>
    </form>
  </main>
  <footer class="bg-stone-700 p-3 text-sm text-center text-white">
    <p class="font-semibold">Copyright &copy; 2023 by Mallexibra</p>
  </footer>

  <?php

  if (isset($_POST['edituser'])) {
    $name = $_POST["nama"];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $alamat = $_POST['alamat'];
    $query = "UPDATE user SET nama = '$name', username = '$username', password = '$password', alamat = '$alamat' WHERE id = $id";
    if (mysqli_query($mysqli, $query)) {
      $_SESSION['alert'] = 'Data user berhasil diubah';
      header("Location: users.php");
      exit();
    } else {
      $_SESSION['alert'] = 'Data user gagal diubah';
      header("Location: users.php");
      exit();
    }
  }

  ?>
</body>

</html>