<div class="page_title_bar">
<div class="wrapper">
<h1>Register For Child Care Home </h1>
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
<h2>Create an Account</h2>
<p>Already have account? <a href="<?php echo Configure::read('SITE_URL') ?>/users/login">Sign in here</a></p>
<div class="register_form_inner">
<?php $states=$this->Common->getState();?>

 <?php echo $this->Form->create('User'); ?>
 <p><?php echo $this->Form->input('id', ['type' => 'hidden','value'=>$this->Common->login_userid(),'label' => false]); ?></p>

<p><?php echo $this->Form->input('name', ['required' => true,'placeholder' => 'Name', 'label' => false]); ?></p>
<p><?php echo $this->Form->input('phone', ['required' => true, 'placeholder' => 'Phone', 'label' => false]); ?></p>
<p><?php echo $this->Form->input('email', ['required' => true, 'placeholder' => 'Email', 'label' => false]); ?></p>
<p><?php echo $this->Form->input('password', ['required' => true, 'placeholder' => 'Password', 'label' => false]); ?></p>
<p><?php echo $this->Form->input('address', ['type'=>'text','required' => true,'placeholder' => 'Address', 'label' => false]); ?></p>
<p><?php echo $this->Form->select('state',$states, ['empty' => 'Select State', 'class' => '', 'required' => true]); ?></p>
<p><?php echo $this->Form->input('zip', ['required' => true, 'placeholder' => 'Zipcode', 'label' => false]); ?></p>
<p><?php echo $this->Form->input('yard', ['required' => true, 'placeholder' => 'Yard', 'label' => false]); ?></p>
<p><?php echo $this->Form->select('stage', array('First','Second','Thired'), ['empty' => 'Select State','required' => true, 'class' => '', 'required' => true]); ?></p>
						 <?php echo $this->Form->input('SUBMIT', ['type' => 'submit','label' => false]); ?>
                           
<?php echo $this->Form->end(); ?>
</div>
</div>
<div class="register_with_section">
<h3>or Sign with</h3>
<div class="rwith">
<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i><span>Continue with Facebook</span></a><br>
<a href="#"><i class="fa fa-envelope" aria-hidden="true"></i><span>Continue with Email</span></a>
</div>
</div>
</div>
</div>
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                          
                              
