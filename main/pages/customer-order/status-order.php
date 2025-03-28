<?php
$id = $_GET['id'];
$row = getData('tb_order', '*', '', 'id = ' . intval($id));

if (empty($row)) {
    echo "<script>
            alert('Order not found');
            document.location.href='index.php?page=customer-order';
          </script>";
    exit;
}

$value = $row[0];
$currentStatus = $value['status_order'];

$status = [];
if ($currentStatus === 'ORDERED') {
    $status['status_order'] = 'PROCESSED';
    $prefix = 'TBA' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));

    $transactionData = [
        'transaction_no' => $prefix,
        'm_order_id' => intval($id),
        'payment_status' => 'UNPAID',
        'createdAt' => date('Y-m-d H:i:s'),
        'updatedAt' => date('Y-m-d H:i:s')
    ];
    createData('tb_transaction', $transactionData);
    $updateOrder = updateData('tb_order', $status, 'id =' . intval($id));

    if ($updateOrder) {
        sendWAConfirmOrder($value['name'], $value['phone_number'], $prefix, $value['createdAt']);
        echo "<script>
                alert('Success to update order and create transaction');
                document.location.href='index.php?page=customer-order';
              </script>";
    } else {
        echo "<script>
                alert('Failed to update order');
              </script>";
    }
} elseif ($currentStatus === 'PROCESSED') {
    echo "<script>
            alert('Order is already processed');
            document.location.href='index.php?page=customer-order';
          </script>";
    exit;
} else {
    echo "<script>
            alert('Order status cannot be updated from current status');
            document.location.href='index.php?page=customer-order';
          </script>";
    exit;
}
