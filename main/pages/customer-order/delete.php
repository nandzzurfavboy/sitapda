<?php
$id = intval($_GET['id']);

// Start a transaction
mysqli_begin_transaction($conn);

try {
  $deleteTransaction = deleteData('tb_transaction', 'm_order_id = ' . $id);

  if (!$deleteTransaction) {
      throw new Exception('Failed to delete transactions');
  }

  $deleteOrder = deleteData('tb_order', 'id = ' . $id);

  if ($deleteOrder) {
      mysqli_commit($conn);
      echo "<script>
              alert('Success to delete order and its transactions');
              document.location.href='index.php?page=customer-order';
            </script>";
  } else {
      mysqli_rollback($conn);
      echo "<script>
              alert('Failed to delete order');
              document.location.href='index.php?page=customer-order';
            </script>";
  }
} catch (Exception $e) {
  mysqli_rollback($conn);
  echo "<script>
          alert('An error occurred: " . $e->getMessage() . "');
          document.location.href='index.php?page=customer-order';
        </script>";
}