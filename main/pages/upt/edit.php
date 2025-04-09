<?php
// component
require '../components/input/input.php';
require '../components/select/select.php';
require '../components/textarea/textarea.php';

// get value id
$id = $_GET['id'];
$row = getData('tb_upt', '*', '', 'id = ' . intval($id));
$value = $row[0];
$StatusOpt = [
  ['value' => 'AKTIF', 'label' => 'AKTIF'],
  ['value' => 'TIDAK AKTIF', 'label' => 'TIDAK AKTIF']
];
?>

<div class="border rounded-xl max-w-2xl mx-auto">
  <div class="px-6 py-2 flex justify-between items-center">
    <h1 class="font-semibold text-[#1d1d1d]">Edit UPT</h1>
  </div>
  <hr>
  <div class="p-6">
    <form method="POST">
      <div class="space-y-4">
        <div class="">
          <?= baseInput('Name', 'nama', true, 'text', $value['nama'], 'Enter name', 'off') ?>
        </div>

        <div class="">
          <?= baseTextarea('Address', 'alamat', false, $value['alamat'], 'Fill address') ?>
        </div>

        <?= baseSelect(
          'Status',
          'status',
          $StatusOpt,
          'value',
          'label',
          'Pilih Status',
          $value['status'],
          true
        ); ?>

        <div class="flex items-center gap-2">
          <button type="submit" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none transition-all">
            <span>Submit</span>
          </button>
          <a href="?page=master-upt" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-gray-200 text-gray-500 hover:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none transition-all">
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
    'nama' => $_POST['nama'],
    'alamat' => $_POST['alamat'],
    'status' => $_POST['status'],
  ];

  $editData = updateData('tb_upt', $data, 'id =' . intval($id));

  if ($editData) {
    echo "<script>
            alert('Success to edit UPT');
            document.location.href='index.php?page=master-upt';
          </script>";
  } else {
    echo "<script>
            alert('Failed to edit UPT');
          </script>";
  }
}

?>