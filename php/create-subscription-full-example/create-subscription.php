<?php 
  // Check for a POSTed stripeToken and subscription
  if (isset($_POST['stripeToken']) && isset($_POST['plan'])){
    try {
      \Stripe\Customer::create(array(
        "description" => $_POST['stripeEmail'],
        "source" => $_POST['stripeToken'], // The token submitted from Checkout
        "plan" => $_POST['plan']
      ));
      $success = "Thanks! You've subscribed to the " . $_POST['plan'] .  " plan.";
    }
    catch(\Stripe\Error\Card $e) {
      // Since it's a decline, \Stripe\Error\Card will be caught
      $body = $e->getJsonBody();
      $error  = $body['error']['message'];
    } 
    // Probably want to log all of these for later or send yourself a notification
    catch (\Stripe\Error\RateLimit $e) {
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