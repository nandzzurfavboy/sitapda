<?php
// component
require '../components/input/input.php';

// get value id
$id = $_GET['id'];
$row = getData(
  'tb_transaction',
  'tb_transaction.*, tb_order.*',
  'JOIN tb_order ON tb_transaction.m_order_id = tb_order.id',
  'tb_transaction.id = ' . intval($id)
);
$value = $row[0];

?>

<div class="border rounded-xl max-w-2xl mx-auto">
  <div class="px-6 py-2 flex justify-between items-center">
    <h1 class="font-semibold text-[#1d1d1d]">Payment Transaction</h1>
  </div>
  <hr>
  <div class="p-6">
    <div>
      <p class="text-sm text-gray-500">Total payments from this transaction amounted to</p>
      <span class="font-medium"><?= toIdr($value['grand_total']) ?></span>
    </div>
    <form method="POST" class="mt-4">
      <div class="space-y-4">
        <div class="">
          <?= baseInput('Payment Amount', 'payment_amount', true, 'number', $value['payment_amount'], 'Enter payment amount', 'off') ?>
        </div>

        <div class="flex items-center gap-2">
          <button type="submit" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none transition-all">
            <span>Submit</span>
          </button>
          <a href="?page=transaction" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-gray-200 text-gray-500 hover:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none transition-all">
            Cancel
          </a>
        </div>
      </div>
    </form>
  </div>
</div>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $paymentAmount = $_POST['payment_amount'];
  $grandTotal = $value['grand_total'];

  if ($paymentAmount >= $grandTotal) {
    $data = [
      'payment_amount' => $paymentAmount,
      'payment_change' => $paymentAmount - $grandTotal,
      'payment_status' => 'PAID'
    ];

    $editData = updateData('tb_transaction', $data, 'id =' . intval($id));

    if ($editData) {
      updateData('tb_order', ['status_order' => 'DONE'], 'id =' . intval($value['m_order_id']));
      $items = json_decode($value['items'], true);

      foreach ($items as $item) {
        $newStock = $item['stock'] - $item['quantity'];
        $updateStock = updateData('tb_product', ['stock' => $newStock], 'id =' . intval($item['id']));

        if (!$updateStock) {
          echo "<script>
                  alert('Failed to update stock for item {$item['name']}');
                </script>";
          exit;
        }
      }      

      echo "<script>
              alert('Success to payment and update stock');
              document.location.href='index.php?page=transaction';
            </script>";
    } else {
      echo "<script>
              alert('Failed to payment');
            </script>";
    }
  } else {
    echo "<script>
            alert('Your balance is insufficient to perform this transaction');
          </script>";
  }
}

?>
