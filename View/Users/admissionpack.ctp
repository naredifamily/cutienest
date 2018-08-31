<script type="text/javascript">
$(document).ready(function() {

			$('.fancybox').fancybox();

$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});
	});
</script>
<div class="page_title_bar">
<div class="wrapper">
<h1>Upload Admission Pack</h1>
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
<h3>Uploads</h3>
</div>
<div class="uploads price_sheet">
<table id="customFields">
<tbody><tr>
<td>Name</td>
<td>File</td>
<td>Action</td>
</tr>
<?php

foreach($data as $result){
?>
<tr>
<td data-th="Day"><?=$result['Admissionpack']['name']?></td>
<td data-th="Day"><a href="<?=Configure::read('SITE_URL')?>/admissionpack/<?=$result['Admissionpack']['path']?>"><?=$result['Admissionpack']['path']?></a></td>
<td data-th="Day"><a href="<?=Configure::read('SITE_URL')?>/users/deletepack/<?=$result['Admissionpack']['id']?>" title="Delete" ><i style="color:red" class="fa fa-times-circle"></i></a></td>
</tr>
<?php }?>
</tbody></table>
</div>

<p class="inputfile_outer_adm_p">Upload Docs (Allowed Format : pdf,doc,ppt,rtf,docx)</p>
 <?php echo $this->Form->create('Admissionpack', ['class'=>'booking_form','enctype'=>'multipart/form-data','type'=>'post','url' => [ 'controller' => 'users', 'action' => 'admissionpack']]); ?>

	<div class="inputfile_outer_adm">
<div class="adm_file">
<?php echo $this->Form->input('name', ['required' => true,'placeholder' => 'File Title','value'=>'', 'label' => false,'class' => 'input_adm']); ?>
</div>
<div class="adm_file">
    <label for="fileField1" class="inputfile_label">Choose File
    <?php echo $this->Form->file('file', ['required' => true,'class'=>'inputfile','id'=>'fileField1','placeholder' => 'No file chosen', 'label' => false]); ?>
    </label>
    </div>
    </div>
    
  

<div class="create_invoice_btn"> <?php echo $this->Form->input('Upload', ['type' => 'submit','class'=>'saveprice','label' => false]); ?></div><?php echo $this->Form->end(); ?>


</div>


</div>




</div>
</div>
</div>
</div>
<script type="text/javascript">
function chkcontrol(j,id) {
var total=0;
var totalCheckboxes = $('input:checkbox').length;
	if(totalCheckboxes==1)
	{
		var numberOfChecked = $('input:checkbox:checked').length;
	if(numberOfChecked==1)
	{
		var isChecked='Y';
		
	}
	else
	{
		var isChecked='N';
		
	}	
		
	}
	for(var i=0; i < document.form1.ckb.length; i++){
		if(document.form1.ckb[i].checked){
		total =total +1;
		var isChecked='Y';
		}
		else{
		var isChecked='N';
			
			}
			
			
			
					if(document.form1.ckb[j].checked){
		
		var isChecked='Y';
		}
		else{
		var isChecked='N';	
			}
		if(total > 3){
		alert("Please Select only three") 
		document.form1.ckb[j].checked = false ;
		return false;
		}
		else{
	
		}
	} 
			if(total <= 3){
			 jQuery("#loading").show();

		jQuery.ajax({
			url: "<?php echo Configure::read('SITE_URL') ?>/users/makeFeatureImg/",
			data:{id:id,isChecked:isChecked},
			type: 'POST',
			success: function(result){
			jQuery("#loading").hide();  
		 }});
		 }
}

</script>