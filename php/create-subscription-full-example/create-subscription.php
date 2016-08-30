<?php 
  // Check for a POSTed stripeToken
  if (isset($_POST['stripeToken'])){
    try {
      \Stripe\Customer::create(array(
        "description" => $_POST['stripeEmail'],
        "source" => $_POST['stripeToken'], // The token submitted from Checkout
        "plan" => "gold"
      ));
      $success = "Thanks! You've subscribed to the Gold plan.";
    }
    catch(\Stripe\Error\Card $e) {
      // Since it's a decline, \Stripe\Error\Card will be caught
      $body = $e->getJsonBody();
      $error  = $body['error']['message'];
    } catch (\Stripe\Error\RateLimit $e) {
      $error = "Sorry, we weren't able to authorize your card. You have not been charged.";
    } catch (\Stripe\Error\InvalidRequest $e) {
      $error = "Sorry, we weren't able to authorize your card. You have not been charged.";
    } catch (\Stripe\Error\Authentication $e) {
      $error = "Sorry, we weren't able to authorize your card. You have not been charged.";
    } catch (\Stripe\Error\ApiConnection $e) {
      $error = "Sorry, we weren't able to authorize your card. You have not been charged.";
    } catch (\Stripe\Error\Base $e) {
      $error = "Sorry, we weren't able to authorize your card. You have not been charged.";
    } catch (Exception $e) {
      $error = "Sorry, we weren't able to authorize your card. You have not been charged.";
    }
  }
?>