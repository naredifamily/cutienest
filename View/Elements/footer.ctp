
<div class="wrapper">
<div class="footer afclr">
<div class="footer_outer afclr">

<div class="f_one">
 
<ul class="ul-class">
<li><a href="<?php echo Configure::read('SITE_URL') ?>">Home</a></li>
<li><a href="<?php echo Configure::read('SITE_URL') ?>pages/about-us">About Us</a></li>
<li><a href="<?php echo Configure::read('SITE_URL') ?>pages/terms-condition">Terms &amp; Conditions</a></li>
<li><a href="<?php echo Configure::read('SITE_URL') ?>pages/policy">Privacy Policy</a></li>
<li><a href="<?php echo Configure::read('SITE_URL') ?>pages/contact">Contact Us</a></li>
</ul>

<div class="feedback">

<a class="fancybox" href="#pop_feed">Give Feedback</a>

        
    </div>
</div>
 
 
 
</div>
</div>
</div>

<script>
jQuery(document).ready(function() {
	jQuery(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
</script>

<div id="pop_feed" style="width:600px;display: none;">
<div class="add_review">
<div class="title_heading">
<h3>Feedback</h3>
</div>
 <form name="feedbackform" id="feedbackform" action="/pages/feedback" method="post" class="form_feedback"> 
		
			<label class='label-class'>Name<spam class='spam-class'>*</spam></label>
			<?php echo $this->Form->input('username', ['required' => true,'value'=>@$user['User']['name'], 'label' => false ,'class'=>'input-class1']); ?>

			<label class='label-class'>Phone</label>
			<?php echo $this->Form->input('userphone', ['required' => true, 'value'=>@$user['User']['phone'], 'label' => false,'class'=>'input-class1','onblur'=>'myFunction1()','maxlength'=>"10",'onkeypress'=>'return isNumberKey1(event)']); ?>

			<label class='label-class'>Email<spam class='spam-class'>*</spam></label>
			<?php echo $this->Form->input('useremail', ['required' => true,'value'=>@$user['User']['email'], 'label' => false,'class'=>'input-class1']); ?>

			<label class='label-class'>Message<spam class='spam-class'>*</spam></label>
			<?php echo $this->Form->textarea('usermessage', ['required' => false ,'value'=>@$user['User']['message'], 'label' => false,'class'=>'input-class1']); ?>
			<div class="submit_feedback">
			<?php echo $this->Form->input('SUBMIT', ['type' => 'submit','label' => false]); ?>
			</div>
				</form>
</div>  
</div>
  
<div class="wrapper afclr">
	<div class="copy_right afclr">
	<div class="cp_left">
<h4>&copy; 2005-2018 Cutienest</h4>
</div>
	<div class="cp_right"> 

<h4>By logging into our website, you are agreeing to our <a href="<?php echo Configure::read('SITE_URL') ?>pages/terms-condition">T&amp;Cs</a> and <a href="<?php echo Configure::read('SITE_URL') ?>pages/policy">Privacy Policy.</a></h4>
	</div>
</div>
</div>
<?php
   echo $this->Html->script('site_functions.js');
?>

  <script>
 
  
   function isNumberKey1(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
	  
	  function myFunction1() {
    var phone_val = $("#userphone").val();

var new_phone = phone_val.replace(/[^\d]+/g, '')
     .replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
$("#userphone").val(new_phone);

}

	  
	  </script>
      
    