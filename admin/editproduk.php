<?php

session_start();
include '../src/model/conDB.php';
if (!isset($_SESSION['name'])) {
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];
$query = mysqli_query($mysqli, "SELECT p.id AS id_produk, p.gambar, p.nama AS nama_produk, p.harga, p.stok, kp.id AS idkat, kp.nama AS nama_kategori, p.deskripsi FROM produk AS p INNER JOIN kategori_produk AS kp ON p.kategori = kp.id WHERE p.id =  $id");
$row = mysqli_fetch_assoc($query);

// Mendapatkan kategori
$result = mysqli_query($mysqli, "SELECT * FROM kategori_produk");

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
        EDIT PRODUK
      </h1>
    </div>
    <form action="" method="post" enctype="multipart/form-data" class="mt-4 p-8 text-white max-w-2xl mx-4 my-4 sm:mx-auto flex flex-col rounded-md bg-stone-800 border border-stone-950">
      <input type="text" hidden value="<?= $row['id_produk'] ?>" name="id" id="id">
      <label for="nama" class="my-3 flex flex-col">
        <span class="font-semibold">Nama Produk</span>
        <input type="text" class="p-2 text-stone-800 placeholder:italic placeholder:text-xs outline-none rounded" placeholder="Tambahkan nama produk ..." value="<?= $row['nama_produk'] ?>" name="nama" id="nama" />
      </label>
      <label for="harga" class="my-3 flex flex-col">
        <span class="font-semibold">Harga Produk</span>
        <input type="number" class="p-2 text-stone-800 placeholder:italic placeholder:text-xs outline-none rounded" placeholder="Tambahkan harga produk ..." value="<?= $row['harga'] ?>" name="harga" id="harga" />
      </label>
      <label for="kategori" class="my-3 flex flex-col">
        <span class="font-semibold">Kategori Produk</span>
        <select class="p-2 text-stone-800 outline-none rounded" name="kategori" id="kategori">
          <option value="">Pilih Kategori</option>
          <?php while ($kat = mysqli_fetch_assoc($result)) : ?>
            <option value="<?= $kat['id'] ?>" <?php if ($kat['id'] == $row["idkat"]) echo "selected" ?>><?= $kat["nama"] ?></option>
          <?php endwhile; ?>
        </select>
      </label>
      <label for="gambar" class="my-3 flex flex-col">
        <span class="font-semibold">Gambar Produk</span>
        <input type="file" value="../src/assets/produk/6484ea1ebcc1f_feima.jpg" class="outline-none rounded" name="gambar" id="gambar" />
      </label>
      <label for="deskripsi" class="my-3 flex flex-col">
        <span class="font-semibold">Deskripsi Produk</span>
        <textarea class="p-2 text-stone-800 placeholder:italic placeholder:text-xs outline-none rounded" placeholder="Tambahkan deskripsi produk ..." name="deskripsi" id="deskripsi" cols="30" rows="5"><?= $row['deskripsi'] ?></textarea>
      </label>
      <button type="submit" name="editproduk" class="bg-yellow-500 p-2 rounded font-semibold text-stone-800 hover:bg-yellow-400 transition-all duration-300">
        Edit Produk
      </button>
    </form>
  </main>
  <footer class="bg-stone-700 p-3 text-sm text-center text-white">
    <p class="font-semibold">Copyright &copy; 2023 by Mallexibra</p>
  </footer>

  <?php

  if (isset($_POST['editproduk'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $gambarlama = "../src/assets/produk/" . $row['gambar'];
    $gambarbaru = uniqid() . '_' . $_FILES['gambar']['name'];

    if (move_uploaded_file($gambarlama, $gambarbaru)) {
      unlink($gambarlama);
      mysqli_query($mysqli, "UPDATE produk SET nama = '$nama', harga = $harga, kategori = $kategori, deskripsi = '$deskripsi', gambar = '$gambarbaru' WHERE id = $id");
      $_SESSION['alert'] = "Data berhasil diupdate!";
      header("Location: produk.php");
      exit();
    } else {
      $_SESSION['alert'] = "Data berhasil diupdate!";
      header("Location: produk.php");
      exit();
    }
  }

  ?>
</body>

</html>