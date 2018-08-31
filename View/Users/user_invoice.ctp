<div class="page_title_bar">
<div class="wrapper">
<h1>Invoice Management</h1>
</div>
</div>
<div class="message-upper">
<?php
echo $this->Session->flash();
?>
</div>
<div class="page_content">
<div class="wrapper afclr">
<?php echo $this->element('usersection'); ?>

<div class="login_tab afclr">
<div class="tab_left">
            
<?php echo $this->element('menu'); ?>

</div>
<div class="tab_right">

<div class="title_heading">
<h3>Invoices</h3>
</div>
<?php if($this->Common->role()==1){?>
<div class="create_invoice_btn">
<a href="<?=Configure::read('SITE_URL')?>users/createInvoice"><i class="fa fa-plus" aria-hidden="true"></i>Create New Invoice</a>
</div>
<?php }?>
<?php $totalEarning=0;
$paid_amount=0;
$due_amount=0;
 ?>
<div class="invoice_list">
<?php if(!sizeof($invoices)){?>
<div class="custom_pagination no-recod-found">
No Record Found
</div>
<?php }else{
	?>
    <div class="allRequest">
    	<?php foreach($invoices as $invoice)
		{?>
			<div class="Request">
            	<div class="col-md-2">
            		<input type="text" disabled id="childname_<?php echo $invoice['Invoice']['id']; ?>" name="childname[]" value="<?php echo $invoice['enrolldetails']['childname']; ?>">
            	</div>
                <div class="col-md-2">
            		<input type="text" disabled id="childname_<?php echo $invoice['Invoice']['id']; ?>" name="lastname[]" value="<?php echo $invoice['enrolldetails']['lastname']; ?>">
            	</div>
                <?php 
				$startDate = strtotime($invoice['enrolldetails']['startdate']);
				$startDate = date('m-d-Y', $startDate); 
				$endDate = strtotime($invoice['enrolldetails']['enddate']);
				$endDate = date('m-d-Y', $endDate);
				?>
                <div class="col-md-2">
            		<input type="text" disabled id="startdate_<?php echo $invoice['Invoice']['id']; ?>" name="startdate[]" value="<?php echo $startDate; ?>">
            	</div>
                <div class="col-md-2">
            	<input type="text" disabled id="enddate_<?php echo $invoice['Invoice']['id']; ?>" name="enddate[]" value="<?php if(strcmp('0000-00-00',$invoice['enrolldetails']['enddate'])==0){ echo "N/A";}else { echo $endDate; } ?>">
            </div>
                <div class="col-md-1">
            		<input type="text" disabled class="amount" id="amount_<?php echo $invoice['Invoice']['id']; ?>" name="amount[]" placeholder="amount" value="<?php echo $invoice['enrolldetails']['amount']; ?>">
            	</div>
                <div class="col-md-1">
            		<input type="text" disabled id="gender_<?php echo $invoice['Invoice']['id']; ?>" name="gender[]" value="<?php if(strcmp($invoice['enrolldetails']['gender'],'M')==0) { echo "Male";} else { echo "Female";} ?>">
            	</div>
                <div class="col-md-2">
            		<input type="text" disabled id="paymentType_<?php echo $invoice['Invoice']['id']; ?>" name="paymentType[]" value="<?php if(strcmp($invoice['enrolldetails']['paymentfrequency'],'M')==0) { echo "Monthly"; }else if(strcmp($invoice['enrolldetails']['paymentfrequency'],'D')==0) {  echo "Daily";} else { echo "Weekly";} ?>">
            	</div>
                <div class="col-md-2">
                <?php if(!$invoice['Invoice']['status']){?>
            		<input type="button" onClick="window.location='<?php echo Configure::read('SITE_URL') ?>users/paypalpayment?invoice=<?php echo $invoice['Invoice']['id']; ?>'" class="paynow" id="paynow_<?php echo $invoice['Invoice']['id']; ?>" name="paynow_<?php echo $invoice['Invoice']['id']; ?>" value="+ Pay Now">
            	<?php }
				else {
						echo "Payment Done";
					} ?>
                </div>
            </div>
            <div class="clr"></div>
		<?php }?>
    </div>
	<?php
	/*?>
<table style="width:100%;">
<tr>
<td>S.No.</td>
<td>Provider Name</td>
<td>EIN No.</td>
<td>Due Date</td>
<td>Status</td>
<td>Amount</td>
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
<td data-th="Customer Name"><?=$this->Common->getUserName($invoice['Invoice']['provider'])?></td>
<td data-th="EIN No."><?=$invoice['Invoice']['ein']?></td>

<td data-th="Due Date"><?=$this->Common->flipdate($invoice['Invoice']['due_date'])?></td>
<td data-th="Status">
<?php if($invoice['Invoice']['status']){?>
<span class="pay_btn">Paid</span>
<?php } else{?> 
<span class="due_btn">Due</span>
<?php }?>
</td>
<td >
	<?=$invoice['Invoice']['amount'];?>	
</td>
<?php if(!$invoice['Invoice']['status']){?>
<td data-th="Action"><a href="<?php echo Configure::read('SITE_URL') ?>users/paypalpayment?invoice=<?php echo $invoice['Invoice']['id']; ?>"><b>Pay Now</b></a></td>
<?php }
else{?>
	<td data-th="Status">
<span class="pay_btn" style="padding: 3px 15px; color:#fff;">Payment Done</span></td>
<?php }
 ?>
</tr>
<?php $i++; }?>

<table class="invoice_total">

<tr>
	<td><?php if($this->Common->role()==2){ ?>Due Amount <?php } else {?> Total Spend <?php } ?></td><td>$<?php echo $due_amount; ?></td> </tr>
	<tr><td><?php if($this->Common->role()==2){ ?>Paid Amount <?php } else {?> Total Spend <?php } ?></td><td>$<?php echo $paid_amount; ?></td></tr>
	<tr><td><?php if($this->Common->role()==2){ ?>Total Amount <?php } else {?> Total Spend <?php } ?></td><td>$<?php echo $totalEarning; ?></td>
</tr>
</table>
</table>
<?php */}?>
</div>

<script>
$(document).ready(function () {
    
    // This will automatically grab the 'title' attribute and replace
    // the regular browser tooltips for all <a> elements with a title attribute!
    $('a[title]').qtip();
    
});

</script>
<style>
</style>


</div>
</div>
</div>
</div>