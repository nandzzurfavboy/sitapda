<?php
// Route and page configuration
$page = isset($_GET['page']) ? $_GET['page'] : '';
$action = isset($_GET['act']) ? $_GET['act'] : 'default';

$list_menu = array(
  array(
    'url' => '?page=material',
    'icon' => '<i class="text-[1.1rem] bx bx-grid-alt"></i>',
    'label' => 'Material'
  ),
  array(
    'url' => '?page=cart',
    'icon' => '<i class="text-[1.1rem] bx bx-archive-in "></i>',
    'label' => 'Cart'
  )
);

$pages = array(
  '' => 'pages/home/index.php',
  'material' => array(
    'default' => 'pages/material/index.php'
  ),
  'cart' => array(
    'default' => 'pages/cart/index.php',
    'checkout' => 'pages/cart/checkout.php',
  ),
);
