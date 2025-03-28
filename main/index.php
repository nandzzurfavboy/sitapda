<?php require "../db/config.php" ?>
<?php require './sider/routes.php' ?>
<?php require '../components/table/simple-table.php' ?>
<?php require '../components/table/table.php' ?>
<?php require '../components/typography/head-title.php' ?>
<?php require '../utilities/func/auth.php' ?>
<?php require '../utilities/func/query.php' ?>
<?php require '../utilities/func/wa-send.php' ?>

<?php
if (!isset($_SESSION['username'])) {
  header("Location: ../");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../assets/css/index.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
</head>

<body>
  <?php include "./sider/sider.php" ?>
  <?php include "./main.php" ?>

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
  <script>
    $('#datatable-style').DataTable({
      responsive: true
    });
  </script>
</body>

</html>