<?php

session_start();
include '../src/model/conDB.php';
if (!isset($_SESSION['name'])) {
  header("Location: login.php");
  exit();
}

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
        TAMBAH PRODUK
      </h1>
    </div>
    <form action="" method="post" enctype="multipart/form-data" class="mt-4 p-8 text-white max-w-2xl mx-4 my-4 sm:mx-auto flex flex-col rounded-md bg-stone-800 border border-stone-950">
      <label for="nama" class="my-3 flex flex-col">
        <span class="font-semibold">Nama Produk</span>
        <input type="text" class="p-2 text-stone-800 placeholder:italic placeholder:text-xs outline-none rounded" placeholder="Tambahkan nama produk ..." name="nama" id="nama" />
      </label>
      <label for="harga" class="my-3 flex flex-col">
        <span class="font-semibold">Harga Produk</span>
        <input type="number" class="p-2 text-stone-800 placeholder:italic placeholder:text-xs outline-none rounded" placeholder="Tambahkan harga produk ..." name="harga" id="harga" />
      </label>
      <label for="stok" class="my-3 flex flex-col">
        <span class="font-semibold">Stok Produk</span>
        <input type="number" class="p-2 text-stone-800 placeholder:italic placeholder:text-xs outline-none rounded" placeholder="Tambahkan stok produk ..." name="stok" id="stok" />
      </label>
      <label for="kategori" class="my-3 flex flex-col">
        <span class="font-semibold">Kategori Produk</span>
        <select class="p-2 text-stone-800 outline-none rounded" name="kategori" id="kategori">
          <option value="">Pilih Kategori</option>
          <?php while ($kat = mysqli_fetch_assoc($result)) : ?>
            <option value="<?= $kat['id'] ?>"><?= $kat['nama']; ?></option>
          <?php endwhile; ?>
        </select>
      </label>
      <label for="gambar" class="my-3 flex flex-col">
        <span class="font-semibold">Gambar Produk</span>
        <input type="file" accept="image/*" class="outline-none rounded" name="gambar" id="gambar" />
      </label>
      <label for="deskripsi" class="my-3 flex flex-col">
        <span class="font-semibold">Deskripsi Produk</span>
        <textarea class="p-2 text-stone-800 placeholder:italic placeholder:text-xs outline-none rounded" placeholder="Tambahkan deskripsi produk ..." name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea>
      </label>
      <button type="submit" name="addproduk" class="bg-yellow-500 p-2 rounded font-semibold text-stone-800 hover:bg-yellow-400 transition-all duration-300">
        Tambah Produk
      </button>
    </form>
  </main>
  <footer class="bg-stone-700 p-3 text-sm text-center text-white">
    <p class="font-semibold">Copyright &copy; 2023 by Mallexibra</p>
  </footer>

  <?php

  if (isset($_POST['addproduk'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];

    // Simpan gambar
    $gambar = uniqid() . '_' . $_FILES['gambar']['name'];
    $file_tmp = $_FILES['gambar']['tmp_name'];
    $file_destination = "../src/assets/produk/" . $gambar;
    // Move the uploaded file to the desired destination
    move_uploaded_file($file_tmp, $file_destination);

    $sql = "INSERT INTO produk (nama, harga, stok, kategori, deskripsi, gambar) VALUES ('$nama', $harga, $stok, $kategori, '$deskripsi', '$gambar')";
    if (mysqli_query($mysqli, $sql)) {
      $_SESSION['alert'] = "Produk berhasil ditambahkan!";
      header("Location: produk.php");
      exit();
    } else {
      $_SESSION['alert'] = "Produk gagal ditambahkan!";
      header("Location: produk.php");
      exit();
    }
  }

  ?>

</body>

</html>