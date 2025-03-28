<?php
session_start();
require 'wa-send.php';

function saveCartToJson()
{
    $cartItems = getCartItems();
    $jsonData = json_encode($cartItems, JSON_PRETTY_PRINT);
    file_put_contents('../mock-data/orderCart.json', $jsonData);
}

function loadCartFromJson()
{
    if (file_exists('../mock-data/orderCart.json')) {
        $jsonData = file_get_contents('../mock-data/orderCart.json');
        $_SESSION['orderCart'] = json_decode($jsonData, true);
    }
}

function getCartItems()
{
    if (isset($_SESSION['orderCart'])) {
        return $_SESSION['orderCart'];
    } else {
        return [];
    }
}

function addToCart($item)
{
    $cartItems = getCartItems();
    $found = false;
    foreach ($cartItems as &$cartItem) {
        if ($cartItem['id'] == $item['id']) {
            $cartItem['quantity'] += 1;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $cartItems[] = $item;
    }
    $_SESSION['orderCart'] = $cartItems;
    saveCartToJson();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $item = [
        'id' => $_POST['id'],
        'code' => $_POST['code'],
        'name' => $_POST['name'],
        'm_category_id' => $_POST['m_category_id'],
        'm_unit_id' => $_POST['m_unit_id'],
        'price' => $_POST['price'],
        'stock' => $_POST['stock'],
        'quantity' => 1
    ];

    addToCart($item);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {
    $index = $_POST['item_index'];
    $action = $_POST['update_quantity'];
    $quantity = $_SESSION['orderCart'][$index]['quantity'];

    if ($action === 'increase') {
        $quantity++;
    } elseif ($action === 'decrease' && $quantity > 1) {
        $quantity--;
    }

    $_SESSION['orderCart'][$index]['quantity'] = $quantity;
    saveCartToJson();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_cart'])) {
    $index = $_POST['item_index'];

    if (isset($_SESSION['orderCart'][$index])) {
        array_splice($_SESSION['orderCart'], $index, 1);
        saveCartToJson();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $customerName = $_POST['customer_name'];
    $phoneNumber = $_POST['phone_number'];
    $grandTotal = array_reduce($_SESSION['orderCart'], function ($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);
    $items = getCartItems();

    $data = [
        'name' => $customerName,
        'phone_number' => $phoneNumber,
        'grand_total' => $grandTotal,
        'items' => json_encode($items),
        'status_order' => 'ORDERED',
        'createdAt' => date('Y-m-d H:i:s'),
        'updatedAt' => date('Y-m-d H:i:s'),
    ];
    $createData = createData('tb_order', $data);

    if ($createData) {
        sendWA($customerName, $phoneNumber, $items, $grandTotal);
        $_SESSION['orderCart'] = [];
        saveCartToJson();
        echo "<script>alert('Your order has been successfully placed! Please check your whatsapp for details');document.location.href='?page=material';</script>";
    } else {
        echo "<script>alert('We’re sorry, but your order could not be processed');document.location.href='index.php?page=cart&act=confirm';</script>";
    }
}
