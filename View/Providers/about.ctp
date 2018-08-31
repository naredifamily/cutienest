<div class="page_title_bar">
<div class="wrapper">
<h1>About Us</h1>
</div>
</div>
<div class="message-upper">
<?php
echo $this->Session->flash();
if($user['User']['provider_req']==1){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Your child care home registration has been completed. Please wait for admin approval. </p>
<?php }
else if($user['User']['provider_req']==3){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Your child care Profile is Rejected, Please contact to Admin. </p>
<?php } 
else if($user['User']['provider_req']==4){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Your child care Profile is Deactivated, Please contact to Admin. </p>
<?php } 
?>
</div>
<div class="page_content">
<div class="wrapper afclr">

<div class="login_tab afclr">
<div class="tab_left">
<?php echo $this->element('menu-provider'); ?>
</div>
<div class="tab_right">
<div class="title_heading">
<h3>About Us</h3>
</div>
<div class="create_invoice_btn">
</div>
<div class="invoice_list">
<div class="register_form_inner">
 <?php echo $this->Form->create('User',array('class'=>'form-horizontal form-material')); ?>
 <?php echo $this->Form->input('id', ['required' => true,'value'=>$this->Common->loginUserId(),'type' => 'hidden','class' => 'form-control form-control-line', 'label' => false]); ?>
<p><?php echo $this->Form->textarea('about', ['placeholder' => 'About Store','value'=>$content['User']['about'],'class'=>'tinymce' ,'label' => false]); ?></p>
<p><?php echo $this->Form->input('SUBMIT', ['type' => 'submit','class' => 'update-about','label' => false]); ?></p>
</div>
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