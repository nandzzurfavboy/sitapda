<?php

loadCartFromJson();
$cartItems = getCartItems();
$cartIsEmpty = empty($cartItems);
$grandTotal = 0;
foreach ($cartItems as $item) {
  $grandTotal += $item['price'] * $item['quantity'];
}

?>

<div class="w-full p-10">
  <div class="bg-white py-6 sm:py-8 lg:py-12 rounded-xl">
    <div class="mx-auto max-w-screen-lg px-4 md:px-8">
      <div class="mb-6 sm:mb-10 lg:mb-16">
        <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">Your Cart</h2>
      </div>

      <div class="mb-5 flex flex-col sm:mb-8 sm:divide-y sm:border-t sm:border-b">
        <?php if ($cartIsEmpty) {
          require '../components/empty/empty.php';
        } else {
          foreach ($cartItems as $index => $item) { ?>
            <form method="POST" class="py-5 sm:py-8">
              <input type="hidden" name="item_index" value="<?= $index ?>">
              <div class="flex flex-wrap gap-4 sm:py-2.5 lg:gap-6">
                <div class="sm:-my-2.5">
                  <a href="#" class="group relative block h-20 w-20 overflow-hidden rounded-lg bg-gray-100">
                    <img src="https://placehold.co/400" loading="lazy" alt="Photo by Thái An" class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />
                  </a>
                </div>

                <div class="-mt-3 flex flex-1 flex-col justify-between">
                  <div>
                    <span class="mb-1 inline-block text-lg font-semibold text-gray-800 transition duration-100 hover:text-gray-500 lg:text-xl"><?= $item['name'] ?></span>
                    <span class="block text-gray-500 text-sm">Qty: <?= $item['quantity'] ?></span>
                  </div>

                  <div>
                    <span class="mb-1 block font-semibold text-gray-800 text-base"><?= toIdr($item['price']) ?></span>

                    <?php if ($item['quantity'] >= $item['stock']) { ?>
                      <span class="flex items-center gap-1 text-sm text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>

                        Stock limit reached
                      </span>
                    <?php } else { ?>
                      <span class="flex items-center gap-1 text-sm text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        In stock
                      </span>
                    <?php } ?>
                  </div>
                </div>

                <div class="flex w-full justify-between border-t pt-4 sm:w-auto sm:border-none sm:pt-0">
                  <div class="flex flex-col items-start gap-2">
                    <div>
                      <label for="Quantity" class="sr-only"> Quantity </label>

                      <div class="flex items-center rounded border border-gray-200">
                        <button type="submit" name="update_quantity" value="decrease" <?= $item['quantity'] <= 1 ? 'disabled' : ''; ?> class="size-10 border-r leading-10 text-gray-600 transition hover:bg-gray-100">
                          &minus;
                        </button>
                        <span class="w-10 text-center"><?= $item['quantity'] ?></span>
                        <button type="submit" name="update_quantity" value="increase" <?= $item['quantity'] >= $item['stock'] ? 'disabled' : ''; ?> class="size-10 border-l leading-10 text-gray-600 transition hover:bg-gray-100">
                          &plus;
                        </button>
                      </div>
                    </div>


                    <button type="submit" name="remove_from_cart" class="select-none text-sm font-semibold text-indigo-500 transition duration-100 hover:text-indigo-600 active:text-indigo-700">Delete</button>
                  </div>

                  <div class="ml-4 pt-3 sm:pt-2 md:ml-8 lg:ml-16">
                    <span class="block font-bold text-gray-800 md:text-lg"><?= toIdr($item['price'] * $item['quantity']) ?></span>
                  </div>
                </div>
              </div>
            </form>
        <?php }
        } ?>
      </div>

      <div class="flex flex-col items-end gap-4">
        <div class="w-full rounded-lg bg-gray-100 p-4 sm:max-w-xs">
          <div class="">
            <div class="flex items-start justify-between gap-4 text-gray-800">
              <span class="text-lg font-bold">Total</span>

              <span class="flex flex-col items-end">
                <span class="text-lg font-bold"><?= toIdr($grandTotal) ?></span>
              </span>
            </div>
          </div>
        </div>

        <div class="flex items-center gap-2">
          <a href="?page=cart&act=checkout" <?= $cartIsEmpty ? 'disabled' : '' ?> class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none transition-all">
            <span>Checkout</span>
          </a>
          <a href="?page=material" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border text-gray-500 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none transition-all">
            Back
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>