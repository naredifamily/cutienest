<div class="page_title_bar">
<div class="wrapper">
<h1>Login </h1>
</div>
</div>
<div class="message-upper">
<?php
echo $this->Session->flash();
?>
</div>



<div class="page_content">
<div class="wrapper afclr">
<div class="register_form">
<h2>Login</h2>
<p>Don't have an account? <a href="<?php echo Configure::read('SITE_URL') ?>users/signup">Register here</a></p>
<div class="register_form_inner">
<?php $states=$this->Common->getState();?>

 <?php echo $this->Form->create('User', ['url' => [ 'controller' => 'users', 'action' => 'login']]); ?>
 
<label class='label-class'>Email</label>
<?php echo $this->Form->input('username', ['required' => true, 'label' => false,'class'=>'input-class']); ?>

<label class='label-class'>Password</label>
<div class="_icb">
<?php echo $this->Form->input('password', ['required' => true, 'label' => false,'class'=>'input-class pass_av']); ?>
<a href="javascript:void(0)" class="show_me_pass"><i class="la la-eye"></i></a>
</div>
<script>
	$('.show_me_pass').mousedown(function(){
		$('.pass_av').attr('type','text');
	})
	$('.show_me_pass').mouseup(function(){
		$('.pass_av').attr('type','password');
	})
</script>

<p class="forgotpassword_link"><a href="<?php echo Configure::read('SITE_URL') ?>users/forgot_password">Forgot password ?</a></p>
<p><?php echo $this->Form->input('redirect', ['type' => 'hidden','value'=>@$this->request->query['redirect'] ,'label' => false]); ?></p>
<?php echo $this->Form->input('LOGIN', ['type' => 'submit','label' => false]); ?>
<?php echo $this->Form->end(); ?>
</div>
</div>
<div class="register_with_section">
<h3>or Login with</h3>
<div class="rwith">
	<?php /*
<a href="<?php echo Configure::read('SITE_URL') ?>social_login/Facebook">Login With Facebook</a>
*/ ?>
<a href="<?php echo Configure::read('SITE_URL') ?>social_login/Google">Login With Gmail</a>

	<!--<a class="btn btn-default facebook" href="<?php echo BASE_PATH.'fblogin'; ?>">  Signin with Facebook </a>
	<a class="btn btn-default google" href="<?php echo BASE_PATH.'googlelogin'; ?>">  Signin with Google </a> -->
</div>
</div>
</div>
</div>
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                          
                              
