<div class="page_title_bar">
<div class="wrapper">
<h1>Smiling Stars Child Care Center</h1>
</div>
</div>
<div class="page_content">
<div class="wrapper afclr">
<div class="side_bar">
<a href="#">Reserve A Spot</a>
<a href="#">Book A Tour</a>
<a href="#">Call This Provider</a>
<a href="#">Send Message</a>
</div>
<div class="provider_left">
<div class="pimg"><img src="images/provider_main_img.jpg" alt=""></div>
<div class="title_heading">
<h3>About <?=$data['User']['about']?></h3>
</div>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec quis tellus dui. Vestibulum sit amet erat rutrum, scelerisque ante et, blandit magna. Morbi tempus dignissim dui nec ultricies. Nam ac orci dignissim, blandit purus sit amet, hendrerit urna. Quisque posuere ligula blandit quam rhoncus, ac congue augue mollis. Donec est eros, bibendum sodales sem in, finibus blandit massa. Suspendisse sodales quam nec neque ultricies, sed finibus mi pharetra. Proin vitae ligula risus. Nunc at porta magna, non elementum libero. Suspendisse risus risus, bibendum at gravida id, sodales vitae purus.</p>
<div class="title_heading">
<h3>Address</h3>
</div>
<div class="address_text">
<?=$data['User']['about']?>,<br>
<?=$data['User']['state']?>,USA - <?=$data['User']['zip']?></div>
<div class="title_heading">
<h3>Location</h3>
</div>
<div id="map"></div>
<script>
      function initMap() {
        var uluru = {lat:55.861011, lng: -4.252543};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom:14,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map,
		  icon:'images/map_icon.png'
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
<tr>
<td data-th="Classroom Type">Toddler</td>
<td data-th="Rate">$230</td>
<td data-th="Rate Type">Per week</td>
<td data-th="Seats">3</td>
<td data-th="Timings"> Mon-Sat (9:00AM-7:00PM)</td>
</tr>

<tr>
<td data-th="Classroom Type">Preschool</td>
<td data-th="Rate">$220</td>
<td data-th="Rate Type">Per week</td>
<td data-th="Seats">2</td>
<td data-th="Timings">Tue-Fri (9:00AM-1:00PM)</td>
</tr>

<tr>
<td data-th="Classroom Type">Pre-K</td>
<td data-th="Rate">$212</td>
<td data-th="Rate Type">Per week</td>
<td data-th="Seats">4</td>
<td data-th="Timings">Mon-Fri (9:00AM-5:00PM)</td>
</tr>

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