<div class="page_title_bar">
<div class="wrapper">
<h1>Price List Management</h1>
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
<?php echo $this->element('usersection'); ?>
<div class="login_tab afclr">
<div class="tab_left">
<?php echo $this->element('menu'); ?>

</div>
<div class="tab_right">

<div class="title_heading">
<h3>Price Sheet</h3>
</div>
<div class="price_sheet">
 <?php echo $this->Form->create('Pricelist',array('enctype'=>'multipart/form-data')); ?>

<table id="customFields">
<tr>
<td>Age Group</td>
<td>Daily</td>
<td>Full Time/Part Time</td>
<td>Amount</td>
</tr>
<?php

 foreach($data as $pricelist){
?>



<tr>
<td data-th="Name"><select name="agegroup[]" required ><option <?php if($pricelist['Pricelist']['agegroup']=='0-2'){?> selected <?php }?> value="0-2">0-2</option><option <?php if($pricelist['Pricelist']['agegroup']=='2-4'){?> selected <?php }?> value="2-4">2-4</option><option <?php if($pricelist['Pricelist']['agegroup']=='4-5'){?> selected <?php }?> value="4-5">4-5</option><option <?php if($pricelist['Pricelist']['agegroup']=='Afterschool'){?> selected <?php }?> value="Afterschool">Afterschool</option></select>
</td>
<td data-th="Monthly/Weekly"><!--<select required name="timeslot[]"><option <?php if($pricelist['Pricelist']['timeslot']=='Monthly'){?> selected <?php }?> value="Monthly">Monthly</option><option <?php if($pricelist['Pricelist']['timeslot']=='Weekly'){?> selected <?php }?> value="Weekly">Weekly</option></select>-->
Daily<input type="hidden" name="timeslot[]" value="Daily">
</td>

<td data-th="Full Time/ Part Time"><select name="full_half[]" required ><option <?php if($pricelist['Pricelist']['full_half']=='Full Time'){?> selected <?php }?> value="Full Time">Full Time</option><option <?php if($pricelist['Pricelist']['full_half']=='Part Time'){?> selected <?php }?> value="Part Time">Part Time</option></select>
</td>

<td data-th="Amount"><input required type="text" name="amount[]" placeholder="" value="<?=$pricelist['Pricelist']['amount']?>"></td>
<!--<td data-th="Amount"><input required type="text" name="seat[]" placeholder="" value="<?=$pricelist['Pricelist']['seat']?>"></td>
-->
<td><a href="javascript:void(0);" class="remCF"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></td>
</tr>
<?php }?>
</table>

<div class="add_row_btn">
<a href="javascript:void(0);" class="addCF">Add Row</a>
</div>

<div class="clr"></div>



				<div class="inputfile_outer">
    <label for="fileField1" class="inputfile_label">Choose File
    <?php echo $this->Form->file('image', ['class'=>'inputfile','id'=>'fileField1', 'label' => false]); ?>
    </label>
    <span id="filename1" class="s_filename">Add your own price sheet</span>
    </div>
	
	<?php if(!empty($price_path[0]['Pricelist']['path']))
{?>

			<img src="<?php echo Configure::read('SITE_URL') ?>pricelist/<?=$price_path[0]['Pricelist']['path']?>" alt="" style="width: 25%; margin: 10px;">
		

<?php } ?>
	
	
	
	
<script>
      $(document).ready(function(){
        $('#fileField1').change(function(e){
          if(e.target.files.length != 0){
            var fileName = '';
            for(var span=0;span<e.target.files.length;span++){
              fileName = fileName  + e.target.files[span].name;
            }
            $('#filename1').html(fileName);
        }else{
           //$('#filename1').html('Add your own price sheet');
        }
        });
        
    });

    </script>


	
<div class="create_invoice_btn">
 <?php echo $this->Form->input('Save Pricing', ['type' => 'submit','class'=>'saveprice','label' => false]); ?></div>
<?php echo $this->Form->end(); ?>

	

</div>

 
</div>
</div>
</div>
</div>
<script>
$(document).ready(function(){
	$(".addCF").click(function(){
		$("#customFields").append('<tr><td data-th="Day"><select required  name="agegroup[]"><option value="0-2">0-2</option><option value="2-4">2-4</option><option value="4-5">4-5</option><option value="Afterschool">Afterschool</option></select></td><td data-th="Monthly/Weekly">Daily<input type="hidden" name="timeslot[]" value="Daily"></td><td data-th="Full Time/Part Time"><select required  name="full_half[]"><option value="Full Time">Full Time</option><option value="Part Time">Part Time</option></select></td><td data-th="Amount"><input required type="text" name="amount[]" placeholder=""></td><td><a href="javascript:void(0);" class="remCF"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></td></tr>');	});
    $("#customFields").on('click','.remCF',function(){
        $(this).parent().parent().remove();
    });
});</script>