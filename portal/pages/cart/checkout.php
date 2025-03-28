<?php

loadCartFromJson();
$cartItems = getCartItems();
$cartIsEmpty = empty($cartItems);
$grandTotal = 0;
foreach ($cartItems as $item) {
  $grandTotal += $item['price'] * $item['quantity'];
}
?>

<div class="container mx-auto p-10">
  <form method="POST" class="bg-white rounded-xl p-10">
    <div>
      <h2 class="text-center text-2xl font-bold text-gray-800 lg:text-3xl">Checkout</h2>
      <p class="mt-1 text-sm text-gray-500 text-center">Confirm your order and please fill in the required data</p>
    </div>
    <div class="mt-10 flow-root rounded-lg border border-gray-100 py-3 shadow-sm">
      <dl class="-my-3 divide-y divide-gray-100 text-sm">
        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
          <dt class="font-medium text-gray-900">Name <span class="text-red-500">*</span></dt>
          <dd class="text-gray-700 sm:col-span-2">
            <input type="text" name="customer_name" class="bg-white w-full rounded-lg border py-2 px-4 border-gray-200 shadow-sm sm:text-sm" required>
          </dd>
        </div>

        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
          <dt class="font-medium text-gray-900">Phone Number <span class="text-red-500">*</span></dt>
          <dd class="text-gray-700 sm:col-span-2">
            <input type="number" name="phone_number" class="bg-white w-full rounded-lg border py-2 px-4 border-gray-200 shadow-sm sm:text-sm" required>
          </dd>
        </div>

        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
          <dt class="font-medium text-gray-900">Your Order</dt>
          <dd class="text-gray-700 sm:col-span-2">
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead class="ltr:text-left rtl:text-right">
                  <tr>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Unit Price</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Quantity</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Item Subtotal</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  <?php foreach ($cartItems as $item) : ?>
                    <tr>
                      <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"><?= $item['name'] ?></td>
                      <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= toIdr($item['price']) ?></td>
                      <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= $item['quantity'] ?></td>
                      <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= toIdr($item['price'] * $item['quantity']) ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </dd>
        </div>
        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
          <dt class="font-medium text-gray-900">Grand Total</dt>
          <dd class="text-gray-700 sm:col-span-2">
            <span class="block font-bold"><?= toIdr($grandTotal) ?></span>
          </dd>
        </div>
      </dl>
    </div>
    <div class="mt-6 flex items-center justify-end">
      <button type="submit" name="place_order" <?= $cartIsEmpty ? 'disabled' : '' ?> onclick="return confirm('Are you sure you want to place this order?');" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none transition-all">
        <span>Place Order</span>
      </button>

    </div>
  </form>

</div>