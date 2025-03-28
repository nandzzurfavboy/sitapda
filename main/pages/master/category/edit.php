<?php
// component
require '../components/input/input.php';
require '../components/textarea/textarea.php';

// get value id
$id = $_GET['id'];
$row = getData('tb_category', '*', '', 'id = ' . intval($id));
$value = $row[0];

?>

<div class="border rounded-xl max-w-2xl mx-auto">
  <div class="px-6 py-2 flex justify-between items-center">
    <h1 class="font-semibold text-[#1d1d1d]">Edit Category</h1>
  </div>
  <hr>
  <div class="p-6">
    <form method="POST">
      <div class="space-y-4">
        <div class="">
          <?= baseInput('Name', 'name', true, 'text', $value['name'], 'Enter name', 'off') ?>
        </div>

        <div class="">
          <?= baseTextarea('Description', 'description', false, $value['description'], 'Fill description') ?>
        </div>

        <div class="flex items-center gap-2">
          <button type="submit" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none transition-all">
            <span>Submit</span>
          </button>
          <a href="?page=master-category" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-gray-200 text-gray-500 hover:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none transition-all">
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
    'name' => $_POST['name'],
    'description' => $_POST['description']
  ];

  $editData = updateData('tb_category', $data, 'id =' . intval($id));

  if ($editData) {
    echo "<script>
            alert('Success to edit category');
            document.location.href='index.php?page=master-category';
          </script>";
  } else {
    echo "<script>
            alert('Failed to edit category');
          </script>";
  }
}

?>