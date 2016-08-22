<?php 
  // Load Stripe's PHP library and set your secret keys
  require_once("config.php"); 
  // Create the authorization
  require_once("authorize.php"); 
?>
<html>
  <head>
    <style>
      .spacing {
        margin-top:20px;
      }
      .success {
        color: #fff;
        background-color: green;
      }
      .error {
        color: #fff;
        background-color: red;
      }
    </style>
  </head>
  <body>
    <?php if (isset($success)): ?>
      <div class='success'><?php echo $success; ?></div>
    <?php else: ?>
      <?php if (isset($error)): ?>
        <div class='error'><?php echo $error; ?></div>
      <?php endif ?> 
      <form action="" method="POST" class="spacing">
        <script
          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key="<?= $stripe['publishable_key']; ?>"
          data-label="Authorize"
          data-panel-label="Authorize Card"
          data-name="My Biz"
          data-description="Card authorization"
          data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
          data-locale="auto">
        </script>
      </form>
    <?php endif ?>    
  </body>
</html>