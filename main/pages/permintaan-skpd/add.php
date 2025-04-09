<?php
// component
require '../components/input/input.php';
require '../components/select/select.php';
require '../components/upload/upload.php';

// fungsi upload file
function uploadFile($fileInputName, $allowedTypes, $uploadDir = '../uploads/')
{
    if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) {
        return null; // tidak mengupload dokumen
    }

    $fileTmpPath = $_FILES[$fileInputName]['tmp_name'];
    $fileName = basename($_FILES[$fileInputName]['name']);
    $fileSize = $_FILES[$fileInputName]['size'];
    $fileType = mime_content_type($fileTmpPath);

    if (!in_array($fileType, $allowedTypes)) {
        return false;
    }

    $targetFilePath = $uploadDir . time() . '_' . $fileName;

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
        return $targetFilePath;
    }

    return false;
}

// get data untuk select UPT
$listUPT = getData('tb_upt');
?>

<div class="border rounded-xl max-w-2xl mx-auto">
    <div class="px-6 py-2 flex justify-between items-center">
        <h1 class="font-semibold text-[#1d1d1d]">Formulir Permintaan</h1>
    </div>
    <hr>
    <div class="p-6">
        <form method="POST" enctype="multipart/form-data">
            <div class="space-y-4">
                <div>
                    <?= baseSelect('UPT', 'upt_id', $listUPT, 'id', 'nama', 'Select UPT', '', true) ?>
                </div>

                <div>
                    <?= baseInput('Jumlah SKPD', 'jumlah_skpd', true, 'number', '', 'Masukkan jumlah SKPD', 'off') ?>
                </div>

                <div>
                    <?= baseUpload('Upload Surat Permintaan', 'surat_permintaan', false, '.pdf', '5MB') ?>
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 transition-all">
                        <span>Submit</span>
                    </button>
                    <a href="?page=permintaan-skpd" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg bg-gray-200 text-gray-500 hover:bg-gray-300 transition-all">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $upt_id = $_POST['upt_id'];
    $jumlah_skpd = $_POST['jumlah_skpd'];
    $documentPath = uploadFile('surat_permintaan', ['../db/uploads/']);

    if ($documentPath === false) {
        echo "<script>alert('Upload dokumen gagal atau file tidak sesuai. Hanya PDF diperbolehkan.');</script>";
        return;
    }

    $data = [
        'upt_id' => $upt_id,
        'jumlah_skpd' => $jumlah_skpd,
        'surat_permintaan' => $documentPath,
        'createdAt' => date('Y-m-d H:i:s'),
        'updatedAt' => date('Y-m-d H:i:s'),
    ];

    $createData = createData('tb_permintaan_skpd', $data); // Ganti dengan nama tabel kamu

    if ($createData) {
        echo "<script>
            alert('Permintaan berhasil dikirim');
            document.location.href='index.php?page=permintaan-skpd';
          </script>";
    } else {
        echo "<script>alert('Gagal menyimpan data permintaan.');</script>";
    }
}
?>