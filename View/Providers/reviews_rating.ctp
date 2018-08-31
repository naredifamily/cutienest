<div class="page_title_bar">
<div class="wrapper">
<h1>Reviews and Rating</h1>
</div>
</div>
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
<h3>Reviews</h3>
</div>

<div class="invoice_list">
<?php if(!sizeof($data)){?>
<div class="custom_pagination no-recod-found">
No Record Found
</div>
<?php }else{?>

<table style="width:100%;">
<tr>
<td>S.No.</td>
<td>Name</td>
<td>Rating</td>
<td>Review</td>
<td>Edit</td>
</tr>
<?php  $i=1; foreach($data as $users){?>
<tr>
<td data-th="S.No."><?=$i?></td>
<td data-th="Customer Name"><?=$this->Common->getUserName($users['reviews']['provider'])?></td>
<td data-th="Last Paid Date">

<?php 
$per=($users['reviews']['rating']*100)/5?>
<div class="ratings">
  <div class="empty-stars"></div>
  <div class="full-stars" style="width:<?=$per?>%"></div>
</div>
</td>
<td data-th="Last Paid Date"><?=substr($users['reviews']['review'],0,50)?></td>




<td data-th="Action">

<a class="fancybox" href="#pop<?=$i?>">
<i class="fa fa-pencil" aria-hidden="true"></i></a>

                   
  <div id="pop<?=$i?>" style="width:600px;display: none;">
<div class="add_review">
<div class="title_heading">
<h3>Edit Your Review</h3>
</div> 
 <?php echo $this->Form->create('Review', ['class'=>'care_search','type'=>'post','url' => [ 'controller' => 'reviews', 'action' => 'reviewedit']]); ?>
<input  type="hidden" name="data[Review][id]" value="<?=$users['reviews']['id']?>">

<input  type="hidden" name="data[Review][provider]" value="<?=$users['reviews']['provider']?>">

<div class="add_rev_entry afclr">

<div class="list_one list_one1">
<h3>Your Name</h3>
<input required="required" type="text" readonly="readonly" name="data[Review][name]" value="<?=$this->Common->username()?>">
</div>

<div class="list_two1 list_two">
<h3>Email</h3>
<input required="required" type="email" readonly="readonly" name="data[Review][email]" value="<?=$this->Common->useremail()?>">

</div>

</div>
<?php

$rating = number_format($users['reviews']['rating']);
?>
<div class="clr"></div>

<div class="r_ratings">
<h3>Select ratings</h3>
<div class="form-group">
<div class="rates afclr">
				   <div class="ratings listrating"><input <?php if($rating==1){?> checked="checked" <?php }?> value="1" type="radio" name="data[Review][rating]">
  <div class="em_f">
  <div class="empty-stars"></div>
  <div class="full-stars" style="width:20%"></div></div>
</div>
</div>
<div class="rates afclr">

<div class="ratings listrating"><input <?php if($rating==2){?> checked="checked" <?php }?> type="radio" value="2"  name="data[Review][rating]">
   <div class="em_f">
 <div class="empty-stars"></div>
  <div class="full-stars" style="width:40%"></div></div>
  </div>
</div>
<div class="rates afclr">

<div class="ratings listrating"><input <?php if($rating==3){?> checked="checked" <?php }?> type="radio" value="3"  name="data[Review][rating]">
   <div class="em_f">
 <div class="empty-stars"></div>
  <div class="full-stars" style="width:60%"></div></div>
</div>
</div>
<div class="rates afclr">
<div class="ratings listrating"><input <?php if($rating==4){?> checked="checked" <?php }?> type="radio" value="4"  name="data[Review][rating]">
   <div class="em_f">
 <div class="empty-stars"></div>
  <div class="full-stars" style="width:80%"></div></div>
</div>
</div>
<div class="rates afclr">

<div class="ratings listrating"><input <?php if($rating==5){?> checked="checked" <?php }?> type="radio" value="5"  name="data[Review][rating]">
  <div class="em_f"> <div class="empty-stars"></div>
  <div class="full-stars" style="width:100%"></div>
</div></div>
</div>
				  </div></div>

<div class="list_three">
<h3>Your Comment</h3>
<textarea required="required" name="data[Review][review]" rows="4" cols="50"  ><?=$users['reviews']['review']?></textarea>
</div>

<div class="create_invoice_btn"><?php echo $this->Form->input('SUBMIT', ['class' => 'submit-btns btns1','type' => 'submit','label' => false]); ?>
</div>
 </form> 
</div></div>                 
                   
                    
                   </td>
</tr>
<?php $i++; }?>
</table>
<?php }?>
</div>

<script>
$(document).ready(function () {
    
    // This will automatically grab the 'title' attribute and replace
    // the regular browser tooltips for all <a> elements with a title attribute!
    $('a[title]').qtip();
    
});
</script>
<script type="text/javascript">

$(document).ready(function(){  
	
    $("#rating").emojiRating({
				fontSize: 32,
				onUpdate: function(count) {
					$(".review-text").show();
					$("#starCount").html(count + " Star");
				}
			});
			$("#demo").submit( function(e) {
				e.preventDefault();

				var 
					name = $(this).find('#firstName').val() + ' ' + $(this).find('#lastName').val(),
					comments = $(this).find('#comments').val(),
					rating = $(this).find('.emoji-rating').val(),
					alert = 'Name: ' + name + '\nComments: ' + comments + '\nRating: ' + rating;

				window.alert(alert);
			});
});

</script>


</div>
</div>
</div>
</div>