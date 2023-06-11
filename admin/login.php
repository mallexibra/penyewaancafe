<?php
session_start();
include '../src/model/conDB.php';
$result = mysqli_query($mysqli, "SELECT * FROM admin");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Admin</title>
  <link rel="stylesheet" href="../src/style/style.css" />
</head>

<body class="font-poppins">
  <main class="w-full min-h-screen bg-yellow-100 grid place-items-center">
    <form action="#" method="post" class="flex flex-col w-4/5 md:w-5/12 bg-stone-700 text-white p-6 rounded-md shadow-lg">
      <h1 class="text-center font-extrabold text-2xl">LOGIN ADMIN</h1>
      <p class="text-center text-xs my-3">Silahkan login dengan akun anda!</p>
      <label for="username" class="flex flex-col mt-5 mb-3">
        <span class="font-semibold">Username</span>
        <input type="text" class="p-2 text-white text-xs bg-white/30 rounded-sm outline-none ring-2 ring-stone-400" name="username" id="username" />
      </label>
      <label for="password" class="flex flex-col mb-3">
        <span class="font-semibold">Password</span>
        <input type="password" class="p-2 text-white text-xs bg-white/30 rounded-sm outline-none ring-2 ring-stone-400" name="password" id="password" maxlength="8" />
      </label>
      <button type="submit" name="submit" class="w-full p-3 bg-stone-900 rounded font-bold">
        Login
      </button>
      <a href="../users/login.html" class="text-center text-xs mt-2 text-yellow-500 italic underline">Login Sebagai User</a>
    </form>
  </main>
  <?php

  if (isset($_POST['submit'])) {
    $username_user = $_POST['username'];
    $password_user = $_POST['password'];
    while ($row = mysqli_fetch_assoc($result)) {
      $username = $row["username"];
      $password = $row["password"];
      if ($username == $username_user && $password == $password_user) {
        $_SESSION['name'] = strtoupper($row["nama"]);
        header("Location: dashboard.php");
        exit();
      } else {
        echo "<script>alert('Username/Password anda salah!')</script>";
      }
    }
  }

  ?>


</body>

</html>