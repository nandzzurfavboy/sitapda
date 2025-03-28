<?php

require '../components/card/product-card.php';
require '../components/select/custom-select.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$categoryId = isset($_GET['m_category_id']) ? $_GET['m_category_id'] : '';
$unitId = isset($_GET['m_unit_id']) ? $_GET['m_unit_id'] : '';

$conditions = [];
if ($search) {
  $conditions[] = "tb_product.name LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'";
}
if ($categoryId) {
  $conditions[] = "tb_product.m_category_id = " . intval($categoryId);
}
if ($unitId) {
  $conditions[] = "tb_product.m_unit_id = " . intval($unitId);
}

$whereClause = implode(' AND ', $conditions);

$listProducts = getData(
  "tb_product",
  "tb_product.*, tb_category.name as category_name, tb_unit.name AS unit_name, tb_supplier.company_name",
  "JOIN tb_category ON tb_product.m_category_id = tb_category.id 
     JOIN tb_unit ON tb_product.m_unit_id = tb_unit.id 
     JOIN tb_supplier ON tb_product.m_supplier_id = tb_supplier.id",
  $whereClause,
  "tb_product.createdAt DESC"
);

$listCategories = getData('tb_category');
$listUnit = getData('tb_unit');

?>

<section class="w-full p-10">
  <div class="container mx-auto p-5 rounded-xl bg-white">
    <?php require 'form-filter.php' ?>
    <hr class="mt-10">
    <div class="mt-8">
      <h1 class="text-lg text-center font-semibold text-[#1d1d1d]">All Materials</h1>
      <?php if (empty($listProducts)) : ?>
        <div class="mt-10">
          <?php require '../components/empty/empty.php'; ?>
        </div>
      <?php else : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 mt-10 gap-6">
          <?php
          foreach ($listProducts as $item) {
            echo productCard(
              $item['id'],
              $item['code'],
              $item['name'],
              $item['m_category_id'],
              $item['category_name'],
              $item['m_unit_id'],
              $item['unit_name'],
              $item['price'],
              $item['stock'],
              mb_strlen($item['description']) > 100 ? mb_substr($item['description'], 0, 100) . '...' : $item['description'],  
              'Order',
              '<i class=\'bx bx-cart-download text-xl\'></i>',
            );
          }
          ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>