<?php
// component
require '../components/input/input.php';

?>

<div class="border rounded-xl max-w-2xl mx-auto">
  <div class="px-6 py-2 flex justify-between items-center">
    <h1 class="font-semibold text-[#1d1d1d]">Create Unit</h1>
  </div>
  <hr>
  <div class="p-6">
    <form method="POST">
      <div class="space-y-4">
        <div class="">
          <?= baseInput('Code', 'code', true, 'text', '', 'Enter code', 'off') ?>
        </div>

        <div class="">
          <?= baseInput('Name', 'name', true, 'text', '', 'Enter name', 'off') ?>
        </div>

        <div class="flex items-center gap-2">
          <button type="submit" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none transition-all">
            <span>Submit</span>
          </button>
          <a href="?page=master-unit" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-gray-200 text-gray-500 hover:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none transition-all">
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
    'code' => $_POST['code'],
    'name' => $_POST['name']    
  ];

  $createData = createData('tb_unit', $data);

  if ($createData) {
    echo "<script>
            alert('Success to create unit');
            document.location.href='index.php?page=master-unit';
          </script>";
  } else {
    echo "<script>
            alert('Failed to create unit');
          </script>";
  }
}

?>