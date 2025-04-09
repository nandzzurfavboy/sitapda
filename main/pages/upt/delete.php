<?php
$id = $_GET['id'];
$deleteData = deleteData('tb_upt', 'id = ' . intval($id));

if ($deleteData) {
  echo "<script>
          alert('Success to delete UPT');
          document.location.href='index.php?page=master-upt';
        </script>";
} else {
  echo "<script>
          alert('Failed to delete UPT');
          document.location.href='index.php?page=master-upt';
        </script>";
}
