<div class="page_title_bar">
<div class="wrapper">
<h1>Contact Us</h1>
</div>
</div>
<div class="page_content">
<div class="wrapper afclr">

<div class="message-upper">
<?php
echo $this->Session->flash();
?>
</div>
<div class="provider_left_contact">
<?php echo $this->Form->create('Pagecontact', array('url' => 'contact','class'=>'form_searcharea','name'=>'contactform','id'=>'contactform')); ?>
 
			<label class='label-class-search'>Name<spam class='spam-class'>*</spam></label>
			<?php echo $this->Form->input('username', ['required' => true,'value'=>@$user['User']['name'], 'label' => false ,'class'=>'input-class-search']); ?>

			<label class='label-class-search'>Email<spam class='spam-class'>*</spam></label>
			<?php echo $this->Form->input('useremail', ['required' => true,'value'=>@$user['User']['email'], 'label' => false,'class'=>'input-class-search']); ?>

			<label class='label-class-search'>Address<spam class='spam-class'>*</spam></label>
			<?php echo $this->Form->textarea('useraddress', ['required' => true,'value'=>@$user['User']['address'], 'label' => false,'class'=>'input-class-search']); ?>
			
			<label class='label-class-search'>Zip<spam class='spam-class'>*</spam></label>
			<?php echo $this->Form->input('userzip', ['required' => true, 'label' => false,'class'=>'input-class-search','onblur'=>'myFunction1()','maxlength'=>"5",'onkeypress'=>'return isNumberKey1(event)']); ?>

			
			<label class='label-class-search'>Phone<spam class='spam-class'>*</spam></label>
			<?php echo $this->Form->input('userphone', ['required' => true, 'label' => false,'class'=>'input-class-search','onblur'=>'myFunction1()','maxlength'=>"10",'onkeypress'=>'return isNumberKey1(event)']); ?>

			
			<label class='label-class-search'>Message<spam class='spam-class'>*</spam></label>
			<?php echo $this->Form->textarea('usermessage', ['required' => true,'value'=>@$user['User']['message'], 'label' => false,'class'=>'input-class-search']); ?>
			
			
			<div class="submit_feedback">
			<?php echo $this->Form->input('SUBMIT', ['type' => 'submit','label' => false]); ?>
			</div>
				<?php echo $this->Form->end(); ?>

</div>
</div>
</div>