<div class="page_title_bar">
<div class="wrapper">
<h1>Invoice Management</h1>
</div>
</div>
<div class="message-upper">
<?php
echo $this->Session->flash();
if($user['User']['provider_req']==1 && $user['User']['role']==1){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Your child care home registration has been completed. Please wait for admin approval. </p>
<?php }
else if($user['User']['provider_req']==3 && $user['User']['role']==1){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Your child care Profile is Rejected, Please contact to Admin. </p>
<?php } 
else if($user['User']['provider_req']==4 && $user['User']['role']==1){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Your child care Profile is Deactivated, Please contact to Admin. </p>
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
<h3>Invoices</h3>
</div>
<?php $totalEarning=0;
$paid_amount=0;
$due_amount=0;
 ?>
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
<td>EIN No.</td>
<td>Due Date</td>
<td>Amount</td>
<td>Status</td>
<td>Action</td>
</tr>
<?php 
$i=1;
//pr($invoices);
foreach($invoices as $invoice){
if($invoice['Invoice']['status']){
$paid_amount+=(float)$invoice['Invoice']['amount'];
}
else{
$due_amount+=(float)$invoice['Invoice']['amount'];
}

$totalEarning+=(float)$invoice['Invoice']['amount'];
?>
<tr>
<td data-th="S.No."><?=$i?></td>
<td data-th="Customer Name"><?=$this->Common->getUserName($invoice['Invoice']['user'])?></td>
<td data-th="EIN no."><?=$invoice['Invoice']['ein']?></td>
<td data-th="Due Date"><?=$this->Common->flipdate($invoice['Invoice']['due_date'])?></td>
<td data-th="Amount">$<?=$invoice['Invoice']['amount'];?></td>
<td data-th="Status">
<?php if($invoice['Invoice']['status']){?>
<span class="pay_btn">Paid</span>
<?php } else{?> 
<span class="due_btn">Due</span>
<?php }?>
</td>
<td data-th="Action">
					
<?php if($invoice['Invoice']['status']=='0'){?><a href="<?=Configure::read('SITE_URL')?>invoices/changestatus/<?=$invoice['Invoice']['id']?>" title="Active"><i class="fa fa-check" aria-hidden="true"></i></a><span>/<?php }?></span>
					<a href="<?=Configure::read('SITE_URL')?>invoices/delete/<?=$invoice['Invoice']['id']?>" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
					<?php if($invoice['Invoice']['status']=='0'){?><span>/</span><a href="<?=Configure::read('SITE_URL')?>users/updateInvoice/<?=$invoice['Invoice']['id']?>" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a><?php } ?>
					<span></span>
                   </td>
</tr>
<?php $i++; }?>
<table class="invoice_total">

<tr>
	<td><?php if($this->Common->role()==1){ ?>Due Amount <?php } else {?> Total Spend <?php } ?></td><td>$<?php echo $due_amount; ?></td> </tr>
	<tr><td><?php if($this->Common->role()==1){ ?>Paid Amount <?php } else {?> Total Spend <?php } ?></td><td>$<?php echo $paid_amount; ?></td></tr>
	<tr><td><?php if($this->Common->role()==1){ ?>Total Amount <?php } else {?> Total Spend <?php } ?></td><td>$<?php echo $totalEarning; ?></td>
</tr>
</table>
</table>
<?php }?>
</div>
<?php if($this->Common->role()==1){?>
<div class="create_invoice_btn">
<a href="<?=Configure::read('SITE_URL')?>users/createInvoice"><i class="fa fa-plus" aria-hidden="true"></i>Create New Invoice</a>
</div>
<?php }?>
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