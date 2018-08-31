<div class="page_title_bar">
<div class="wrapper">
<h1>Policy</h1>
</div>
</div>
<div class="message-upper">
<?php
echo $this->Session->flash();
if($user['User']['admin_approve']!=1){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Your child care home regsitration has been completed. Please wait for admin approval. </p>
<?php }
?>


</div>
<div class="page_content">
<div class="wrapper afclr">

<div class="login_tab afclr">
<div class="tab_left">
            
<?php echo $this->element('menu'); ?>

</div>
<div class="tab_right">

<div class="title_heading">
<h3>Policies</h3>
</div>

<div class="invoice_list">
<?=$content[0]['Page']['body']?>
</div>

<script>
$(document).ready(function () {
    
    // This will automatically grab the 'title' attribute and replace
    // the regular browser tooltips for all <a> elements with a title attribute!
    $('a[title]').qtip();
    
});
</script>



</div>
</div>
</div>
</div>