<?php
// Get SKPD data by ID
$id = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($id)) {
    echo "<script>
        alert('ID not provided');
        document.location.href='index.php?page=skpd';
      </script>";
    exit;
}

$skpdData = getData('tb_skpd', '*', '', "id = '$id'");

if (empty($skpdData)) {
    echo "<script>
        alert('SKPD not found');
        document.location.href='index.php?page=skpd';
      </script>";
    exit;
}

$skpd = $skpdData[0];

// Delete associated files first
if (!empty($skpd['upload_bukti'])) {
    $photoPath = __DIR__ . '/../../public/' . $skpd['upload_bukti'];
    if (file_exists($photoPath)) {
        unlink($photoPath);
    }
}

if (!empty($skpd['berita_acara'])) {
    $documentPath = __DIR__ . '/../../public/' . $skpd['berita_acara'];
    if (file_exists($documentPath)) {
        unlink($documentPath);
    }
}

// Delete the database record
$deleteResult = deleteData('tb_skpd', "id = '$id'");

if ($deleteResult) {
    echo "<script>
        alert('SKPD has been deleted successfully');
        document.location.href='index.php?page=skpd';
      </script>";
} else {
    echo "<script>
        alert('Failed to delete SKPD');
        document.location.href='index.php?page=skpd';
      </script>";
}
?>