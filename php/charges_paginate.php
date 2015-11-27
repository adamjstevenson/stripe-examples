<?php 
\Stripe\Stripe::setApiKey("sk_your_api_key");

$charges = \Stripe\Charge::all(array("limit" => 100));

foreach ($charges as $charge){
	echo $charge->id;
}

while ($charges->has_more){
	$charges = \Stripe\Charge::all(array("limit" => 100, "starting_after" => end($charges->data->id)));
	
	foreach ($charges as $charge){
		echo $charge->id;
	}
}