<?php

require_once('stripe-php/init.php');

$stripe = array(
  "secret_key"      => "YOUR-API-KEY",
  "publishable_key" => "YOUR-API-KEY"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>