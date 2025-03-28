<?php require "../../../../db/config.php" ?>
<?php require '../../../../utilities/func/query.php' ?>

<?php
if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
  $startDate = $_POST['start_date'];
  $endDate = $_POST['end_date'];
  exportToExcel($startDate, $endDate);
}

function exportToExcel($startDate, $endDate) {
  $getSales = getData(
      "tb_transaction",
      "tb_transaction.*, tb_order.name as order_name",
      "JOIN tb_order ON tb_transaction.m_order_id = tb_order.id",
      "payment_status = 'PAID' AND DATE(tb_transaction.createdAt) BETWEEN '$startDate' AND '$endDate'",
      "tb_transaction.id DESC"
  );

  // Check if data is available
  if (empty($getSales)) {
      echo '<p>No data available for the specified date range.</p>';
      return;
  }

  header("Content-Type: application/vnd.ms-excel");
  header("Content-Disposition: attachment;filename=\"sales_report_" . date("Y-m-d") . ".xls\"");
  header("Cache-Control: max-age=0");

  echo "<table border='1'>";
  echo "<tr>
          <th>Transaction No</th>
          <th>Order ID</th>
          <th>Customer Name</th>
          <th>Payment Amount</th>
          <th>Payment Change</th>
          <th>Payment Status</th>
        </tr>";

  foreach ($getSales as $row) {
      echo "<tr>";
      echo "<td>{$row['transaction_no']}</td>";
      echo "<td>{$row['m_order_id']}</td>";
      echo "<td>{$row['order_name']}</td>";
      echo "<td>{$row['payment_amount']}</td>";
      echo "<td>{$row['payment_change']}</td>";
      echo "<td>{$row['payment_status']}</td>";
      echo "</tr>";
  }

  echo "</table>";
  exit();
}
?>
?>