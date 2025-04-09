<?php
// components
require '../components/input/input.php';
require '../components/textarea/textarea.php';
require '../components/select/select.php';
require '../components/date/date.php';
require '../components/upload/upload.php';

// data dropdown
$StatusProc = [
    ['value' => 'DIGUNAKAN', 'label' => 'DIGUNAKAN'],
    ['value' => 'BATAL', 'label' => 'BATAL'],
    ['value' => 'RUSAK', 'label' => 'RUSAK']
];

// ambil data UPT dari DB
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
                <?= baseSelect('Status', 'status', $StatusProc, 'value', 'label', 'Pilih Jenis Proses', 'DIGUNAKAN', true); ?>
                <?= baseDate('Tanggal Masa Aktif', 'masa_aktif', true, 'Select Date') ?>
                <?= baseUpload('Upload Foto Bukti', 'upload_bukti', true, 'image/jpeg,image/png', '2MB') ?>
                <?= baseUpload('Upload Berita Acara', 'berita_acara', false, '.pdf', '5MB') ?>

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
    // Simpan file upload foto bukti
    $fotoBuktiPath = null;
    if (isset($_FILES['upload_bukti']) && $_FILES['upload_bukti']['error'] == 0) {
        $targetDir = '../uploads/';
        $fotoBuktiPath = $targetDir . basename($_FILES['upload_bukti']['name']);
        move_uploaded_file($_FILES['upload_bukti']['tmp_name'], $fotoBuktiPath);
    }

    // Simpan file dokumen
    $documentPath = null;
    if (isset($_FILES['berita_acara']) && $_FILES['berita_acara']['error'] == 0) {
        $targetDir = '../db/uploads/';
        $documentPath = $targetDir . basename($_FILES['berita_acara']['name']);
        move_uploaded_file($_FILES['berita_acara']['tmp_name'], $documentPath);
    }

    // Siapkan data untuk simpan ke DB
    $data = [
        'nomor_skpd' => $_POST['nomor_skpd'],
        'nomor_polisi' => $_POST['nomor_polisi'],
        'upt_id' => $_POST['upt_id'],
        'status' => $_POST['status'],
        'masa_aktif' => $_POST['masa_aktif'],
        'upload_bukti' => $fotoBuktiPath,
        'berita_acara' => $documentPath,
        'createdAt' => date('Y-m-d H:i:s'),
        'updatedAt' => date('Y-m-d H:i:s'),
    ];

    $createData = createData('tb_permintaan_skpd', $data);

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