<?php
$get_url = $_GET['page'];
$columns = array(
  'transaction_no' => 'Transaction No',
  'm_order_id' => 'Order ID',
  'order_name' => 'Customer Name',
  'payment_amount' => 'Payment Amount',
  'payment_change' => 'Payment Change',
  'payment_status' => 'Payment Status',
);

$getSales = [];
$startDate = '';
$endDate = '';

if (isset($_POST['generate_report'])) {
  $startDate = $_POST['start_date'];
  $endDate = $_POST['end_date'];
  $getSales = getData(
    "tb_transaction",
    "tb_transaction.*, tb_order.name as order_name",
    "JOIN tb_order ON tb_transaction.m_order_id = tb_order.id",
    "payment_status = 'PAID' AND DATE(tb_transaction.createdAt) BETWEEN '$startDate' AND '$endDate'",
    "tb_transaction.id DESC"
  );
}
?>

<div class="border rounded-xl">
  <div class="px-6 py-2 flex justify-between items-center">
    <h1 class="font-semibold text-[#1d1d1d]">Report Sales</h1>
  </div>
  <hr>
  <div class="p-6">
    <form method="POST" action="">
      <div class="flex space-x-4 mb-4">
        <div class="w-full">
          <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
          <input type="date" name="start_date" id="start_date" class="mt-1 w-full rounded-lg border py-2 px-4 border-gray-200 shadow-sm sm:text-sm" value="<?= htmlspecialchars($startDate) ?>" required>
        </div>
        <div class="w-full">
          <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
          <input type="date" name="end_date" id="end_date" class="mt-1 w-full rounded-lg border py-2 px-4 border-gray-200 shadow-sm sm:text-sm" value="<?= htmlspecialchars($endDate) ?>" required>
        </div>
      </div>
      <div class="flex space-x-4 justify-end">
        <button type="submit" name="generate_report" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none transition-all">
          Generate
        </button>
      </div>
    </form>
    <hr class="my-10">
    <?php
    if (!empty($getSales)) {  ?>
      <form method="POST" action="pages/report/sales/export-to-excel.php" class="mb-4">
        <input type="hidden" name="start_date" value="<?= htmlspecialchars($startDate) ?>">
        <input type="hidden" name="end_date" value="<?= htmlspecialchars($endDate) ?>">
        <button type="submit" name="export" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none transition-all">
          Export to Excel
        </button>
      </form>
      <?= customTable($getSales, $columns, $get_url) ?>
    <?php } else {
      require '../components/empty/empty.php';
    } ?>
  </div>
</div>