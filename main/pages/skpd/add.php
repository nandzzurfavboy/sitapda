<?php
require '../components/input/input.php';
require '../components/textarea/textarea.php';
require '../components/select/select.php';
require '../components/date/date.php';
require '../components/upload/file-upload.php';

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
        <h1 class="font-semibold text-[#1d1d1d]">Create SKPD</h1>
    </div>
    <hr>
    <div class="p-6">
        <form method="POST" enctype="multipart/form-data">
            <div class="space-y-4">
                <?= baseInput('Nomor SKPD', 'nomor_skpd', true, 'text', '', 'Enter SKPD Number', 'off') ?>
                <?= baseInput('Nomor Polisi', 'nomor_polisi', true, 'text', '', 'Enter Police Number', 'off') ?>
                <?= baseSelect('UPT', 'upt_id', $listUPT, 'id', 'nama', 'Select UPT', '', true) ?>
                <?= baseSelect('Jenis Proses', 'jenis_proses', $JenisProses, 'value', 'label', 'Pilih Jenis Proses', 'DIGUNAKAN', true); ?>
                <?= baseSelect('Status', 'status', $StatusProc, 'value', 'label', 'Status', 'DIGUNAKAN', true); ?>
                <?= baseDate('Tanggal Masa Aktif', 'masa_aktif', true, 'Select Date') ?>
                <?= baseFileUpload(
                    'Foto UPT',
                    'upload_bukti',
                    false,
                    ['image/png', 'image/jpeg'],
                    2097152
                ) ?>
                <?= baseFileUpload(
                    'Berita Acara',
                    'berita_acara',
                    false,
                    ['application/pdf'],
                    2097152
                ) ?>
                <div class="flex items-center gap-2">
                    <button type="submit" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none transition-all">
                        <span>Submit</span>
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

    $uploadBuktiPath = 'skpd/images';
    if (!file_exists($uploadBuktiPath)) {
        mkdir($uploadBuktiPath, 0777, true);
    }
    $fileUploadBukti = processFileUpload('upload_bukti', $uploadBuktiPath);

    $uploadBeritaAcaraPath = 'skpd/documents';
    if (!file_exists($uploadBeritaAcaraPath)) {
        mkdir($uploadBeritaAcaraPath, 0777, true);
    }
    $fileUploadBeritaAcara = processFileUpload('berita_acara', $uploadBeritaAcaraPath);


    $data = [
        'nomor_skpd' => $_POST['nomor_skpd'],
        'nomor_polisi' => $_POST['nomor_polisi'],
        'upt_id ' => $_POST['upt_id'],
        'jenis_proses' => $_POST['jenis_proses'],
        'status' => $_POST['status'],
        'masa_aktif' => $_POST['masa_aktif'],
        'createdAt' => date('Y-m-d H:i:s'),
        'updatedAt' => date('Y-m-d H:i:s'),
    ];

    if (isset($fileUploadBukti) && $fileUploadBukti['success']) {
        $data['upload_bukti'] = $fileUploadBukti['filePath'];
    }

    if (isset($fileUploadBeritaAcara) && $fileUploadBeritaAcara['success']) {
        $data['berita_acara'] = $fileUploadBeritaAcara['filePath'];
    }

    $createData = createData('tb_skpd', $data);

    if ($createData) {
        echo "<script>
            alert('Success to create SKPD');
            document.location.href='index.php?page=skpd';
          </script>";
    } else {
        echo "<script>
            alert('Failed to create SKPD');
          </script>";
    }
}

?>