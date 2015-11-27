<?php 
// Load Stripe's PHP bindings and set your API key
require_once('vendor/autoload.php');
\Stripe\Stripe::setApiKey('sk_your_api_key');

// Retrieve the first 100 customers created in the last month
$customers = \Stripe\Customer::all(array("limit" => 100));

// Iterate through the first 100 and output the customer ID and created date
foreach ($customers->data as $customer){
	echo $customer->id . " created " . date("m-d-y", $customer->created) . "<br>";
}

// While we have more results, iterate through them
while ($customers->has_more){

	// Add the `starting_after` parameter to reflect the last customer ID
	$customers = \Stripe\Customer::all(array("limit" => 100, "starting_after" => $customer->id));
  
	foreach ($customers->data as $customer){
  	echo $customer->id . " created " . date("m-d-y", $customer->created) . "<br>";
	}
}