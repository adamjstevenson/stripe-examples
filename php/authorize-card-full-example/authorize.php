<?php 
	// Check for a POSTed stripeToken
	if (isset($_POST['stripeToken'])){
		try {
			\Stripe\Customer::create(array(
			  "description" => $_POST['stripeEmail'],
			  "source" => $_POST['stripeToken'] // The token submitted from Checkout
			));
			$success = "Thanks! Your card has been authorized.";
		}
		catch(\Stripe\Error\Card $e) {
		  // Since it's a decline, \Stripe\Error\Card will be caught
		  $body = $e->getJsonBody();
		  $error  = $body['error']['message'];
		} catch (\Stripe\Error\RateLimit $e) {
		  $error = "Sorry, we weren't able to authorize your card. Please try again.";
		} catch (\Stripe\Error\InvalidRequest $e) {
		  $error = "Sorry, we weren't able to authorize your card. Please try again.";
		} catch (\Stripe\Error\Authentication $e) {
		  $error = "Sorry, we weren't able to authorize your card. Please try again.";
		} catch (\Stripe\Error\ApiConnection $e) {
		  $error = "Sorry, we weren't able to authorize your card. Please try again.";
		} catch (\Stripe\Error\Base $e) {
		  $error = "Sorry, we weren't able to authorize your card. Please try again.";
		} catch (Exception $e) {
		  $error = "Sorry, we weren't able to authorize your card. Please try again.";
		}
	}
?>