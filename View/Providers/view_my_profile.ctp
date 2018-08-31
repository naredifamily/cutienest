<?php if(isset($user['User']['stage'])&&$user['User']['stage']!='0'){?>
<style>
.licnoout, .helplic{display:block;}
</style>
<?php }?>
<?php ?>
<?php $states=$this->Common->getState();?>
<style>
.register_form {
    width: 100%;
    border: none;
    padding: 0;
}
</style>

<div class="page_title_bar">
<div class="wrapper afclr">
	<div class="ud_outer afclr">
	<div class="user_profile_img_detail">

</div>
<h1>View Profile</h1>
</div>
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
<?php } ?>

</div>
<div class="page_content">

<div class="wrapper afclr">
<div class="login_tab afclr">
<div class="tab_left">
<?php echo $this->element('menu-provider'); ?>
</div>
<div class="tab_right">
<div class="register_form">
<div class="title_heading" style=" padding-bottom:10px;">
<h3 style="background:none;"><?php echo $user['User']['name']; ?></h3>
</div>

<div class="register_form_inner">
<?php $states=$this->Common->getState();?>
 <?php echo $this->Form->create('User'); ?>
	<p>
 	<?php echo $this->Form->input('id', ['type' => 'hidden','disabled' => 'disabled','value'=>$this->Common->loginUserId(),'label' => false]); ?>
 		
 	</p> 

<div class="personal_details_profile afclr">
	<span><i class="fa fa-phone"></i> <?php echo $user['User']['phone']; ?></span> &nbsp;&nbsp;|&nbsp;&nbsp; 
	<span><i class="fa fa-envelope"></i> <?php echo $user['User']['email']; ?></span>
</div>

<p><label><i class="fa fa-map-marker"></i> &nbsp;&nbsp;&nbsp;</label><?php echo $user['User']['address']; ?></p>

<p class="licnoout" <?php if(strcmp($user['User']['licenceno'],'')!=0) { echo 'style="display: block;"';} else { echo 'style="display: none;"'; } ?>><label>Licence No: </label><?php echo $user['User']['licenceno']; ?>
<?php if(strcmp($user['User']['licence_image'],'')!=0){ ?> 
<a target="_blank" href="<?php echo Configure::read('SITE_URL')?>uploads/img/upload_folder/<?php echo $user['User']['licence_image']; ?>">View License</a>
<?php } ?>
</p>

<p class="licnoout" <?php if(strcmp($user['User']['howmanyyears'],'')!=0) { echo 'style="display: block;"';} else { echo 'style="display: none;"'; } ?>><label>How many years: </label><?php echo $user['User']['howmanyyears']; ?>
</p>



</div>
<p <?php if($user['User']['stage']=='0'){?> style="display:block;" <?php } else{?> style="display:none;" <?php }?> class="helplic">
	<label>Help Licence : </label><?php
	if($user['User']['helplicence']==0)
	{
		echo "Yes";
	}
	else
	{
		echo "No";
	}
	 ?></p>
	


<?php // echo $this->Form->input('SUBMIT', ['type' => 'submit','label' => false]); ?><br><br>
          <div class="clear"></div>           
<?php echo $this->Form->end(); ?>
</div>
<?php $providerArray=array_unique($providerArray); ?>
<div class="clr"></div>
<div class="profile_segment">
	<div class="title_heading">
	<h3>Customers</h3>
	</div>
	<div class="invoice_list">
<table style="width:100%;">
<tr>
<td>#</td>
<td>Provider Name</td>
</tr>

	<?php 
		$i=1;
	foreach($providerArray as $provider)
	{?>
		<tr>
			<td data-th="#"><?php echo $i; ?></td>
			<td data-th="Customer Name"><?php echo $this->Common->getUserName($provider); ?></td>
		</tr>
	<?php $i++; }?>
</table>
</div>
</div>


<div class="title_heading">
<h3>Invoices</h3>
</div>
<div class="invoice_list">
<?php if(!sizeof($invoices)){?>
<div class="custom_pagination no-recod-found">
No Record Found
</div>
<?php }else{?>
<table style="width:100%;">
<tr>
<td>#</td>
<td>Customer Name</td>
<td>Last Paid Date</td>
<td>Status</td>

</tr>
<?php 
$i=1;
//pr($invoices);
foreach($invoices as $invoice){?>
<tr>
<td data-th="#"><?=$i?></td>
<?php 
$due_date = strtotime($invoice['Invoice']['due_date']);
$due_date = date('m-d-Y', $due_date); ?>
<td data-th="Customer Name"><?=$this->Common->getUserName($invoice['Invoice']['user'])?></td>
<td data-th="Last Paid Date"><?=$due_date?></td>
<td data-th="Status">
<?php if($invoice['Invoice']['status']){?>
<span class="pay_btn" style="color:#ffffff;">Paid</span>
<?php } else{?> 
<span class="due_btn" style="color:#ffffff;">Due</span>


<?php }?>
</td>
<?php /*<td data-th="Action">
					
<?php if($invoice['Invoice']['status']=='0'){?><a href="<?=Configure::read('SITE_URL')?>invoices/changestatus/<?=$invoice['Invoice']['id']?>" title="Active"><i class="fa fa-check" aria-hidden="true"></i></a><span>/<?php }?></span>
					<a href="<?=Configure::read('SITE_URL')?>invoices/delete/<?=$invoice['Invoice']['id']?>" title="Edit"><i class="fa fa-trash" aria-hidden="true"></i></a><span></span>
                   </td>*/ ?>
</tr>
<?php $i++; }?>
</table>
<?php }?>
</div><br><br>
<div class="title_heading">
<h3>Reviews</h3>
</div>
<div class="invoice_list">
<?php if(!sizeof($data)){?>
<div class="custom_pagination no-recod-found">
No Record Found
</div>
<?php }else{?>

<table style="width:100%;">
<tr>
<td>#</td>
<td>Name</td>
<td>Rating</td>
<td>Review</td>
<?php /*<td>Edit</td> */ ?>
</tr>
<?php  $i=1; foreach($data as $users){?>
<tr>
<td data-th="#"><?=$i?></td>
<td data-th="Customer Name"><?=$this->Common->getUserName($users['reviews']['provider'])?></td>
<td data-th="Last Paid Date">

<?php 
$per=($users['reviews']['rating']*100)/5?>
<div class="ratings">
  <div class="empty-stars"></div>
  <div class="full-stars" style="width:<?=$per?>%"></div>
</div>
</td>
<td data-th="Last Paid Date"><?=substr($users['reviews']['review'],0,50)?></td>

</tr>
<?php $i++; }?>
</table>
<?php }?>
<br><br>
</div>
<div class="pull-center">
	<div class="lo_right">
		<a href="javascript:deleteAccount();">Delete Account</a>
	</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
	function deleteAccount()
	{
		if(confirm('do you really want delete your account?'))
		{
			jQuery(document).ready(function(e) {
                jQuery.ajax({
					url:"<?php echo Router::url('/providers/deleteaccount', true); ?>",
					type:"GET",
					success: function(data)
					{
						window.location.href="<?=Router::url('/providers/logout',true);?>";
					},
					error:function(error)
					{
						
					}
				});
            });	
		}
	}
</script>