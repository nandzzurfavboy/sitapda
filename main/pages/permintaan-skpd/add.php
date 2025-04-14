<?php
require '../components/input/input.php';
require '../components/textarea/textarea.php';
require '../components/select/select.php';
require '../components/date/date.php';
require '../components/upload/file-upload.php';

$listUPT = getData('tb_upt');
?>

<div class="border rounded-xl max-w-2xl mx-auto">
    <div class="px-6 py-2 flex justify-between items-center">
        <h1 class="font-semibold text-[#1d1d1d]">Permintaan SKPD</h1>
    </div>
    <hr>
    <div class="p-6">
        <form method="POST" enctype="multipart/form-data">
            <div class="space-y-4">
                <?= baseSelect('UPT', 'upt_id', $listUPT, 'id', 'nama', 'Select UPT', '', true) ?>
                <?= baseInput('Jumlah SKPD', 'jumlah_skpd', true, 'number', '', 'Jumlah SKPD', 'off') ?>
                <?= baseFileUpload(
                    'Surat Permintaan',
                    'surat_permintaan',
                    false,
                    ['application/pdf'],
                    2097152
                ) ?>
                <div class="flex items-center gap-2">
                    <button type="submit" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none transition-all">
                        <span>Submit</span>
                    </button>
                    <a href="?page=permintaan-skpd" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-gray-200 text-gray-500 hover:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none transition-all">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $uploadSuratPermintaanPath = 'permintaan-skpd/documents';
    if (!file_exists($uploadSuratPermintaanPath)) {
        mkdir($uploadSuratPermintaanPath, 0777, true);
    }
    $fileUploadSuratPermintaan = processFileUpload('surat_permintaan', $uploadSuratPermintaanPath);


    $data = [
        'upt_id ' => $_POST['upt_id'],
        'jumlah_skpd' => $_POST['jumlah_skpd'],
        'kasi_lp' => 'MENUNGGU',
        'pengurus_barang' => 'BELUM DIVALIDASI',
        'ktu' => 'BELUM DIVALIDASI',
        'kupt' => 'BELUM DIVALIDASI',
        'gudang' => 'BELUM DIVALIDASI',
        'createdAt' => date('Y-m-d H:i:s'),
        'updatedAt' => date('Y-m-d H:i:s'),
    ];

    if (isset($fileUploadSuratPermintaan) && $fileUploadSuratPermintaan['success']) {
        $data['surat_permintaan'] = $fileUploadSuratPermintaan['filePath'];
    }

    $createData = createData('tb_permintaan_skpd', $data);

    if ($createData) {
        echo "<script>
            alert('Success to Permintaan SKPD');
            document.location.href='index.php?page=permintaan-skpd';
          </script>";
    } else {
        echo "<script>
            alert('Failed to Permintaan SKPD');
          </script>";
    }
}

?>