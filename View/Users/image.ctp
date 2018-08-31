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
<h1>Gallery</h1>
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
<div class="uploads">
<form action="<?=Configure::read('SITE_URL')?>users/makefeature" id="ckb" name="form1">
<div class="u_images afclr">
<?php
//pr($data);
$j=0;
 foreach($data as $image){
?>
<div class="u_images_blk">
<div class="u_images_blk_img"><img src="<?php echo Configure::read('SITE_URL') ?>gallery/<?=$image['Image']['path']?>" alt="">

<div class="port_hover">
<div class="p_options">
<a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo Configure::read('SITE_URL') ?>gallery/<?=$image['Image']['path']?>"><img src="<?php echo Configure::read('SITE_URL') ?>images/search-icon.png" alt=""></a>
<span><img src="<?php echo Configure::read('SITE_URL') ?>images/icon-divider.png" alt=""></span>

<a href="<?=Configure::read('SITE_URL').'users/imageDelete/'.$image['Image']['id']?>"><img src="<?=Configure::read('SITE_URL').'images/delete-icon.png'?>"></a>

                                                

</div>
</div>
</div>
<div class="featured">
<label class="container">Make Featured
 <input type="checkbox" name="ckb" value="1" onclick='chkcontrol(<?=$j?>,<?=$image['Image']['id']?>)' <?php if($image['Image']['type']=='featured'){?> checked<?php }?>>
  <span class="checkmark"></span>
</label>
</div>
</div>
<?php $j++;}?>
</div>

</form>
</div>

<p>Upload More Photos</p>
 <?php echo $this->Form->create('Image',array('enctype'=>'multipart/form-data')); ?>

<div class="inputfile_outer">
    <label for="fileField11" class="inputfile_label"><!-- Choose File -->
    
    <?php echo  $this->Form->input('image.', array('type' => 'file', 'multiple')); ?>
	
	</label>
    <!-- <span id="filename1" class="s_filename">No file chosen</span> -->
    </div>
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
           $('#filename1').html('No file chosen');
        }
        });
        
    });

    </script>
<div class="create_invoice_btn"> <?php echo $this->Form->input('Upload', ['type' => 'submit','class'=>'saveprice','label' => false]); ?></div>
</div>
<?php echo $this->Form->end(); ?>

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