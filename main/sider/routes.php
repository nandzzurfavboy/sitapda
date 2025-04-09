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
    'url' => '?page=validasi-skpd',
    'icon' => '<i class="text-[1.1rem] bx bx-archive-in "></i>',
    'label' => 'Validasi SKPD'
  ),
  array(
    'url' => '?page=master-upt',
    'icon' => '<i class="text-[1.1rem] bx bx-archive-in "></i>',
    'label' => 'UPT'
  ),
  array(
    'url' => '?page=skpd',
    'icon' => '<i class="text-[1.1rem] bx bx-desktop "></i>',
    'label' => 'SKPD'
  ),
  array(
    'url' => '?page=permintaan-skpd',
    'icon' => '<i class="text-[1.1rem] bx bx-desktop "></i>',
    'label' => 'Permintaan SKPD'
  ),
  array(
    'url' => '?page=laporan',
    'icon' => '<i class="text-[1.1rem] bx bx-desktop "></i>',
    'label' => 'Laporan'
  ),
  array(
    'url' => '?page=manage-user',
    'icon' => '<i class="text-[1.1rem] bx bx-user-check"></i>',
    'label' => 'Manajemen User'
  ),
);

$pages = array(
  'dashboard' => 'pages/dashboard/index.php',
  'master-upt' => array(
    'default' => 'pages/upt/index.php',
    'add' => 'pages/upt/add.php',
    'edit' => 'pages/upt/edit.php',
    'delete' => 'pages/upt/delete.php'
  ),
  'skpd' => array(
    'default' => 'pages/skpd/index.php',
    'add' => 'pages/skpd/add.php',
    'edit' => 'pages/skpd/edit.php',
    'delete' => 'pages/skpd/delete.php'
  ),
  'permintaan-skpd' => array(
    'default' => 'pages/permintaan-skpd/index.php',
    'add' => 'pages/permintaan-skpd/add.php',
    'edit' => 'pages/permintaan-skpd/edit.php',
    'delete' => 'pages/permintaan-skpd/delete.php'
  ),
  'laporan' => array(
    'default' => 'pages/laporan/index.php',
  ),
  'manage-user' => array(
    'default' => 'pages/manage-user/index.php',
    'add' => 'pages/manage-user/add.php',
    'edit' => 'pages/manage-user/edit.php',
    'delete' => 'pages/manage-user/delete.php'
  ),
  'logout' => array(
    'default' => 'pages/logout.php'
  ),
);
