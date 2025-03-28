<?php

function sendWA($customerName, $phoneNumber, $cartItems, $grandTotal)
{
  $token = "jCRKsrzzmwNbeHQEg9k1";
  $message = "Halo $customerName,\n\n";
  $message .= "Ini adalah detail pesanan Anda:\n";
  foreach ($cartItems as $item) {
    $message .= "\n{$item['name']} - " . toIdr($item['price']) . " x {$item['quantity']}";
  }
  $message .= "\n\nTotal keseluruhan: " . toIdr($grandTotal) . "\n\n";
  $message .= "Terima kasih atas pesanan Anda. Mohon segera lanjutkan pembayaran agar kami dapat memproses pesanan Anda.";
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.fonnte.com/send',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array(
      'target' => $phoneNumber,
      'message' => $message,
      'delay' => '2',
      'countryCode' => '62',
    ),
    CURLOPT_HTTPHEADER => array(
      "Authorization: $token"
    ),
  ));
  curl_exec($curl);
  curl_close($curl);
}

function sendWAConfirmOrder($customerName, $phoneNumber, $transactionCode, $orderCreated)
{
  $token = "jCRKsrzzmwNbeHQEg9k1";
  $message = "Halo $customerName,\n\n";
  $message .= "Pesanan Anda dengan nomor #$transactionCode yang dibuat pada tanggal $orderCreated telah berhasil kami konfirmasi\n";
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.fonnte.com/send',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array(
      'target' => $phoneNumber,
      'message' => $message,
      'delay' => '2',
      'countryCode' => '62',
    ),
    CURLOPT_HTTPHEADER => array(
      "Authorization: $token"
    ),
  ));
  curl_exec($curl);
  curl_close($curl);
}
