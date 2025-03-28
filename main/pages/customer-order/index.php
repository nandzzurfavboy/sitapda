<?php
$get_url = $_GET['page'];

$getOrder = getData(
  "tb_order",
  "*",
  "",
  "",
  "tb_order.id DESC"
);

?>
<div class="border rounded-xl">
  <div class="px-6 py-2 flex justify-between items-center">
    <h1 class="font-semibold text-[#1d1d1d]">Customer Order</h1>
  </div>
  <hr>
  <div class="p-6">
    <div class="overflow-x-auto">
      <table id="datatable-style" class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
        <thead>
          <tr>
            <th class="whitespace-nowrap text-left px-4 py-2 font-semibold text-gray-900">No</th>
            <th class="whitespace-nowrap text-left px-4 py-2 font-semibold text-gray-900">Customer Name</th>
            <th class="whitespace-nowrap text-left px-4 py-2 font-semibold text-gray-900">Phone No</th>
            <th class="whitespace-nowrap text-left px-4 py-2 font-semibold text-gray-900">Items</th>
            <th class="whitespace-nowrap text-left px-4 py-2 font-semibold text-gray-900">Total Amount</th>
            <th class="whitespace-nowrap text-left px-4 py-2 font-semibold text-gray-900">Status</th>
            <th class="whitespace-nowrap text-left px-4 py-2 font-semibold text-gray-900">Order Date</th>
            <th class="whitespace-nowrap text-center px-4 py-2 font-semibold text-gray-900">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          <?php
          $i = 1;
          foreach ($getOrder as $row) {
            $items = json_decode($row['items'], true);
            $currentStatus = $row['status_order'];
            $buttonText = '';

            if ($currentStatus === 'ORDERED') {
              $buttonText = 'Process';
            } elseif ($currentStatus === 'PROCESSED') {
              $buttonText = 'Proccesed';
            } elseif ($currentStatus === 'DONE') {
              $buttonText = 'Order Received';
            }
          ?>
            <tr class="odd:bg-gray-50">
              <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"><?= $i++ ?></td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= $row['name'] ?></td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= $row['phone_number'] ?></td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                <ul class="list-disc pl-5">
                  <?php foreach ($items as $item) { ?>
                    <li>
                      <?= $item['name'] ?> - <?= toIdr($item['price']) ?> x <?= $item['quantity'] ?>
                    </li>
                  <?php } ?>
                </ul>
              </td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= toIdr($row['grand_total']) ?></td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= $row['status_order'] ?></td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= $row['createdAt'] ?></td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                <div class="flex justify-center items-center gap-2">
                  <?php if ($currentStatus === 'PROCESSED' || $currentStatus === 'DONE') { ?>
                    <span class="rounded-lg px-4 font-medium py-1.5 text-xs text-white bg-green-600 cursor-default"><?= $buttonText ?></span>
                  <?php } else { ?>
                    <a href="?page=customer-order&act=process&id=<?= $row['id'] ?>" class="rounded-lg px-4 font-medium py-1.5 text-xs text-white bg-[#e87918] hover:bg-[#cd5812] transition-all" onclick="return confirm('Are you sure you want to <?= strtolower($buttonText) ?> this order?')">
                      <?= $buttonText ?>
                    </a>
                  <?php } ?>
                  <?php if ($currentStatus !== 'DONE') { ?>
                    <a href="?page=customer-order&act=delete&id=<?= $row['id'] ?>" class="rounded-lg px-4 font-medium py-1.5 text-xs text-white bg-red-600 hover:bg-red-700 transition-all" onclick="return confirm('Cancel this order? ')">
                      Cancel
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