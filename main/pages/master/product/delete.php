<?php
$id = $_GET['id'];
$deleteData =  deleteData('tb_product', 'id = ' . intval($id));

if ($deleteData) {
  echo "<script>
          alert('Success to delete product');
          document.location.href='index.php?page=master-product';
        </script>";
} else {
  echo "<script>
          alert('Failed to delete product');
          document.location.href='index.php?page=master-product';
        </script>";
}
