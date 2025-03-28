<?php
// component
require '../components/input/input.php';
require '../components/select/select.php';
require '../components/textarea/textarea.php';

// get data
$listCategories = getData('tb_category');
$listUnit = getData('tb_unit');
$listSupplier = getData('tb_supplier');

?>

<div class="border rounded-xl">
  <div class="px-6 py-2 flex justify-between items-center">
    <h1 class="font-semibold text-[#1d1d1d]">Create Product</h1>
  </div>
  <hr>
  <div class="p-6">
    <form method="POST">
      <div class="grid grid-cols-12 gap-6">
        <div class="col-span-6">
          <?= baseInput('Code', 'code', true, 'text', '', 'Enter code', 'off') ?>
        </div>
        <div class="col-span-6">
          <?= baseInput('Name', 'name', true, 'text', '', 'Enter name', 'off') ?>
        </div>
        <div class="col-span-4">
          <?= baseSelect('Category', 'm_category_id', $listCategories, 'id', 'name', 'Select category', '', true) ?>
        </div>
        <div class="col-span-4">
          <?= baseSelect('Unit', 'm_unit_id', $listUnit, 'id', 'name', 'Select unit', '', true) ?>
        </div>
        <div class="col-span-4">
          <?= baseSelect('Supplier', 'm_supplier_id', $listSupplier, 'id', 'company_name', 'Select supplier', '', true) ?>
        </div>
        <div class="col-span-6">
          <?= baseInput('Stock', 'stock', true, 'number', '', 'Enter stock', 'off') ?>
        </div>
        <div class="col-span-6">
          <?= baseInput('Price', 'price', true, 'number', '', 'Enter price', 'off') ?>
        </div>
        <div class="col-span-12">
          <?= baseTextarea('Description', 'description', false, '', 'Fill description') ?>
        </div>

        <div class="col-span-12 flex items-center gap-2">
          <button type="submit" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none transition-all">
            <span>Submit</span>
          </button>
          <a href="?page=master-product" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-gray-200 text-gray-500 hover:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none transition-all">
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
    'name' => $_POST['name'],
    'm_category_id' => $_POST['m_category_id'],
    'm_unit_id' => $_POST['m_unit_id'],
    'm_supplier_id' => $_POST['m_supplier_id'],
    'stock' => $_POST['stock'],
    'price' => $_POST['price'],
    'description' => $_POST['description'],
    'createdAt' => date('Y-m-d H:i:s'),
    'updatedAt' => date('Y-m-d H:i:s'),
  ];

  $createData = createData('tb_product', $data);

  if ($createData) {
    echo "<script>
            alert('Success to create product');
            document.location.href='index.php?page=master-product';
          </script>";
  } else {
    echo "<script>
            alert('Failed to create product');
          </script>";
  }
}

?>