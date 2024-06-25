<?php $head_title = head_title($_GET['page']); ?>
<div class="ml-[260px]">
  <header class="bg-white z-50 min-h-16 flex items-center px-6 w-full sticky top-0 border-b">
    <div class="leading-snug">
      <h3 class="text-base font-bold uppercase">
        Admin Panel Sistem Pemesanan Toko Bangunan Adi
      </h3>
      <p class="text-sm text-[#e87918] font-medium"><?= $head_title; ?></p>
    </div>
  </header>
  <main class="p-8 bg-white">
    <?php
    if (array_key_exists($page, $pages)) {
      if (is_array($pages[$page]) && array_key_exists($action, $pages[$page])) {
        require_once $pages[$page][$action];
      } else {
        require_once $pages[$page];
      }
    } else {
      require_once 'pages/dashboard/index.php';
    }
    ?>
  </main>
</div>