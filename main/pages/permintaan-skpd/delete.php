<?php
// Get Permintaan SKPD data by ID
$id = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($id)) {
    echo "<script>
        alert('ID not provided');
        document.location.href='index.php?page=permintaan-skpd';
      </script>";
    exit;
}

$skpdData = getData('tb_permintaan_skpd', '*', '', "id = '$id'");

if (empty($skpdData)) {
    echo "<script>
        alert('Permintaan SKPD not found');
        document.location.href='index.php?page=permintaan-skpd';
      </script>";
    exit;
}

$skpd = $skpdData[0];

// Delete associated files first

if (!empty($skpd['surat_permintaan'])) {
    $documentPath = __DIR__ . '/../../public/' . $skpd['surat_permintaan'];
    if (file_exists($documentPath)) {
        unlink($documentPath);
    }
}

// Delete the database record
$deleteResult = deleteData('tb_permintaan_skpd', "id = '$id'");

if ($deleteResult) {
    echo "<script>
        alert('Permintaan SKPD has been deleted successfully');
        document.location.href='index.php?page=permintaan-skpd';
      </script>";
} else {
    echo "<script>
        alert('Failed to delete Permintaan SKPD');
        document.location.href='index.php?page=permintaan-skpd';
      </script>";
}
