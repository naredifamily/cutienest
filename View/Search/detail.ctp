<?php
/**

*Details page
**/

?> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>

 <script>
    $(document).ready(function(){
    $('.slider').bxSlider({
  auto: true,
 
  pager: false,
  slideWidth: 881
});
    });
  </script>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
 
<div class="message-upper">
<?php
echo $this->Session->flash();
?>
</div>
<div class="page_content">
<div class="wrapper afclr">
<div class="side_bar">
<?php
//if(!$this->Common->isReserved($data['User']['id'])){
?>
<?php if($this->Common->isLoggedIn()){
	
	if($this->Common->role()=='2' && $this->Common->state_id() !=''){ ?>
<a class="fancybox" href="#reservespot">Enroll a child</a>
<?php }
else{
	?>
	<a href="<?php echo Configure::read('SITE_URL')?>users/updateUserProfile">Enroll a child</a>
<?php
}
 }else{ ?>
	<a href="<?php echo Configure::read('SITE_URL')?>users/login?redirect=<?php echo Configure::read('SITE_URL')?>users/reserve/<?=$data['User']['id']?>">Enroll a child</a>
<?php }
/*}
else
{?>
	<a href="#" style="background:#e68cba;color:#fff;">Reserved</a>

	<?php
}*/
?>
<a class="fancybox" href="#pop1">Book A Tour</a>
<?php /*
<a href="tel:<?=$data['User']['phone']?>">Call This Provider</a>
*/ ?>
<a class="fancybox" href="#pop2">Send Message</a>
<?php /*
<a class="fancybox" href="#pack" class="downlaod_pack"><i class="fa fa-download"></i> Admission Pack</a>
*/ ?>
<div id="pack" style="width:600px;display: none;">
<div class="add_review">
<div class="title_heading">
<h3>Download Admission Pack</h3>
</div>

<div class="add_rev_entry afclr">

<div class="price_sheet">
<table id="customFields" class="admpacks">
<tbody><tr>
<th>Name</th>
<th>File</th>
<th>Download</th>
</tr>
<?php

foreach($download as $result){
?>
<tr>
<td data-th="Day"><?=$result['Admissionpack']['name']?></td>
<td data-th="Day"><a target="_blank" href="<?=Configure::read('SITE_URL')?>/admissionpack/<?=$result['Admissionpack']['path']?>"><?=$result['Admissionpack']['path']?></a></td>
<td data-th="Day"><a target="_blank" href="<?=Configure::read('SITE_URL')?>/admissionpack/<?=$result['Admissionpack']['path']?>"><i class="fa fa-download"></i></a></td>
</tr>
<?php }?>
</tbody></table>
</div>


</div>
<div class="clr"></div>
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
<div id="pop1" style="width:600px;display: none;">
<div class="add_review">
<div class="title_heading">
<h3>Book a Tour</h3>
</div>
 <?php echo $this->Form->create('User', ['class'=>'care_search','type'=>'post','url' => [ 'controller' => 'users', 'action' => 'bookTour']]); ?>

<div class="add_rev_entry afclr">

<div class="list_one">
<h3>Your Name</h3>
<input type="text" name="name" readonly value="<?=$this->Common->username()?>">
</div>

<div class="list_two">
<h3>Email</h3>
<input type="text" name="email" readonly value="<?=$this->Common->useremail()?>">
</div>
<div class="list_one">
<h3>Date</h3>
<input type="text" name="book_date" autocomplete="off" id="book_date" value="">
</div>
<div class="list_two">
<h3>Time</h3>
<input type="text" name="book_time" autocomplete="off" placeholder="e.g. - 10:30am" id="book_time" value="">
</div>
<style type="text/css">
  .list_one, .list_two{padding-bottom: 30px}
  ::-webkit-input-placeholder {color:    #ccc;}
</style>
<script>
  $( function() {
    $( "#book_date" ).datepicker({ dateFormat: 'mm-dd-yy' }).val();
    $( "#UserStartdate" ).datepicker({ dateFormat: 'mm-dd-yy' }).val();
	$( "#UserEnddate" ).datepicker({ dateFormat: 'mm-dd-yy' }).val();
  } );
  </script>
</div>
<div class="clr"></div>
<input type="hidden" name="provider" value="<?=$data['User']['id']?>">



<div class="list_three">
<h3>Your Comment</h3>
<textarea rows="4" name="comment" cols="50" required="required"></textarea>
</div>

<div class="create_invoice_btn">
 <?php echo $this->Form->input('Submit', ['type' => 'submit','class'=>'saveprice','label' => false]); ?></div>
 </form>
</div>  
  
  </div>
 
<div id="pop2" style="width:600px;display: none;">
<div class="add_review">
<div class="title_heading">
<h3>Send Message</h3>
</div>
 <?php echo $this->Form->create('User', ['class'=>'care_search','type'=>'post','url' => [ 'controller' => 'users', 'action' => 'sendMessage']]); ?>

<div class="add_rev_entry afclr">

<div class="list_one">
<h3>Your Name</h3>
<input type="text" name="name"  value="<?=$this->Common->username()?>">
</div>

<div class="list_two">
<h3>Email</h3>
<input type="text" name="email" value="<?=$this->Common->useremail()?>">
</div>
</div>
<div class="clr"></div>
<input type="hidden" name="provider" value="<?=$data['User']['id']?>">
<div class="list_three">
<h3>Your Comment</h3>
<textarea rows="4" name="comment" cols="50"></textarea>
</div>

<div class="create_invoice_btn">
 <?php echo $this->Form->input('Submit', ['type' => 'submit','class'=>'saveprice','label' => false]); ?></div>
 </form>
</div></div>

<div id="reservespot" style="display: none;">
<div class="add_review price_sheet enrollChild">
<div class="title_heading resspot_head">
<h3>Enroll a child</h3>
</div> 
 <?php echo $this->Form->create('User', ['class'=>'care_search','type'=>'post','url' => [ 'controller' => 'users', 'action' => 'reserve']]); ?>
<input type="hidden" name="provider" value="<?=$data['User']['id']?>">
<input type="hidden" name="user_id" value="<?=$this->Common->loginUserId()?>">
<table id="customFields" class="reserve_table">
<tbody id="customField">
</tbody>
<tbody>
  <tr>
    <th>Kid's First Name</th>
    <th>Kid's Last Name</th>
    <th>Kid's Age</th>
    <th>Gender</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Payment</th>
    <th>&nbsp;</th>
  </tr>
  <tr>
<td><?php echo $this->Form->input('childname',['type'=>'text','class'=>'txt_input_text','label'=>false,'placeholder'=>'Child First name','name'=>'data[User][childname][]','required'=>'required']); ?></td> 
<td><?php echo $this->Form->input('lastname',['type'=>'text','class'=>'txt_input_text','label'=>false,'placeholder'=>'Child Last name','name'=>'data[User][lastname][]','required'=>'required']); ?></td> 
<?php $ageOptions=array('s'=>'Age','0-2'=>'0-2','2-4'=>'2-4','4-5'=>'4-5','afterschool'=>'Afterschool'); ?>
<td><?php echo $this->Form->input('age',array('options'=>$ageOptions,'default'=>'s','label'=>false,'class'=>'genderClass','name'=>'data[User][age][]')); ?></td>
<?php $genderOptions=array('M'=>'Male','F'=>'Female'); ?>
<td><?php echo $this->Form->input('gender',array('options'=>$genderOptions,'default'=>'M','label'=>false,'name'=>'data[User][gender][]','class'=>'genderClass')); ?></td>
<td><?php echo $this->Form->input('startdate',['type'=>'text','class'=>'txt_input_text date','label'=>false,'placeholder'=>'Start Date','name'=>'data[User][startdate][]','autocomplete'=>'OFF']); ?></td>
<td><?php echo $this->Form->input('enddate',['type'=>'text','class'=>'txt_input_text date','label'=>false,'placeholder'=>'End Date','name'=>'data[User][enddate][]','autocomplete'=>'OFF']); ?></td>
<?php $paymentFrequency =array('M'=>'Monthly','W'=>'Weekly','D'=>'Daily'); ?>
<td><?php echo $this->Form->input('paymentfrequency',array('options'=>$paymentFrequency,'default'=>'M','label'=>false,'class'=>'genderClass','name'=>'data[User][paymentfrequency][]')); ?></td>
<td class="create_invoice_btn"><?php echo $this->Form->input('+ Child',['type'=>'button','value'=>'+ Add Child','label'=>false,'class'=>'saveprice addchildbtn']); ?></td>
</tr>
</tbody></table>
<div class="create_invoice_btn">
 <?php echo $this->Form->input('Submit', ['type' => 'submit','class'=>'saveprice','label' => false]); ?></div>
 </form>
</div>  
  </div>
</div>
<div class="provider_left">
<?php if(sizeof($gallery)>0){?>

<?php /*?><div class="pimg slider">
<?php 
foreach($gallery as $images){?>
 <a class="fancybox" rel="gallery1" href="<?php echo Configure::read('SITE_URL')?>uploads/gallery/thumb/<?=$images['Image']['path']?>" > <img src="<?php echo Configure::read('SITE_URL')?>uploads/gallery/thumb/<?=$images['Image']['path']?>" alt=""></a>
<?php }?>

</div><?php */?>

<div class="detail_profile_slider afclr">

  <div class="swiper-container slider1">
    <div class="swiper-wrapper">
      <?php 
foreach($gallery as $images){?>
      <div class="swiper-slide">
        <div class="profile_banner">
       
       <a href="<?php echo Configure::read('SITE_URL')?>uploads/gallery/thumb/<?=$images['Image']['path']?>" data-fancybox="images"> <img src="<?php echo Configure::read('SITE_URL')?>uploads/gallery/thumb/<?=$images['Image']['path']?>" /> </a>
       
     
           
        </div>
      </div>
      
       <?php }?>   
       
     

 
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
     
  </div>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper('.slider1', {
      slidesPerView: 1,
      slidesPerColumn: 1,
      spaceBetween: 0,
      slidesPerColumnFill: 'column',
      paginationClickable: true,
      loop: true,
	  autoHeight: true,
      pagination: {
        el: '.swiper-pagination1',
        clickable: true,
      },

      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      
    });
  </script>

</div>

<div class="share_with">Share With : <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo Configure::read('SITE_URL')?>search/detail/<?=$data['User']['id']?>"><i class="fa fa-facebook-square"></i></a> <a target="_blank" href="https://twitter.com/home?status=<?php echo Configure::read('SITE_URL')?>search/detail/<?=$data['User']['id']?>"><i class="fa fa-twitter-square"></i> </a>  <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo Configure::read('SITE_URL')?>search/detail/<?=$data['User']['id']?>&title=Cutienest&summary=Cutienest%20Home%20Child%20Care&source="><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></div>
<div class="page_title_bar page_title_inner_search">
 
<div class="ud_outer afclr">
<div class="user_profile_img_detail">
<?php 

//$img=$this->Common->featuredImages($data['User']['id']);
?>
<span>
<?php if(!isset($Profileimage['Profileimage']['path'])){?>
<img src="<?php echo Configure::read('SITE_URL') ?>images/no-img.jpg" height="100" width="100" alt="">
<?php }else{
	?>
  <img src="<?=Configure::read('SITE_URL').'uploads/gallery/'.@$Profileimage['Profileimage']['path']?>" class="logoimg" height="100" width="100" alt="">
 

<?php }?>

</span>
</div>
<div class="user_detail_item">
<h1><?=$data['User']['name']?></h1>
<div class="star_rating reviews_all_rating">
<?php 
$total_review=sizeof($reviews);
$per=($data['User']['rating']*100)/5?>
<div class="ratings ">
  <div class="empty-stars"></div>
  <div class="full-stars" style="width:<?=$per?>%"></div>
</div>
<?php if($data['User']['rating'] != 0){ ?>
<span><?=number_format($data['User']['rating'],1)?> out of 5.0 ,  <?=$total_review?> Customer Reviews</span>
<?php } else{ ?>
<span> No reviews yet</span>
<?php } ?>
</div>
</div>
</div>
 
</div>


<?php }?>
<div class="title_heading title_heading_inner">

<div class="detail_search_icon"><i class="la la-user"></i> <h3><b>About <?=$data['User']['name']?> </b></h3></div>
</div>
<?=$data['User']['about']?>

<div class="title_heading title_heading_inner">
<div class="detail_search_icon"><i class="la la-keyboard-o"></i><h3><b>Licence No </b> <?=$data['User']['licenceno']?></h3></div>
</div>


<div class="title_heading title_heading_inner">
<div class="detail_search_icon"><i class="la la-map-o"></i><h3><b>Address</b></h3></div>
</div>
<div class="address_text">
<?=$data['User']['address']?>,<br>
<?php //$data['User']['state'],USA - <?=$data['User']['zip']; ?></div>
<div class="title_heading title_heading_inner">
<div class="detail_search_icon"><i class="la la-map-marker"></i><h3><b>Location</b></h3></div>
</div>
<div id="map"></div>
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
<script src="https://maps.googleapis.com/maps/api/js?&callback=initMap&key=AIzaSyAIO1XW64S8s6KwynRkZYdgNZeVYIwdqgA"></script>



<div class="title_heading title_heading_inner">
<div class="detail_search_icon"><i class="la la-calendar-check-o"></i><h3><b>Schedule</b></h3></div>
</div>
<div class="availability_table">
<table>
<?php if($data['User']['fullday']){?>
<tr>
<td>Full Day</td>
<td><?=$data['User']['fulldaytime_from']?></td>
<td>To</td>
<td><?=$data['User']['fulldaytime_to']?></td>
</tr>
<?php /*<tr><td colspan="4"><?=//$data['User']['fullday_text']?></td></tr>*/?>
<?php }?>

<?php if($data['User']['halfday']){?>

<tr>
<td>Half Day</td>
<td><?=$data['User']['halfdaytime_from']?></td>
<td>To</td>
<td><?=$data['User']['halfdaytime_to']?></td>

</tr><?php }?>
<tr><td colspan="4"><?=$data['User']['halfday_text']?></td></tr>


</table>
</div>
<?php if($data['User']['halfday']==0&&$data['User']['fullday']==0){?>
<p>Not Available</p>
<?php }?>

<div class="title_heading title_heading_inner">
<div class="detail_search_icon"><i class="la la-calendar-o"></i><h3><b>Availability </b></h3></div>
</div>
<div class="availability_table">
<table class="availability_table_inner">
<tr>
<td>Age Group</td>
<td>Seats</td>
</tr>
<?php 
$availibilities=array();
if(strcmp($data['User']['availability'],'available')!=0)
{
$availibilities=unserialize($data['User']['availability']);
}
if(is_array($availibilities))
{
foreach($availibilities as $pricelist){
	?>
<tr>
<td data-th="Age Group"><?=$pricelist['agegroup']?></td>
<td data-th="Seats"><?=$pricelist['seat']?></td>

</tr>
<?php } }?>
</table> 
<table style="width: auto;">
<tr>
<?php if($data['User']['careof_weekend']){?>
<td style="padding-right:40px;"><i class="fa fa-check-square"></i> Provides care on Weekends</td><?php }?>
<?php if($data['User']['careof_holiday']){?>
<td><i class="fa fa-check-square"></i> Provides care on Holidays</td>
<?php }?>
</tr>
</table>
<p>*availability last updated on  <?php echo date('j F Y', strtotime($data['User']['updated']));?></p>
</div>

<div class="title_heading title_heading_inner">
<div class="detail_search_icon"><i class="la la-money"></i><h3><b>Price Sheet</b></h3></div>
</div>
<div class="availability_table">
<table>
<tr>
<td>Age Group</td>
<td></td>
<td></td>
<td>Amount</td>

</tr>
<?php 
foreach($data['Pricelist'] as $pricelist){?>
<tr>
<td data-th="Age Group"><?=$pricelist['agegroup']?></td>
<td data-th="Time"><?=$pricelist['timeslot']?></td>
<td data-th="Full/Half Time"><?=$pricelist['full_half']?></td>
<td data-th="Amount">$<?=$pricelist['amount']?></td>

</tr>
<?php }?>


</table>
</div>


<?php
if($this->Common->isLoggedIn()&&$this->Common->hasUserProvider($data['User']['id'])&&(!$this->Common->isReviews($data['User']['id']))){
?>
<div class="add_review">
<div class="title_heading">
<h3>Add Your Review</h3>
</div> 
 <?php echo $this->Form->create('Review', ['class'=>'care_search','type'=>'post','url' => [ 'controller' => 'reviews', 'action' => 'add']]); ?>

<input  type="hidden" name="data[Review][provider]" value="<?=$data['User']['id']?>">

<div class="add_rev_entry afclr">

<div class="list_one">
<h3>Your Name</h3>
<input required="required" type="text" readonly="readonly" name="data[Review][name]" value="<?=$this->Common->username()?>">
</div>

<div class="list_two">
<h3>Email</h3>
<input required="required" type="email" readonly="readonly" name="data[Review][email]" value="<?=$this->Common->useremail()?>">

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
<?php }?>
<?php 
$reviewcount=0;
$rating=0;
 foreach($reviews as $review){
	$rating+=(int)$review['Review']['rating']; 
	$reviewcount++;
 }
if($rating > 0)
{
$per=(($rating/$reviewcount)*100)/5;
}
 ?>


<div class="title_heading title_heading_inner">
<div class="detail_search_icon"><i class="fa fa-heart"></i><h3><b>Reviews</b></h3></div>
</div>
<div class="star_rating reviews_all_rating">
<?php 
$total_review=sizeof($reviews);
?>
<div class="ratings ">
  <div class="empty-stars"></div>
  <div class="full-stars" style="width:<?=$per?>%"></div>
</div>
<?php if($reviewcount > 0){ ?>
<span><?=number_format($rating/$reviewcount,1)?> out of 5.0 ,  <?=$total_review?> Customer Reviews</span>
<?php } else{ ?>
<span> No reviews yet</span>
<?php } ?>
</div>
<div class="review_block">
<?php

 foreach($reviews as $review){ ?>

<div class="review_one">
<h4><i class="fa fa-user"></i>  <?=$this->Common->getUserName($review['Review']['user_id'])?></h4>
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
<style>
.saveprice.removechildbtn {
  
    padding: 12px 22px;
	width:95%;
	border:none;
	cursor:pointer;
}
</style>