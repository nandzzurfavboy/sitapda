<?php
$id = $_GET['id'];
$deleteData = deleteData('tb_unit', 'id = ' . intval($id));

if ($deleteData) {
  echo "<script>
          alert('Success to delete unit');
          document.location.href='index.php?page=master-unit';
        </script>";
} else {
  echo "<script>
          alert('Failed to delete unit');
          document.location.href='index.php?page=master-unit';
        </script>";
}
