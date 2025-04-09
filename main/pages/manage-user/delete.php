<?php
$id = $_GET['id'];
$deleteData = deleteData('tb_user', 'id = ' . intval($id));

if ($deleteData) {
    echo "<script>
          alert('Success to delete user');
          document.location.href='index.php?page=manage-user';
        </script>";
} else {
    echo "<script>
          alert('Failed to delete user');
          document.location.href='index.php?page=manage-user';
        </script>";
}
