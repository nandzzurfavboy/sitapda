<?php require '../components/card/stats-card.php'; ?>
<?php

$totalOrders = getData("tb_order", "COUNT(*) as total")[0]['total'];
$totalTransactionsPaid = getData("tb_transaction", "COUNT(*) as total", "", "payment_status = 'PAID'")[0]['total'];
$totalTransactionsUnpaid = getData("tb_transaction", "COUNT(*) as total", "", "payment_status = 'UNPAID'")[0]['total'];

$recentOrders = getData(
  "tb_order",
  "*",
  "",
  "",
  "tb_order.id DESC LIMIT 5"
);

$columns = array(
  'order_id' => 'Order ID',
  'customer_name' => 'Customer Name',
  'order_date' => 'Order Date',
  'order_status' => 'Order Status',
);

?>

<h1 class="font-semibold text-[#1d1d1d]">Dashboard</h1>
<div class="mt-10 grid grid-cols-1 gap-6 mx-auto sm:grid-cols-2 xl:grid-cols-4">
  <?php
  echo statsCard("<i class='bx bx-cart text-3xl text-white'></i>", $totalOrders, "Total Orders");
  echo statsCard("<i class='bx bx-money text-3xl text-white'></i>", $totalTransactionsPaid, "Transactions PAID");
  echo statsCard("<i class='bx bx-credit-card text-3xl text-white'></i>", $totalTransactionsUnpaid, "Transactions UNPAID");
  ?>
</div>
<div class="mt-10 border rounded-xl">
  <div class="px-6 py-2 flex justify-between items-center">
    <h1 class="font-semibold text-[#1d1d1d]">Recent Order</h1>
  </div>
  <hr>
  <div class="p-6">
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
        <thead>
          <tr>
            <th class="whitespace-nowrap text-left px-4 py-2 font-semibold text-gray-900">Customer Name</th>
            <th class="whitespace-nowrap text-left px-4 py-2 font-semibold text-gray-900">Phone No</th>
            <th class="whitespace-nowrap text-left px-4 py-2 font-semibold text-gray-900">Total Amount</th>
            <th class="whitespace-nowrap text-left px-4 py-2 font-semibold text-gray-900">Status</th>
            <th class="whitespace-nowrap text-left px-4 py-2 font-semibold text-gray-900">Order Date</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          <?php
          foreach ($recentOrders as $row) {
          ?>
            <tr class="odd:bg-gray-50">
              <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= $row['name'] ?></td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= $row['phone_number'] ?></td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= toIdr($row['grand_total']) ?></td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= $row['status_order'] ?></td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= $row['createdAt'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>