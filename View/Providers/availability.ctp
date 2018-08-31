<div class="page_title_bar">
<div class="wrapper">
<h1>Availability Management</h1>
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

<div class="title_heading">
<h3>Availability</h3>
</div>
<div class="price_sheet availability">
 <?php echo $this->Form->create('Availability'); 
 
 if($data=='available')
{
	$data_array=array();
}
else{
	$data_array = unserialize($data);
}
if(empty($data_array))
{
	$allSpot = array(
   	 	'legend' => false,
		'checked'=>'checked',
		'onclick'=>"avail('Y')",
		'class'=>'avail-radio',
		'name'=>'type'
	);
}
else
{
	$allSpot = array(
    'legend' => false,
	'onclick'=>"avail('Y')",
	'class'=>'avail-radio',
	'name'=>'type'
	);
}
if(!empty($data_array))
{
	$spot=array(
    'legend' => false, 
	'checked'=>'checked',
	'onclick'=>"avail('N')",
	'class'=>'avail-radio',
	'name'=>'type'
	);
}
else
{	
	$spot=array(
    'legend' => false,
	'onclick'=>"avail('N')",
	'class'=>'avail-radio',
	'name'=>'type'
	);
}
 ?>
<table style="width:100%;">
<tr>
<td data-th="" colspan="3">

<?php echo $this->Form->radio('type',array('Fullday'=>'All spots available'),$allSpot);?>
<?php /*
<input <?php if(empty($data_array)){?> checked="checked" <?php }?> onclick="avail('Y')"  type="radio" class="avail-radio" name="type" value="Fullday">All spots available
*/ ?>
</td>
</tr>
<tr>
<td data-th="" colspan="3">
<?php echo $this->Form->radio('type',array('Halfday'=>'Spots available'),$spot); ?> 
<?php /*
<input  <?php if(!empty($data_array)){?> checked="checked" <?php }?> onclick="avail('N')" type="radio" class="avail-radio" name="type" value="Halfday">Spots available
*/ ?>

</td>
</tr>
</table>
<div id="customFieldsdiv"  <?php if(empty($data_array)){?>style="display:none;" <?php }?>>
<table id="customFields" >
<tr>
<td>Age Group</td>
<td>From</td>
<td>To</td>
<td>Seat</td>
</tr>
<?php

 foreach( $data_array as $pricelist){
?>



<tr>
<td data-th="Name"><select name="agegroup[]" required ><option <?php if($pricelist['agegroup']=='0-2'){?> selected <?php }?> value="0-2">0-2</option><option <?php if($pricelist['agegroup']=='2-4'){?> selected <?php }?> value="2-4">2-4</option><option <?php if($pricelist['agegroup']=='4-5'){?> selected <?php }?> value="4-5">4-5</option><option <?php if($pricelist['agegroup']=='Afterschool'){?> selected <?php }?> value="Afterschool">Afterschool</option></select>
</td>


<td data-th="Amount"><input required type="text" name="from[]" class="datepicker selector" placeholder="" value="<?=date('m-d-Y', strtotime($pricelist['from']))?>"></td>


<td data-th="Amount"><input  type="text" name="to[]" class="datepicker selector" placeholder="" value="<?php if($pricelist['to'] != '2100-12-31'){ echo date('m-d-Y', strtotime($pricelist['to'])); } ?>"></td>
<td data-th="Amount"><input required type="text" name="seat[]" placeholder="" value="<?=$pricelist['seat']?>"></td>

<td><a href="javascript:void(0);" class="remCF"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></td>
</tr>

<?php }?>

</table>
<div class="add_row_btn">
<a href="javascript:void(0);" class="addCF">Add Row</a>
</div>
<table >

<tr>
<td colspan="2"><span class="careof"><input type="checkbox" <?php if($careof_weekend==1){?> checked="checked" <?php }?> name="careof_weekend" class="css-checkbox" id="weekendsCare"  value="1"><label for="weekendsCare" class="css-label">Provide Care on Weekends</label></span></td>
<td colspan="2"><span class="careof"><input type="checkbox" <?php if($careof_holiday==1){?> checked="checked" <?php }?> name="careof_holiday"  class="css-checkbox" id="holidayCare" value="1"><label for="holidayCare" class="css-label">Provide Care on Holidays</label></span></td>
<td colspan="2"><span class="careof"><input type="checkbox" <?php if($careof_holiday==1){?> checked="checked" <?php }?> name="careof_holiday"  class="css-checkbox" id="nightCare" value="1"><label for="nightCare" class="css-label">Provide Care in Nights</label></span></td>
</tr>
</table>

</div>
<div class="clr"></div>

<div class="create_invoice_btn">
 <?php echo $this->Form->input('Save Availability', ['type' => 'submit','class'=>'saveprice','label' => false]); ?></div>

<?php echo $this->Form->end(); ?>

</div>


</div>
</div>
</div>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="<?php echo Configure::read('SITE_URL') ?>js/jquery-ui.js"></script>
  <script>
  $( function() {
	  $( ".datepicker" ).datepicker({ dateFormat: 'mm-dd-yy' });
   <!-- $( ".datepicker" ).datepicker();-->
   $( ".selector" ).datepicker({ dateFormat: 'mm-dd-yy' });
  } );
  </script>

<script>
$(document).ready(function(){
	$(".addCF").click(function(){
		$("#customFields").append('<tr><td data-th="Day"><select required  name="agegroup[]"><option value="0-2">0-2</option><option value="2-4">2-4</option><option value="4-5">4-5</option><option value="Afterschool">Afterschool</option></select></td><td data-th="Amount"><input required class="datepicker selector" type="text" name="from[]" placeholder="From Date*"></td><td data-th="Amount"><input  type="text" class="datepicker selector" name="to[]" placeholder="To Date"></td><td><input required type="text" name="seat[]" placeholder="Seat*"></td><td><a href="javascript:void(0);" class="remCF"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></td></tr>');	
	  $( ".datepicker" ).datepicker({ dateFormat: 'mm-dd-yy' });
   <!-- $( ".datepicker" ).datepicker();-->
   $( ".selector" ).datepicker({ dateFormat: 'mm-dd-yy' });
		
		});
    $("#customFields").on('click','.remCF',function(){
        $(this).parent().parent().remove();
    });
});
function avail(param)
	{
	if(param=='Y')
	{
	$("#customFieldsdiv").css("display","none");	
	}
	else
	{
	$("#customFieldsdiv").css("display","block");
		
	}	
		
		
	}
</script>
