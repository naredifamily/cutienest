<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <!-- Prepopulate the PayPal checkout page with customer details, -->
   
    <input type="hidden" name="email" value="<?php echo $user['User']['email'] ?>">
    
<input type="hidden" name="item_number" value="Cutienest Invoice Payment">

    <input type="hidden" name="cmd" value="_xclick" />
    <input type="hidden" name="business" value="admin@cutienest.com" /> <!-- arun.explorer7-facilitator@gmail.com -->
    <input type="hidden" name="currency_code" value="USD" />
     <input type="hidden" name="description" value="Cutienest Invoice Payment" />
    <!-- Custom value you want to send and process back in the IPN -->
    <input type="hidden" name="custom" value="<?php echo $invoices[0]['Invoice']['id'] ?>" />
    <input type="hidden" name="amount" value="<?php echo $invoices[0]['Invoice']['amount'] ?>" />
    <input type="hidden" name="return" value="<?php echo Configure::read('SITE_URL') ?>users/userInvoice"/>
    <input type="hidden" name="cancel_return" value="<?php echo Configure::read('SITE_URL') ?>users/cancel" />

    <!-- Where to send the PayPal IPN to. -->
    <input type="submit" value="submit" style="display: none" id="paypal_payment">
    <input type="hidden" name="notify_url" value="<?php echo Configure::read('SITE_URL') ?>pages/ipnpaypal" />
</form>
<div class="page_title_bar" style="margin: 12px;">
<div class="wrapper">
<h1 style="text-align: center;">We are redirecting to paypal please wait.....</h1>
</div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function ()
    {
        jQuery("#paypal_payment").click();
    });
</script>