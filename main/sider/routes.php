<?php
// Route and page configuration
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
$action = isset($_GET['act']) ? $_GET['act'] : 'default';

$list_menu = array(
  array(
    'url' => '?page=dashboard',
    'icon' => '<i class="text-[1.1rem] bx bx-grid-alt"></i>',
    'label' => 'Dashboard'
  ),
  array(
    'url' => '?page=customer-order',
    'icon' => '<i class="text-[1.1rem] bx bx-archive-in "></i>',
    'label' => 'Customer Order'
  ),
  array(
    'label' => 'Master',
    'icon' => '<i class="text-[1.1rem] bx bx-folder-open"></i>',
    'submenu' => array(
      array(
        'url' => '?page=master-product',
        'label' => 'Master Product'
      ),
      array(
        'url' => '?page=master-category',
        'label' => 'Master Category'
      )
    )
  ),
  array(
    'label' => 'Report',
    'icon' => '<i class="text-[1.1rem] bx bx-bar-chart-square"></i>',
    'submenu' => array(
      array(
        'url' => '?page=stock-in',
        'label' => 'Stock In'
      ),
      array(
        'url' => '?page=stock-out',
        'label' => 'Stock Out'
      )
    )
  ),
  array(
    'url' => '?page=manage-user',
    'icon' => '<i class="text-[1.1rem] bx bx-user-check"></i>',
    'label' => 'Manage User'
  ),
);

$pages = array(
  'dashboard' => 'pages/dashboard/index.php',
  'customer-order' => 'pages/customer-order/index.php',
  'master-product' => array(
    'default' => 'pages/master/product/index.php',
    'add' => 'pages/master/product/add.php',
    'edit' => 'pages/master/product/edit.php'
  ),
  'master-category' => array(
    'default' => 'pages/master/category/index.php',
    'add' => 'pages/master/category/add.php',
    'edit' => 'pages/master/category/edit.php'
  ),
  'stock-in' => array(
    'default' => 'pages/report/stock-in/index.php',
  ),
  'stock-out' => array(
    'default' => 'pages/report/stock-out/index.php',
  ),
  'manage-user' => array(
    'default' => 'pages/manage-user/index.php',
    'add' => 'pages/manage-user/add.php',
    'edit' => 'pages/manage-user/edit.php'
  )
);
