 <?php if (isset($showResetPassord)) { ?>
 <div class="page_title_bar">
<div class="wrapper">
<h1>Reset Password</h1>
</div>
</div>
<div class="message-upper">
<?php
echo $this->Session->flash();
?>
</div>
<div class="page_content">
<div class="wrapper afclr">
<div class="login_form">
<h2>Enter Registered Email id </h2>

<div class="login_form_inner">
 <?php echo $this->Form->create('User', ['url' => [ 'controller' => 'users', 'action' => 'forgot_password/'. $uuid]]); ?>
<p><?php echo $this->Form->password('new_password', ['required' => true, 'placeholder' => 'New Password*', 'label' => false]); ?></p>
<p><?php echo $this->Form->password('confirm_password', ['required' => true, 'placeholder' => 'Confirm Password*', 'label' => false]); ?></p>

<?php echo $this->Form->input('SUBMIT', ['type' => 'submit','label' => false]); ?>
<?php echo $this->Form->end(); ?>

</div> 


</div>

</div>
</div>

<?php }
	else{?>
<div class="page_title_bar">
<div class="wrapper">
<h1>Forgot Password</h1>
</div>
</div>
<div class="message-upper">
<?php
echo $this->Session->flash();
?>
</div>
<div class="page_content">
<div class="wrapper afclr">
<div class="login_form">
<h2>Enter Registered Email id </h2>

<div class="login_form_inner">
 <?php echo $this->Form->create('User', ['url' => [ 'controller' => 'users', 'action' => 'forgot_password']]); ?>
<p><?php echo $this->Form->input('email', ['required' => true, 'placeholder' => 'Email*', 'label' => false]); ?></p>

<?php echo $this->Form->input('SUBMIT', ['type' => 'submit','label' => false]); ?>
<?php echo $this->Form->end(); ?>

</div> 
<p>Don't have an account? <a href="<?php echo Configure::read('SITE_URL') ?>users/signup">Register here</a></p>


</div>

</div>
</div>

<?php }?>