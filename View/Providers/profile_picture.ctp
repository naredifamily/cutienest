<div class="page_title_bar">
<div class="wrapper">
<h1>Profile Picture</h1>
</div>
</div>
<style type="text/css">
			#result{
				display: block;
				position: relative;
				width: 30%;
				margin: auto;
				margin-top: 100px;
			}
		</style>
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
<h3>Change Profile Picture</h3>
</div>
<?php if(isset($data['Profileimage']['path']))
{?>
<div class="u_images afclr">
	<div class="u_images_blk">
		<div class="u_images_blk_img">
		<div class="pimg_image">
			<img src="<?php echo Configure::read('SITE_URL') ?>uploads/gallery/<?=$data['Profileimage']['path']?>" alt="">
			</div>
			<?php echo $this->Form->create('Profileimage',array('enctype'=>'multipart/form-data')); ?>
			<i class="fa fa-camera"></i>
				<?php echo $this->Form->file('image', ['required' => true,'class'=>'cameraupload','id'=>'file','placeholder' => 'upload', 'label' => false,'title'=>'Please Select a Image']); ?>
				<?php echo $this->Form->input('image_encode', ['type' => 'hidden','id'=>'image_encode']); ?>
				<?php echo $this->Form->end(); ?>
		</div>
		<img id="result">
        <?php if($data['Profileimage']['rotate']==0)
		{?>
        <img id="rotateImage" src="<?php echo Configure::read('SITE_URL') ?>uploads/gallery/<?=$data['Profileimage']['path']?>" alt=""> 
		<a href="#" id="btn_rotate"><i class="fa fa-2x fa-undo" aria-hidden="true"></i></a>
        <a href="#" id="saveImage" rotate="<?php echo $data['Profileimage']['rotate'] ?>" profileId="<?php echo $data['Profileimage']['id'] ?>" filename="<?=$data['Profileimage']['path']?>" action="<?php echo Router::url('/providers/rotateimage', true); ?>" style="float:right"><i class="fa fa-2x fa-floppy-o" aria-hidden="true"></i></a>
    	<?php } ?>
    </div>
</div>
<?php } else{ ?>
<div class="u_images afclr">
	<div class="u_images_blk">
		<div class="u_images_blk_img">
		<div class="pimg_image">
			<img src="<?php echo Configure::read('SITE_URL') ?>uploads/gallery/default_image.jpg" alt="">
			</div>
			<?php echo $this->Form->create('Profileimage',array('enctype'=>'multipart/form-data')); ?>
			<i class="fa fa-camera"></i>
				<?php echo $this->Form->file('image', ['required' => true,'class'=>'cameraupload','id'=>'file','placeholder' => 'upload', 'label' => false,'title'=>'Please Select a Image']); ?>
				<?php echo $this->Form->input('image_encode', ['type' => 'hidden','id'=>'image_encode']); ?>
				
			<?php echo $this->Form->end(); ?>
			
		</div>
		<img id="result">
        
        
    </div>
</div>


<?php } ?>
<script>
      $(document).ready(function(){
        $('#fileField1').change(function(e){
			if(e.target.files.length != 0)
			{
				$('#ProfileimageProfilePictureForm').submit();
			}
        });
        
    });

    </script>


</div>
</div>
</div>
</div>
</div>
