<?php
$get_url = $_GET['page'];
$getUser = getData(
    "tb_permintaan_skpd",
    "*",
    "",
    "",
    "tb_permintaan_skpd.id DESC"
);

$columns = array(
    'upt_id' => 'UPT',
    'jumlah_skpd' => 'Jumlah SKPD',
    'kasi_lp' => 'Kasi Lp 1 ',
    'pengurus_barang' => 'Pengurus Barang',
    'ktu' => 'KTU',
    'kupt' => 'KUPT',
    'gudang' => 'gudang',
);

?>
<div class="border rounded-xl">
    <div class="px-6 py-2 flex justify-between items-center">
        <h1 class="font-semibold text-[#1d1d1d]">Status Permintaan SKPD</h1>
        <a href="?page=permintaan-skpd&act=add" class="text-center py-2 px-4 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-green-700 text-white hover:bg-green-800 disabled:opacity-50 disabled:pointer-events-none transition-all">
            <i class='bx bx-plus-circle text-[1.1rem] text-white'></i>
            <span class="text-white">Create</span>
        </a>
    </div>
    <hr>
    <div class="p-6">
        <?= baseTable($getUser, $columns, $get_url)  ?>
    </div>
</div>