<?php

include '../src/model/conDB.php';

$id = $_GET['id'];

$query = mysqli_query($mysqli, "SELECT * FROM produk WHERE kategori=$id");

?>
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