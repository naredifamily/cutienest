<div class="page_title_bar">
<div class="wrapper">
<h1>Bank Details</h1>


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
<?php echo $this->element('usersection'); ?>
<div class="login_tab afclr">
<div class="tab_left">
<?php echo $this->element('menu-provider'); ?>

</div>
<div class="tab_right">

<div class="wrapper afclr">
<div class="register_form changepassword">
<h2>Bank Details</h2>

<div class="register_form_inner">
<?php $userDetailsAccountName='';
	$userDetailsAccountNumber='';
	$userDetailsiban='';
	$userDetailsswift='';
	if(isset($userbankdetails['userbankdetails']['accountname']))
	{
		$userDetailsAccountName=$userbankdetails['userbankdetails']['accountname'];
	}
	if(isset($userbankdetails['userbankdetails']['accountnumber']))
	{
		$userDetailsAccountNumber=$userbankdetails['userbankdetails']['accountnumber'];
	}
	if(isset($userbankdetails['userbankdetails']['iban']))
	{
		$userDetailsiban=$userbankdetails['userbankdetails']['iban'];
	}
	if(isset($userbankdetails['userbankdetails']['swiftcode']))
	{
		$userDetailsswift=$userbankdetails['userbankdetails']['swiftcode'];
	}
                        echo $this->Form->create('userbankdetails'); ?>
 						<?php echo $this->Form->input('accountname',['type'=>'text','label'=>'Account Name','value'=>$userDetailsAccountName, 'div' => ['class' => '_ef_field']]);?>
						<?php echo $this->Form->input('accountnumber',['type'=>'text','label'=>'Account Number','value'=>$userDetailsAccountNumber,'div' => ['class' => '_ef_field']]);?>
                        <?php echo $this->Form->input('iban',['type'=>'text','label'=>'IBAN Number','value'=>$userDetailsiban,'div' => ['class' => '_ef_field']]);?>
                        <?php echo $this->Form->input('swift',['type'=>'text','label'=>'SWIFT Code','value'=>$userDetailsswift,'div' => ['class' => '_ef_field']]);?>
						 <?php echo $this->Form->input('SUBMIT', ['type' => 'submit','label' => false, 'div' => ['class' => '_ef_field']]); ?>
                           
<?php echo $this->Form->end(); ?>
</div>
</div>
</div>
                   
                   


</div>
</div>
</div>
</div>
