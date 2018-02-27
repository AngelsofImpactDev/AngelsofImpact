<?php
include_once('Veritrans.php');

// Set our server key
Veritrans_Config::$serverKey = 'VT-server-ENaRGkrk8Wp0q9qdYrVoG2xS';

// Use sandbox account
Veritrans_Config::$isProduction = false;

// Required
$transaction_details = array(
  'order_id' => rand(),
  'gross_amount' => 145000,
  );

// Optional
$billing_address = array(
    'first_name'    => "Andri",
    'last_name'     => "Litani",
    'address'       => "Mangga 20",
    'city'          => "Jakarta",
    'postal_code'   => "16602",
    'phone'         => "081122334455",
    'country_code'  => 'IDN'
    );

// Optional
$shipping_address = array(
    'first_name'    => "Obet",
    'last_name'     => "Supriadi",
    'address'       => "Manggis 90",
    'city'          => "Jakarta",
    'phone'         => "08113366345",
    'country_code'  => 'IDN'
    );

// Optional
$customer_details = array(
    'first_name'    => "Andri",
    'last_name'     => "Litani",
    'email'         => "andri@litani.com",
    'phone'         => "081122334455",
    'billing_address'  => $billing_address,
    'shipping_address' => $shipping_address
    );

// Fill transaction details
$transaction = array(
    'payment_type' => 'vtweb',
    'vtweb' => array(
        'credit_card_3d_secure' => true,
        ),
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details
    );

$vtweb_url = Veritrans_Vtweb::getRedirectionUrl($transaction);

// Go to VT-Web page
header('Location: ' . $vtweb_url);
?>