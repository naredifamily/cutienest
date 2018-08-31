  <script>
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
<h1><?=$data['User']['name']?></h1>
</div>
</div>
<div class="page_content">
<div class="wrapper afclr">
<div class="side_bar">
<?php
if(!$this->Common->isReserved($data['User']['id'])){
?>
<?php if($this->Common->isLoggedIn()){?>
<a href="<?php echo Configure::read('SITE_URL')?>users/reserve/<?=$data['User']['id']?>">Reserve A Spot</a>
<?php }else{?>
	<a href="<?php echo Configure::read('SITE_URL')?>users/signin?redirect=<?php echo Configure::read('SITE_URL')?>users/reserve/<?=$data['User']['id']?>">Reserve A Spot</a>

<?php }
}
else
{?>
	<a href="#" style="background:#e68cba;color:#fff;">Reserved</a>

	<?php
}
?>
<a href="#" class="show1">Book A Tour</a>
<a href="tel:<?=$data['User']['phone']?>">Call This Provider</a>
<a href="#" class="show2">Send Message</a>

<div id="pop1" class="simplePopup">
<div class="add_review">
<div class="title_heading">
<h3>Book a Tour</h3>
</div>
 <?php echo $this->Form->create('User', ['class'=>'care_search','type'=>'post','url' => [ 'controller' => 'users', 'action' => 'bookTour']]); ?>

<div class="add_rev_entry afclr">

<div class="list_one">
<h3>Your Name</h3>
<input type="text" name="name" value="<?=$this->Common->username()?>">
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
</div>  
  
  </div>
 
<div id="pop2" class="simplePopup">
<div class="add_review">
<div class="title_heading">
<h3>Send Message</h3>
</div>
 <?php echo $this->Form->create('User', ['class'=>'care_search','type'=>'post','url' => [ 'controller' => 'users', 'action' => 'sendMessage']]); ?>

<div class="add_rev_entry afclr">

<div class="list_one">
<h3>Your Name</h3>
<input type="text" name="name" value="<?=$this->Common->username()?>">
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


</div>
<div class="provider_left">






<div class="pimg slider">
<?php 


foreach($gallery as $images){?>

<img src="<?php echo Configure::read('SITE_URL')?>gallery/<?=$images['Image']['path']?>" alt="">
<?php }?>

</div>
<div class="title_heading">
<h3>About <?=$data['User']['name']?></h3>
</div>
<?=$data['User']['about']?>
<div class="title_heading">
<h3>Address</h3>
</div>
<div class="address_text">
<?=$data['User']['address']?>,<br>
<?=$data['User']['state']?>,USA - <?=$data['User']['zip']?></div>
<div class="title_heading">
<h3>Location</h3>
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
<script src="https://maps.googleapis.com/maps/api/js?&callback=initMap"></script>
<div class="title_heading">
<h3>Availability (Detailed)</h3>
</div>
<div class="availability_table">
<table>
<tr>
<td>Classroom Type</td>
<td>Rate</td>
<td>Rate Type</td>
<td>Seats</td>
<td>Timings</td>
</tr>
<?php 
foreach($data['Pricelist'] as $pricelist){?>
<tr>
<td data-th="Classroom Type"><?=$pricelist['agegroup']?></td>
<td data-th="Rate">$<?=$pricelist['amount']?></td>
<td data-th="Rate Type"><?=$pricelist['timeslot']?></td>
<td data-th="Seats"><?=$pricelist['seat']?></td>
<td data-th="Timings"> 

<?php if($data['User']['fullday']=='1'){?>
 Mon-Sat (<?php echo date("g:i a", strtotime($data['User']['fulldaytime_from'])); ?> – <?php echo date("g:i a", strtotime($data['User']['fulldaytime_to'])); ?>)
<?php }
else{
	?>
	 Mon-Sat (<?php echo date("g:i a", strtotime($data['User']['halfdaytime_from'])); ?> – <?php echo date("g:i a", strtotime($data['User']['halfdaytime_from'])); ?>)

	
	<?php
	}
?>
</td>
</tr>
<?php }?>


</table>
<p>*availability last updated on 01/01/18</p>
</div>

<div class="add_review">
<div class="title_heading">
<h3>Add Your Review</h3>
</div>

<div class="add_rev_entry afclr">

<div class="list_one">
<h3>Your Name</h3>
<input type="text" name="Customer Name" value="">
</div>

<div class="list_two">
<h3>Email</h3>
<input type="text" name="Payment Due" value="">
</div>
</div>
<div class="clr"></div>

<div class="r_ratings">
<h3>Select ratings</h3>
<div class="select_ratings"><input type="radio" name="rating" value="1" checked>1</div>
<div class="select_ratings"><input type="radio" name="rating" value="2" checked>2</div>
<div class="select_ratings"><input type="radio" name="rating" value="3" checked>3</div>
<div class="select_ratings"><input type="radio" name="rating" value="4" checked>4</div>
<div class="select_ratings"><input type="radio" name="rating" value="5" checked>5</div>
</div>

<div class="list_three">
<h3>Your Comment</h3>
<textarea rows="4" cols="50"></textarea>
</div>

<div class="create_invoice_btn"><a href="#">Submit</a></div>

</div>


<div class="title_heading">
<h3>Reviews</h3>
</div>
<div class="review_block">
<div class="review_one">
<h4>John Willson</h4>
<div class="star_rating">
<img src="images/star.png" alt="">
<img src="images/star.png" alt="">
<img src="images/star.png" alt="">
<img src="images/star.png" alt="">
<img src="images/star.png" alt="">
<span>5 out of 5, reviewed on Sep 17, 2017</span>
</div>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>

</div>
<div class="review_one">
<h4>John Willson</h4>
<div class="star_rating">
<img src="images/star.png" alt="">
<img src="images/star.png" alt="">
<img src="images/star.png" alt="">
<img src="images/star.png" alt="">
<img src="images/star.png" alt="">
<span>5 out of 5, reviewed on Sep 17, 2017</span>
</div>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>

</div>
<div class="review_one">
<h4>John Willson</h4>
<div class="star_rating">
<img src="images/star.png" alt="">
<img src="images/star.png" alt="">
<img src="images/star.png" alt="">
<img src="images/star.png" alt="">
<img src="images/star.png" alt="">
<span>5 out of 5, reviewed on Sep 17, 2017</span>
</div>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>

</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">

$(document).ready(function(){

    $('.show1').click(function(){
	$('#pop1').simplePopup();
    });
  
    $('.show2').click(function(){
	$('#pop2').simplePopup();
    });  
  
});

</script>

