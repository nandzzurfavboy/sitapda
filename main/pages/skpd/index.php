<?php
$get_url = $_GET['page'];
$getUPT = getData(
    "tb_skpd",
    "*",
    "",
    "",
    "tb_skpd.id DESC"
);

$columns = array(
    'nomor_skpd' => 'Nomor SKPD',
    'nomor_polisi' => 'Nomor Polisi',
    'status' => 'Status',
    'masa_aktif' => 'Masa Aktif',
    'upload_bukti' => 'Upload Bukti',
    'berita_acara' => 'Berita Acara',
);
$imageColumns = ['upload_bukti', 'berita_acara'];

?>
<div class="border rounded-xl">
    <div class="px-6 py-2 flex justify-between items-center">
        <h1 class="font-semibold text-[#1d1d1d]">Master SKPD</h1>
        <a href="?page=skpd&act=add" class="text-center py-2 px-4 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-green-700 text-white hover:bg-green-800 disabled:opacity-50 disabled:pointer-events-none transition-all">
            <i class='bx bx-plus-circle text-[1.1rem] text-white'></i>
            <span class="text-white">Create</span>
        </a>
    </div>
    <hr>
    <div class="p-6">
        <?= baseTable($getUPT, $columns, $get_url, $imageColumns)  ?>
    </div>
</div>