<?php
/**

*Details page
**/

?>  <script>
    $(document).ready(function(){
    $('.slider').bxSlider({
  auto: true,
 
  pager: false,
  slideWidth: 881
});
    });
  </script>
  
<div class="page_title_bar">
<div class="wrapper">
  <div class="user_profile_img_detail user_in_img_profile">
<?php 

//$img=$this->Common->featuredImages($data['User']['id']);
?>
<span>
<?php if(!isset($Profileimage['Profileimage']['path'])){?>
<img src="<?php echo Configure::read('SITE_URL') ?>images/no-img.jpg" height="100" width="100" alt="">
<?php }else{
  ?>
  <img src="<?=Configure::read('SITE_URL').'gallery/'.@$Profileimage['Profileimage']['path']?>" class="logoimg" height="100" width="100" alt="">
 

<?php }?>

</span>
</div>
<h1 class="user_in_img_profile_title"><?=$data['User']['name']?></h1>

</div>
</div>
<div class="message-upper">
<?php
echo $this->Session->flash();
?>
</div>
<div class="page_content">
<div class="wrapper afclr">

<div class="provider_left">

<div class="title_heading users_details">
<h3> Name : <?=$data['User']['name']?></h3>
<h3> Email : <?=$data['User']['email']?></h3>
<h3> DL/State-Issued ID :  <a href="<?php echo Configure::read('SITE_URL').'dl_state_id/'.$data['User']['state_id']; ?>" style="color:blue; font-style: italic;text-decoration: underline;" target="_blank">Click Here </a> </h3>
</div>
<?php if(!empty($data['User']['address'])){?>
<div class="title_heading">
<h3>Address</h3>
</div>
<div class="address_text">
<?=$data['User']['address']?>,<br>
<?=$data['User']['state']?>,USA - <?=$data['User']['zip']?></div>
<?php }?>
<script>
      function initMap() {
        var uluru = {lat:<?=$data['User']['lat']?>, lng: <?=$data['User']['long']?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom:14,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map,
		  icon:'<?php echo Configure::read('SITE_URL') ?>images/map_icon.png'
        });
      }
    </script>
<script src="https://maps.googleapis.com/maps/api/js?&callback=initMap"></script>

<?php
if($this->Common->isReservedByProvider($data['User']['id'])){
if($this->Common->isLoggedIn()&&(!$this->Common->isReviews($data['User']['id']))){
?>
<div class="add_review">
<div class="title_heading">
<h3>Add Your Review</h3>
</div> 
 <?php echo $this->Form->create('Review', ['class'=>'care_search','type'=>'post','url' => [ 'controller' => 'providers', 'action' => 'addReview']]); ?>

<input  type="hidden" name="data[Review][user_id]" value="<?=$data['User']['id']?>">

<div class="add_rev_entry afclr">

<div class="list_one">
<h3>Your Name</h3>
<input required="required" type="text" name="data[Review][name]" readonly="readonly" value="<?=$this->Common->username()?>">
</div>

<div class="list_two">
<h3>Email</h3>
<input required="required" type="email" name="data[Review][email]" readonly="readonly" value="<?=$this->Common->useremail()?>">

</div>
</div>
<div class="clr"></div>

<div class="r_ratings">
<h3>Select ratings</h3>
<div class="form-group" id="rating">
				   
				  </div></div>

<div class="list_three">
<h3>Your Comment</h3>
<textarea required="required" name="data[Review][review]" rows="4" cols="50"></textarea>
</div>

<div class="create_invoice_btn"><?php echo $this->Form->input('SUBMIT', ['class' => 'submit-btns','type' => 'submit','label' => false]); ?>
</div>
 </form> 
</div>
<?php }}?>

<div class="title_heading">
<h3>Reviews</h3>
</div>
<div class="star_rating reviews_all_rating" style="display:none">
<?php 
$total_review=sizeof($reviews);
$per=($data['User']['rating']*100)/5?>
<div class="ratings">
  <div class="empty-stars"></div>
  <div class="full-stars" style="width:<?=$per?>%"></div>
</div>
<?php if($data['User']['rating'] != 0){ ?>
<span><?=number_format($data['User']['rating'],1)?> out of 5.0 ,  <?=$total_review?> Customer Reviews</span>
<?php } else{ ?>
<span> No reviews Yet</span>
<?php } ?>
</div>
<div class="review_block">
<?php

 foreach($reviews as $review){ ?>

<div class="review_one">
<h4><i class="fa fa-user"></i> <?=$this->Common->getUserName($review['Review']['user_id'])?></h4>
<div class="star_rating">
<div class="ratings">
  <div class="empty-stars"></div>
  <?php $per=($review['Review']['rating']*100)/5?>
  <div class="full-stars" style="width:<?=$per?>%"></div>
</div>
<span><?=$review['Review']['rating']?> out of 5, reviewed on <?php echo date('j F Y', strtotime($review['Review']['created']));?></span>
</div>
<p><?=$review['Review']['review']?></p>

</div>
<?php }?>
</div>
</div>
</div>
</div>
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
