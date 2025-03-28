<?php
loadCartFromJson();
$cartItems = getCartItems();
?>

<header class="bg-white text-gray-600 body-font sticky top-0 px-10 z-50">
  <div class="container mx-auto flex flex-wrap p-2.5 flex-col md:flex-row items-center">
    <nav class="flex lg:w-2/5 flex-wrap items-center text-base md:ml-auto">
      <a href="./" class="mr-5 hover:text-gray-900">Home</a>
      <a href="?page=material" class="mr-5 hover:text-gray-900">Material</a>
    </nav>
    <a href="./" class="flex order-first lg:order-none lg:w-1/5 title-font font-medium items-center text-gray-900 lg:items-center lg:justify-center mb-4 md:mb-0 hover:scale-95 transition-all duration-300 group">
      <div class="p-2 bg-[#ef9a2e] grid place-items-center rounded-lg">
        <i class='bx bx-store-alt text-white'></i>
      </div>
      <span class="ml-3 text-base font-semibold group-hover:underline">Toko Bangunan Adi</span>
    </a>
    <div class="lg:w-2/5 inline-flex lg:justify-end ml-5 lg:ml-0">
      <a href="?page=cart" class="relative inline-flex justify-center items-center py-2 px-3 text-sm font-semibold rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
      <i class='bx bx-cart-alt text-[1.2rem]'></i>
      <span class="text-sm font-medium">Cart</span>
        <span class="absolute top-0 end-0 inline-flex items-center py-0.5 px-1.5 rounded-full text-xs font-medium transform -translate-y-1/2 translate-x-1/2 bg-red-500 text-white"><?= count($cartItems) ?></span>
      </a>
    </div>
  </div>
</header>