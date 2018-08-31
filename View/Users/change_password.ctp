<div class="page_title_bar">
<div class="wrapper">
<h1>Change Password</h1>


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

<div class="wrapper afclr">
<div class="register_form changepassword">
<div class="title_heading">
<h3>Change Password</h3>
</div>

<div class="register_form_inner">

                        <?php echo $this->Form->create('User'); ?>
 
<p><?php echo $this->Form->password('old_password', ['required' => true, 'placeholder' => 'Old Password*', 'label' => false]); ?></p>
<p><?php echo $this->Form->password('new_password', ['required' => true, 'placeholder' => 'New Password*', 'label' => false]); ?></p>
<p><?php echo $this->Form->password('confirm_password', ['required' => true, 'placeholder' => 'Confirm Password*', 'label' => false]); ?></p>
						 <?php echo $this->Form->input('SUBMIT', ['type' => 'submit','label' => false]); ?>
                           
<?php echo $this->Form->end(); ?>
</div>
</div>
</div>
                   
                   


</div>
</div>
</div>
</div>
<script>
$(document).ready(function(){
	$(".addCF").click(function(){
		$("#customFields").append('<tr><td data-th="Day"><select  name="agegroup[]"><option value="Toddler">Toddler</option><option value="Preschool">Preschool</option><option value="Pre-k">Pre-k</option></select></td><td data-th="Monthly/Weekly"><select name="timeslot[]"><option value="Monthly">Monthly</option><option value="Weekly">Weekly</option></select></td><td data-th="Amount"><input type="text" name="amount[]" placeholder=""></td><td><a href="javascript:void(0);" class="remCF"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></td></tr>');	});
    $("#customFields").on('click','.remCF',function(){
        $(this).parent().parent().remove();
    });
});</script>