<?php
$get_url = $_GET['page'];
$getProducts = getData(
  "tb_product",
  "tb_product.*, tb_category.name as category_name, tb_unit.name AS unit_name, tb_supplier.company_name",
  "JOIN tb_category ON tb_product.m_category_id = tb_category.id 
     JOIN tb_unit ON tb_product.m_unit_id = tb_unit.id 
     JOIN tb_supplier ON tb_product.m_supplier_id = tb_supplier.id",
  "",
  "tb_product.createdAt DESC"
);

$columns = array(
  'code' => 'Code',
  'name' => 'Product Name',
  'category_name' => 'Category',
  'unit_name' => 'Unit',
  'stock' => 'Stock',
  'price' => 'Price',
  'company_name' => 'Supplier',
  'createdAt' => 'Created At',
);

?>
<div class="border rounded-xl">
  <div class="px-6 py-2 flex justify-between items-center">
    <h1 class="font-semibold text-[#1d1d1d]">Master Product</h1>
    <a href="?page=master-product&act=add" class="text-center py-2 px-4 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-green-700 text-white hover:bg-green-800 disabled:opacity-50 disabled:pointer-events-none transition-all">
      <i class='bx bx-plus-circle text-[1.1rem] text-white'></i>
      <span class="text-white">Create</span>
    </a>
  </div>
  <hr>
  <div class="p-6">
    <?= baseTable($getProducts, $columns, $get_url)  ?>
  </div>
</div>