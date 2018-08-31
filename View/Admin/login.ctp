<div class="page_content">
<div class="wrapper afclr">
<div class="admin_login_form">
<a href="#"><img src="<?php echo Configure::read('SITE_URL') ?>images/logo.png" alt=""></a>
<h2>Please Sign In</h2>

<div class="admin_login_inner">
 <?php echo $this->Form->create('User', ['url' => [ 'controller' => 'users', 'action' => 'login']]); ?>
 <p><?php echo $this->Form->input('username', ['class' => 'form-control','required'=>true, 'placeholder' => 'User Name', 'label' => false]); ?></p>
<p><?php echo $this->Form->input('password', ['class' => 'form-control', 'placeholder' => 'Password', 'label' => false]); ?></p>
<p> <?php echo $this->Form->button('Login', ['class' => 'submit-btns']); ?></p>
  <?php echo $this->Form->end(); ?></div> 
</div>

</div>
</div>