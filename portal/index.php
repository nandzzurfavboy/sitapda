<?php require "../db/config.php" ?>
<?php require './header/routes.php' ?>
<?php require '../utilities/func/query.php' ?>
<?php require '../utilities/func/order-cart.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portal</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../assets/css/index.css">
</head>

<body>
  <div class="min-h-screen bg-[#f2f2f2]">
    <?php include './header/header.php' ?>
    <main class="px-10">
      <?php
      if (array_key_exists($page, $pages)) {
        if (is_array($pages[$page])) {
          $fileToInclude = $pages[$page][$action] ?? $pages[$page]['default'];
        } else {
          $fileToInclude = $pages[$page];
        }
      } else {
        require_once 'pages/home/index.php';
      }
      if (file_exists($fileToInclude)) {
        require_once $fileToInclude;
      } else {
        require_once 'pages/home/index.php';
      }
      ?>
    </main>
    <?php include './footer/footer.php' ?>
  </div>
</body>

</html>