<?php
require '../components/input/input.php';
require '../components/textarea/textarea.php';
require '../components/select/select.php';
require '../components/date/date.php';
require '../components/upload/file-upload.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';
$skpdData = getData('tb_skpd', '*', '', "id = '$id'");

if (empty($skpdData)) {
  echo "<script>
        alert('SKPD not found');
        document.location.href='index.php?page=skpd';
      </script>";
  exit;
}

$skpd = $skpdData[0];

$StatusProc = [
  ['value' => 'DIGUNAKAN', 'label' => 'DIGUNAKAN'],
  ['value' => 'BATAL', 'label' => 'BATAL'],
  ['value' => 'RUSAK', 'label' => 'RUSAK']
];

$JenisProses = [
  ['value' => 'GANTI STNK', 'label' => 'GANTI STNK'],
  ['value' => 'BBN RUBENTINA', 'label' => 'BBN RUBENTINA'],
  ['value' => 'PENGESAHAN', 'label' => 'PENGESAHAN'],
  ['value' => 'FISKAL', 'label' => 'FISKAL'],
  ['value' => 'KENDARAAN BARU', 'label' => 'KENDARAAN BARU'],
  ['value' => 'LAPOR ANTAR TIBA PROVINSI', 'label' => 'LAPOR ANTAR TIBA PROVINSI'],
];

$listUPT = getData('tb_upt');

?>

<div class="border rounded-xl max-w-2xl mx-auto">
  <div class="px-6 py-2 flex justify-between items-center">
    <h1 class="font-semibold text-[#1d1d1d]">Edit SKPD</h1>
  </div>
  <hr>
  <div class="p-6">
    <form method="POST" enctype="multipart/form-data">
      <div class="space-y-4">
        <?= baseInput('Nomor SKPD', 'nomor_skpd', true, 'text', $skpd['nomor_skpd'], 'Enter SKPD Number', 'off') ?>
        <?= baseInput('Nomor Polisi', 'nomor_polisi', true, 'text', $skpd['nomor_polisi'], 'Enter Police Number', 'off') ?>
        <?= baseSelect('UPT', 'upt_id', $listUPT, 'id', 'nama', 'Select UPT', $skpd['upt_id'], true) ?>
        <?= baseSelect('Jenis Proses', 'jenis_proses', $JenisProses, 'value', 'label', 'Jenis Proses', $skpd['jenis_proses'], true); ?>
        <?= baseSelect('Status', 'status', $StatusProc, 'value', 'label', 'Status', $skpd['status'], true); ?>
        <?= baseDate(
          'Tanggal Masa Aktif',
          'masa_aktif',
          true,
          date('Y-m-d', strtotime($skpd['masa_aktif'])),
          'Select Date'
        ) ?>

        <?php if (!empty($skpd['upload_bukti'])): ?>
          <div class="mb-2">
            <p class="text-sm text-gray-600 mb-1">Current Photo:</p>
            <?php
            $fileExtension = pathinfo($skpd['upload_bukti'], PATHINFO_EXTENSION);
            if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png'])):
            ?>
              <div class="flex items-center gap-2">
                <img src="../public/<?= $skpd['upload_bukti'] ?>" alt="Current Photo" class="h-16 w-16 object-cover rounded border">
                <a href="../public/<?= $skpd['upload_bukti'] ?>" target="_blank" class="text-blue-500 hover:text-blue-700 text-xs">
                  <i class="bx bx-link-external"></i> View Full Size
                </a>
              </div>
            <?php else: ?>
              <p class="text-sm text-gray-500">No image available</p>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <?= baseFileUpload(
          'Update Photo (leave empty to keep current)',
          'upload_bukti',
          false,
          ['image/png', 'image/jpeg'],
          2097152
        ) ?>

        <?php if (!empty($skpd['berita_acara'])): ?>
          <div class="mb-2">
            <p class="text-sm text-gray-600 mb-1">Current Document:</p>
            <?php
            $fileExtension = pathinfo($skpd['berita_acara'], PATHINFO_EXTENSION);
            if (strtolower($fileExtension) == 'pdf'):
            ?>
              <div class="flex items-center gap-2">
                <div class="flex items-center text-red-500">
                  <i class="bx bxs-file-pdf text-2xl"></i>
                  <span class="ml-1 text-sm">PDF Document</span>
                </div>
                <a href="../public/<?= $skpd['berita_acara'] ?>" target="_blank" class="text-blue-500 hover:text-blue-700 text-xs">
                  <i class="bx bx-link-external"></i> View Document
                </a>
              </div>
            <?php else: ?>
              <p class="text-sm text-gray-500">No document available</p>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <?= baseFileUpload(
          'Update Document (leave empty to keep current)',
          'berita_acara',
          false,
          ['application/pdf'],
          2097152
        ) ?>

        <div class="flex items-center gap-2">
          <button type="submit" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none transition-all">
            <span>Update</span>
          </button>
          <a href="?page=skpd" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-gray-200 text-gray-500 hover:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none transition-all">
            Cancel
          </a>
        </div>
      </div>
    </form>
  </div>
</div>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $data = [
    'nomor_skpd' => $_POST['nomor_skpd'],
    'nomor_polisi' => $_POST['nomor_polisi'],
    'upt_id' => $_POST['upt_id'],
    'jenis_proses' => $_POST['jenis_proses'],
    'status' => $_POST['status'],
    'masa_aktif' => $_POST['masa_aktif'],
    'updatedAt' => date('Y-m-d H:i:s'),
  ];

  if (isset($_FILES['upload_bukti']) && $_FILES['upload_bukti']['error'] == UPLOAD_ERR_OK) {
    $uploadBuktiPath = 'skpd/images';
    if (!file_exists($uploadBuktiPath)) {
      mkdir($uploadBuktiPath, 0777, true);
    }
    $fileUploadBukti = processFileUpload('upload_bukti', $uploadBuktiPath);

    if (isset($fileUploadBukti) && $fileUploadBukti['success']) {
      $data['upload_bukti'] = $fileUploadBukti['filePath'];

      if (!empty($skpd['upload_bukti'])) {
        $oldFilePath = __DIR__ . '/../../public/' . $skpd['upload_bukti'];
        if (file_exists($oldFilePath)) {
          unlink($oldFilePath);
        }
      }
    }
  }

  if (isset($_FILES['berita_acara']) && $_FILES['berita_acara']['error'] == UPLOAD_ERR_OK) {
    $uploadBeritaAcaraPath = 'skpd/documents';
    if (!file_exists($uploadBeritaAcaraPath)) {
      mkdir($uploadBeritaAcaraPath, 0777, true);
    }
    $fileUploadBeritaAcara = processFileUpload('berita_acara', $uploadBeritaAcaraPath);

    if (isset($fileUploadBeritaAcara) && $fileUploadBeritaAcara['success']) {
      $data['berita_acara'] = $fileUploadBeritaAcara['filePath'];

      if (!empty($skpd['berita_acara'])) {
        $oldFilePath = __DIR__ . '/../../public/' . $skpd['berita_acara'];
        if (file_exists($oldFilePath)) {
          unlink($oldFilePath);
        }
      }
    }
  }

  $updateData = updateData('tb_skpd', $data, "id = '$id'");

  if ($updateData) {
    echo "<script>
            alert('Success to update SKPD');
            document.location.href='index.php?page=skpd';
          </script>";
  } else {
    echo "<script>
            alert('Failed to update SKPD');
          </script>";
  }
}
?>