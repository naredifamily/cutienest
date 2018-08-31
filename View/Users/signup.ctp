<div class="page_title_bar">
<div class="wrapper">
<h1>Create an Account </h1>
</div>
</div>
<div class="page_content">
<div class="wrapper afclr">
<div class="register_form">
<p>Already have account? <a href="<?php echo Configure::read('SITE_URL') ?>users/login">Sign in here</a></p>
<div class="register_form_inner">
<?php $states=$this->Common->getState();?>

 <?php echo $this->Form->create('User'); ?>
 
 <label class='label-class'>Name<spam class='spam-class'>*</spam></label>
 <?php echo $this->Form->input('name', ['required' => true, 'label' => false,'class'=>'input-class']); ?>

<label class='label-class'>Email<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('email', ['required' => true, 'label' => false,'class'=>'input-class']); ?>

<label class='label-class'>Password<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('password', ['required' => true, 'label' => false,'class'=>'input-class']); ?>

<label class='label-class'>Confirm Password<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('password_confirm', ['required' => true,'type'=>'password','label' => false,'class'=>'input-class']); ?>

						 <?php echo $this->Form->input('SUBMIT', ['type' => 'submit','label' => false]); ?>
                           
<?php echo $this->Form->end(); ?>
</div>
</div>
<div class="register_with_section">
<h3>or Sign Up with</h3>
<div class="rwith">
	<?php /*
<a href="<?php echo Configure::read('SITE_URL') ?>social_login/Facebook">Continue With Facebook</a>
*/?>
<br>
<a href="<?php echo Configure::read('SITE_URL') ?>social_login/Google">Continue With Gmail</a>
</div>
</div>
</div>
</div>
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                          
                              
