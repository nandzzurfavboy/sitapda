<?php
$get_url = $_GET['page'];
$getTransaction = getData(
  "tb_transaction",
  "tb_transaction.*, tb_order.name as order_name",
  "JOIN tb_order ON tb_transaction.m_order_id = tb_order.id",
  "",
  "tb_transaction.id DESC"
);

?>
<div class="border rounded-xl">
  <div class="px-6 py-2 flex justify-between items-center">
    <h1 class="font-semibold text-[#1d1d1d]">Transaction</h1>
  </div>
  <hr>
  <div class="p-6">
    <div class="overflow-x-auto">
      <table id="datatable-style" class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
        <thead>
          <tr>
            <th class="whitespace-nowrap text-left px-4 py-2 font-semibold text-gray-900">No</th>
            <th class="whitespace-nowrap text-left px-4 py-2 font-semibold text-gray-900">Transaction No</th>
            <th class="whitespace-nowrap text-left px-4 py-2 font-semibold text-gray-900">Order ID</th>
            <th class="whitespace-nowrap text-left px-4 py-2 font-semibold text-gray-900">Customer Name</th>
            <th class="whitespace-nowrap text-left px-4 py-2 font-semibold text-gray-900">Payment Amount</th>
            <th class="whitespace-nowrap text-left px-4 py-2 font-semibold text-gray-900">Payment Change</th>
            <th class="whitespace-nowrap text-left px-4 py-2 font-semibold text-gray-900">Payment Status</th>
            <th class="whitespace-nowrap text-center px-4 py-2 font-semibold text-gray-900">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          <?php
          $i = 1;
          foreach ($getTransaction as $row) {
            $paid = $row['payment_status'];
          ?>
            <tr class="odd:bg-gray-50">
              <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"><?= $i++ ?></td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= $row['transaction_no'] ?></td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= $row['m_order_id'] ?></td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= $row['order_name'] ?></td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= $row['payment_amount'] === NULL ? '-' : toIdr($row['payment_amount']) ?></td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= $row['payment_amount'] === NULL ? '-' : toIdr($row['payment_change']) ?></td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= $row['payment_status'] ?></td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                <div class="flex justify-center items-center gap-2">
                  <?php
                  if ($paid !== 'PAID') { ?>
                    <a href="?page=transaction&act=payment-process&id=<?= $row['id'] ?>" class="rounded-lg px-4 font-medium py-1.5 text-xs text-white bg-[#e87918] hover:bg-[#cd5812] transition-all" onclick="return confirm('Are you sure you want to <?= strtolower($buttonText) ?> this order?')">
                      Payment Proccess
                    </a>
                  <?php } ?>
                </div>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>