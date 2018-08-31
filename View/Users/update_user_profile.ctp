<div class="page_title_bar">
<div class="wrapper">
<h1>Update Profile</h1>
</div>
</div>
<div class="message-upper">
<?php
echo $this->Session->flash();
if($user['User']['state_id']=='' && $user['User']['role']==2){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Please provide your DL/ State-issued ID.Click <a href="<?php echo Configure::read('SITE_URL').'users/updateUserProfile'; ?>" style="color:blue; font-style: italic;text-decoration: underline;">here </a> </p>
<?php } ?>

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
<h3>Update Profile</h3>
</div>
<div class="invoice_list">
<div class=" afclr">
<div class="register_form_inner updateprofile">
<?php $states=$this->Common->getState();?>
 <?php echo $this->Form->create('User',array('enctype'=>'multipart/form-data')); ?>
 <p><?php echo $this->Form->input('id', ['type' => 'hidden','value'=>$this->Common->loginUserId(),'label' => false]); ?></p>

 <label class='label-class'>Full Name<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('name', ['required' => true,'placeholder' => 'Name','value'=>@$user['User']['name'], 'label' => false,'class'=>'input-class']); ?>

 <label class='label-class'>Phone<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('phone', ['required' => true, 'placeholder' => 'Phone','value'=>@$user['User']['phone'], 'label' => false, 'class'=>'input-class']); ?>

<label class='label-class'>Email<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('email', ['readonly'=>true,'required' => true,'value'=>@$user['User']['email'], 'placeholder' => 'Email', 'label' => false, 'class'=>'input-class']); ?>

<label class='label-class'>Address<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('address', ['type'=>'text','required' => true,'placeholder' => 'Address*','value'=>@$user['User']['address'],'id'=>'searchTextField' ,'label' => false,'class'=>'input-class']); ?>

<label class='label-class'>State<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->select('state',$states, ['empty' => 'Select State', 'class' => '','default'=>@$user['User']['state'], 'required' => true,'class'=>'select-class']); ?>


<label class='label-class'>Zipcode<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('zip', ['required' => true, 'placeholder' => 'Zipcode','value'=>@$user['User']['zip'], 'label' => false, 'class'=>'input-class']); ?>

<label class='label-class'>DL/State-issued ID<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->file('state_id', ['class'=>'input-class']); ?>

<?php if(!empty($user['User']['state_id'])){ ?>
<p>Check DL/State-issued ID</p><label><a href="<?php echo Configure::read('SITE_URL').'uploads/dl_state_id/'.$user['User']['state_id']; ?>" style="color:blue; font-style: italic;text-decoration: underline;" target="_blank">Click Here </a></label>

<?php }
?>
 <p><?php echo $this->Form->input('dl_id', ['type' => 'hidden','value'=>@$user['User']['state_id'],'label' => false]); ?></p>



<?php echo $this->Form->input('SUBMIT', ['type' => 'submit','label' => false]); ?>
                           
<?php echo $this->Form->end(); ?>
</div>

</div>


</div>

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