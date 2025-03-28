<?php
$id = $_GET['id'];
$deleteData = deleteData('tb_category', 'id = ' . intval($id));

if ($deleteData) {
  echo "<script>
          alert('Success to delete category');
          document.location.href='index.php?page=master-category';
        </script>";
} else {
  echo "<script>
          alert('Failed to delete category');
          document.location.href='index.php?page=master-category';
        </script>";
}
