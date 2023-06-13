<?php

session_start();
include 'src/model/conDB.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CAFESTUFF</title>
  <link rel="stylesheet" href="src/style/style.css?v=<?php echo time(); ?>" />
  <script src="https://kit.fontawesome.com/d2632f5afd.js" crossorigin="anonymous"></script>
</head>

<body class="font-poppins bg-stone-800">
  <nav class="bg-stone-800/90 backdrop-blur-sm fixed top-0 z-10 w-full p-4 text-white">
    <div class="relative flex justify-center md:justify-between items-center mx-auto max-w-4xl">
      <div class="nav_brand flex justify-center items-center gap-3">
        <img src="src/assets/image/cafestuff.png" alt="logo" class="w-6" />
        <h1 class="sm:text-2xl text-xl font-extrabold">CAFESTUFF</h1>
      </div>
      <img class="absolute right-0 w-9 md:hidden cursor-pointer" src="src/assets/icons/burger_menu.png" alt="burger_menu" id="burger_menu" />
      <div id="sidebar" class="list_item text-sm font-medium fixed md:static md:bg-transparent bg-stone-800/90 w-[70%] h-screen md:h-auto top-[60px] right-0 hidden md:flex md:flex-row flex-col md:justify-end justify-center items-center gap-7">
        <ul class="flex flex-col md:flex-row text-center gap-7">
          <li>
            <a class="hover:scale-110 text-sm inline-block" href="index.php">Dashboard</a>
          </li>
          <li>
            <a class="hover:scale-110 text-sm inline-block" href="users/produk.php">Sewa Barang</a>
          </li>
          <li>
            <a class="hover:scale-110 text-sm inline-block" href="users/keranjang.php">Keranjang</a>
          </li>
          <?php if (isset($_SESSION['user'])) : ?>
            <li>
              <a class="hover:scale-110 text-sm inline-block" href="users/editprofile.php">Edit Profile</a>
            </li>
            <li>
              <a class="hover:scale-110 text-sm font-bold inline-block" href="users/profile.php"><?= $_SESSION['user'] ?></a>
            </li>
            <li>
              <a class="px-3 py-1 text-yellow-400 hover:bg-yellow-400 hover:text-stone-800 font-semibold transition-all ease-in-out duration-150 border-2 border-yellow-400 rounded-sm" href="users/logout.php">Logout</a>
            </li>
          <?php else : ?>
        </ul>
        <div class="btn flex md:flex-row flex-col md:flex-wrap text-center gap-7">
          <a class="bg-yellow-400 hover:bg-transparent hover:text-yellow-400 transition-all ease-in-out duration-150 border-2 border-yellow-400 px-3 py-1 rounded-sm text-stone-800 font-semibold" href="users/signup.php">Sign Up</a>
          <a class="px-3 py-1 text-yellow-400 hover:bg-yellow-400 hover:text-stone-800 font-semibold transition-all ease-in-out duration-150 border-2 border-yellow-400 rounded-sm" href="users/login.php">Login</a>
        </div>
      <?php endif; ?>
      </div>
    </div>
  </nav>
  <header style="background-image: url('src/assets/image/cafe.jpg');" class="w-full min-h-[300px] bg-[url('/src/assets/image/cafe.jpg')]">
    <div class="bungkus w-full h-full backdrop-blur-sm bg-stone-700/30">
      <div class="containers flex justify-center items-center flex-col">
        <div class="header-items">
          <h1 class="pt-12 font-bold text-4xl text-white text-center">
            LOREM IPSUM
          </h1>
          <p class="p-8 text-lg text-center text-white">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit.
            Similique fugit voluptatum non veritatis ad illum. Consectetur
            autem esse nulla, reiciendis deleniti asperiores ipsum! Laudantium
            autem quia quae est? Molestiae, placeat?
          </p>
          <div class="cta flex items-center justify-center pt-8">
            <a href="users/produk.php" class="flex gap-2 text-stone-800 font-bold border border-yellow-400 bg-yellow-500 hover:bg-yellow-400 transition-all duration-300 focus:ring-4 focus:ring-stone-300 rounded-lg text-sm px-7 py-4 mr-2 mb-2 focus:outline-none">Pesan Sekarang <img src="src/assets/icons/arrow-r.png" alt="" /></a>
          </div>
        </div>
      </div>
    </div>
  </header>
  <main class="containers p-3">
    <section class="my-12 text-white">
      <h1 class="text-center text-2xl pb-4 font-bold">
        TENTANG KAMI
      </h1>
      <div class="items-wrap flex justify-center items-center gap-3">
        <img class="hidden md:block w-[35%] rounded-xl" src="src/assets/image/cafestuffabout.png" alt="Cafestuff About Image">
        <p class="md:text-justify text-center text-sm max-w-xl md:text-base">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem
          odio, rem quod ab sed, in odit quaerat voluptas, fugiat inventore
          laudantium nemo reprehenderit laboriosam at quo cupiditate totam
          cumque officia minus vitae! Suscipit repellendus numquam magni
          facilis eum, voluptas non perferendis architecto esse, iste libero
          dicta saepe? Sed, iusto a.
        </p>
      </div>
    </section>

    <h1 class="text-center text-white text-2xl my-4 font-bold">
      LAYANAN KAMI
    </h1>
    <div class="serve-items mt-5 text-white flex flex-col md:flex-row justify-center gap-8">
      <div class="serve-item flex items-center flex-col gap-4">
        <div class="flex items-center justify-center card w-16 h-16 bg-stone-700 text-lg font-bold rounded-full text-center">
          <img class="w-10" src="src/assets/icons/rent.png" alt="Sewa Barang">
        </div>
        <p class="font-semibold">Penyewaan Barang</p>
      </div>
      <div class="serve-item flex items-center flex-col gap-4">
        <div class="flex items-center justify-center card w-16 h-16 bg-stone-700 text-lg font-bold rounded-full text-center">
          <img class="w-10" src="src/assets/icons/package.png" alt="Sewa Barang">
        </div>
        <p class="font-semibold">Pengantaran Barang</p>
      </div>
      <div class="serve-item flex items-center flex-col gap-4">
        <div class="flex items-center justify-center card w-16 h-16 bg-stone-700 text-lg font-bold rounded-full text-center">
          <img class="w-10" src="src/assets/icons/loop.png" alt="Sewa Barang">
        </div>
        <p class="font-semibold">Pengembalian Barang</p>
      </div>
    </div>

    <div class="question-accordion my-24">
      <h1 class="text-center text-white text-2xl mb-8 font-bold">
        Kenapa Pilih Kami?
      </h1>
      <div id="accordion-open" data-accordion="open">
        <h2 id="accordion-open-heading-1">
          <button type="button" class="flex rounded-t-md items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 bg-stone-700" data-accordion-target="#accordion-open-body-1" aria-expanded="false" aria-controls="accordion-open-body-1">
            <span class="flex items-center font-semibold text-white"> Lorem? </span>
            <svg data-accordion-icon class="w-6 h-6 text-white shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
          </button>
        </h2>
        <div id="accordion-open-body-1" class="hidden" aria-labelledby="accordion-open-heading-1">
          <div class="p-5 border border-b-0 bg-stone-600 border-gray-200">
            <p class="text-white">
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Molestias accusamus eveniet dolor totam nulla. Officia
              consequatur tenetur, dolorem omnis, deleniti ut quibusdam amet
              cum incidunt doloribus ducimus est recusandae ea!
            </p>
          </div>
        </div>
        <h2 id="accordion-open-heading-2">
          <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 bg-stone-700" data-accordion-target="#accordion-open-body-2" aria-expanded="false" aria-controls="accordion-open-body-2">
            <span class="flex items-center font-semibold text-white"> Lorem? </span>
            <svg data-accordion-icon class="w-6 h-6 text-white shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
          </button>
        </h2>
        <div id="accordion-open-body-2" class="hidden" aria-labelledby="accordion-open-heading-2">
          <div class="p-5 border border-b-0 border-gray-200 bg-stone-600">
            <p class="text-white">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui,
              aspernatur. Omnis maxime corrupti, ab dicta accusantium error
              repellat beatae nihil adipisci eum eos accusamus aliquid et
              suscipit rem? Beatae, assumenda.
            </p>
          </div>
        </div>
        <h2 id="accordion-open-heading-3">
          <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-gray-200 focus:ring-4 bg-stone-700 rounded-b-md" data-accordion-target="#accordion-open-body-3" aria-expanded="false" aria-controls="accordion-open-body-3">
            <span class="flex items-center font-semibold text-white"> Lorem? </span>
            <svg data-accordion-icon class="w-6 h-6 text-white shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
          </button>
        </h2>
        <div id="accordion-open-body-3" class="hidden" aria-labelledby="accordion-open-heading-3">
          <div class="p-5 border border-t-0 bg-stone-600">
            <p class="text-white">
              Lorem, ipsum dolor sit amet consectetur adipisicing elit.
              Expedita illum praesentium dolores enim! Fugit veritatis itaque
              fugiat nihil accusamus consectetur sapiente, adipisci ad at
              excepturi quod corrupti voluptatem quos deserunt!
            </p>
          </div>
        </div>
      </div>
    </div>
  </main>
  <footer class="bottom-0 bg-stone-700">
    <section class="footer-items p-6 flex items-center flex-col gap-5">
      <div class="logo flex justify-center items-center gap-2">
        <img src="src/assets/image/cafestuff.png" class="w-5 h-5" alt="" />
        <a class="text-2xl text-white font-semibold text-center" href="#">COFFEESTUFF</a>
      </div>
      <ul class="flex gap-4 text-xs text-white">
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="users/produk.php">Sewa Barang</a></li>
        <li><a href="users/keranjang.php">Keranjang</a></li>
      </ul>
      <div class="sosmed-icons flex gap-5">
        <a href="" class="sosmed-items bg-stone-500 w-10 h-10 flex items-center justify-center rounded-full">

          <i class="fa-brands fa-facebook-f" style="color: #ffffff"></i>

        </a>
        <a href="" class="sosmed-items bg-stone-500 w-10 h-10 flex items-center justify-center rounded-full">
          <i class="fa-brands fa-instagram" style="color: #ffffff"></i>
        </a>
        <a href="" class="sosmed-items bg-stone-500 w-10 h-10 flex items-center justify-center rounded-full">
          <i class="fa-brands fa-youtube" style="color: #ffffff"></i>
        </a>
        <a href="" class="sosmed-items bg-stone-500 w-10 h-10 flex items-center justify-center rounded-full">
          <i class="fa-brands fa-tiktok" style="color: #ffffff"></i>
        </a>
      </div>
      <div class="copyright">
        <p class="text-white text-xs">
          &copy; <span id="year"></span> CoffeeStuff. Hak Cipta Dilindungi.
        </p>
      </div>
    </section>
  </footer>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
  <script src="src/style/script.js"></script>

</body>

</html>