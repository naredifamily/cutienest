 <script>
$=jQuery;
$(function() {
	$('.why_cutienest_innnr_block').matchHeight();
	$('.search_cont_outer .search_logo').matchHeight();
});
</script>
<div class="banner_img">
<div class="swiper-container banner_slider">
    <div class="swiper-wrapper">
      <div class="swiper-slide"><img src="<?php echo Configure::read('SITE_URL') ?>/images/banner_image.jpg" alt=""></div>
      <div class="swiper-slide"><img src="<?php echo Configure::read('SITE_URL') ?>/images/banner_image.jpg" alt=""></div>
      <div class="swiper-slide"><img src="<?php echo Configure::read('SITE_URL') ?>/images/banner_image.jpg" alt=""></div>
    </div>
    <div class="swiper_form">
    <div class="wrapper">
  <div class="swiper_inner_form">
  <h3>Look for your nearest </h3>
  <h2>Cutienest family child care</h2>
                          <?php echo $this->Form->create('User', ['class'=>'care_search','type'=>'get','url' => [ 'controller' => 'search', 'action' => 'index']]); ?>
<input type="hidden" name="lati" id="lati" value="">
<input type="hidden" name="long" id="long" value="">

  <p><input type="text" id="postal_code" name="zip" placeholder="Zip Code"></p>
 
  
<!--  <p><input type="text" name="daystime" placeholder="Full / Half days"></p>
-->  <p><button type="submit" name="submit"><i class="fa fa-search" aria-hidden="true"></i>SEARCH</button></p>  
  </form>  
  </div>
    </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>
</div>
<?php /*?><div class="banner_below_block afclr">
<div class="wrapper">
<div class="banner_below_text_in afclr">
<div class="pay_as_section pay_section_title_sep"><h4>Pay-As-You-Go</h4></div>
<div class="pay_as_section pay_as_section_text"><p>At Cutienest, You do not pay for your vacation time!</p></div>
<div class="pay_as_section pay_as_section_read_more"><a href="#">Read more</a></div>
</div>
</div>
</div><?php */?>

<div class="works_section afclr">
<div class="nearest_child_care_title afclr">
<div class="wrapper">
<h1>Your Nearest Family Child Care</h1>
</div>
</div>
<div class="wrapper afclr" id="latest">


</div></div>
<!--
<h1>How It Works</h1>
<div class="works_inner afclr">
<div class="work_one">
<div class="workimg"><div class="wno">1</div>
<div class="work_icon">
<span><img class="simple_img" src="<?php echo Configure::read('SITE_URL') ?>/images/books_icon.png" alt=""><img class="hover_img" src="<?php echo Configure::read('SITE_URL') ?>/images/bok_icon_hover.png" alt=""></span></div>
</div>
<h2>Register</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eleifend pretium dui, vel sollicitudin tortor. </p>
</div>
<div class="work_one">
<div class="workimg"><div class="wno">2</div>
<div class="work_icon">
<span><img class="simple_img" src="<?php echo Configure::read('SITE_URL') ?>/images/profile_icon.png" alt=""><img class="hover_img" src="<?php echo Configure::read('SITE_URL') ?>/images/profile_icon_hover.png" alt=""></span></div>
</div>
<h2>Search Profiles</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eleifend pretium dui, vel sollicitudin tortor. </p>
</div>
<div class="work_one">
<div class="workimg"><div class="wno">3</div>
<div class="work_icon">
<span><img class="simple_img" src="<?php echo Configure::read('SITE_URL') ?>/images/hire_icon.png" alt=""><img class="hover_img" src="<?php echo Configure::read('SITE_URL') ?>/images/hire_icon_hover.png" alt=""></span></div>
</div>
<h2>Hire Caregiver</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eleifend pretium dui, vel sollicitudin tortor. </p>
</div>
<div class="work_one">
<div class="workimg"><div class="wno">4</div>
<div class="work_icon">
<span><img class="simple_img" src="<?php echo Configure::read('SITE_URL') ?>/images/payment_icon.png" alt=""><img class="hover_img" src="<?php echo Configure::read('SITE_URL') ?>/images/payment_icon_white.png" alt=""></span></div>
</div>
<h2>Make Payment</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eleifend pretium dui, vel sollicitudin tortor. </p>
</div>
</div>
</div>
</div>-->


<div class="why_cutienest_section afclr">
<div class="wrapper">
<h1>Why Cutienest?</h1>

<div class="why_cutienest_block_1 afclr">
<div class="why_cutienest_block_1_left"><img src="<?php echo Configure::read('SITE_URL') ?>css/images/valeria-zoncoll-575958-unsplash-(1)"  /></div>
<div class="why_cutienest_block_1_right">
<div class="why_cutnst_icon afclr"><img src="<?php echo Configure::read('SITE_URL') ?>css/images/easy-simple-icon.png"  /></div>
<h3>It’s easy and simple! </h3>
<p>You find family childcare providers around you with their availability and pricing </p>
</div>

</div>

<div class="why_cutienest_block_2 afclr">
<div class="why_cutienest_innnr_block">
<div class="why_cutienest_innnr_detail afclr">
<div class="why_cutienest_innnr_img">
<img src="<?php echo Configure::read('SITE_URL') ?>css/images/sharon-mccutcheon-720225-unsplash.jpg" alt="" /></div>

<h3>For all kind of childcare needs!</h3>
<p>Be it drop off, weekend care, or night time care, We have providers for all your childcare needs
</p>

</div>

</div>

<div class="why_cutienest_innnr_block">
<div class="why_cutienest_innnr_detail afclr">
<div class="why_cutienest_innnr_img">
<img src="<?php echo Configure::read('SITE_URL') ?>css/images/rhone-702757-unsplash.jpg" alt="" /></div>

<h3>Add more Zing to your vacation!</h3>
<p>You Do Not Pay* For Your Vacation Time!

</p>

</div>

</div>


<div class="why_cutienest_innnr_block">
<div class="why_cutienest_innnr_detail afclr">
<div class="why_cutienest_innnr_img">
<img src="<?php echo Configure::read('SITE_URL') ?>css/images/rawpixel-651370-unsplash.jpg" alt="" /></div>

<h3>Secure online payment</h3>
<p>You can pay your childcare provider digitally! 
</p>

</div>

</div>

</div>

<div class="why_cutienest_bottom_section afclr">
*With a week’s notice and a maximum of 12 days a year, you do not pay for your vacation time  
</div>

</div>



</div>

<div class="feature_list">
<div class="wrapper">
<div class="h_feature_list_title afclr"><h1>Why Family Childcare?</h1></div>
<div class="feature_list_inner afclr">
<div class="feature_one">
<div class="icon_outer">
<span><img src="<?php echo Configure::read('SITE_URL') ?>/images/licence.png" alt=""></span>
</div>
<h3>Licensed Child Care</h3>
<p>Family Childcare service providers are trained and certified professionals by the state to provide quality child care services in a home-like environment rather than the institutional set-up </p>

</div>
 
<div class="feature_one">
<div class="icon_outer">
<span><img src="<?php echo Configure::read('SITE_URL') ?>/images/partner.png" alt=""></span>
</div>
<h3>Partnering with Families</h3>
<p>Family child care providers work closely with your family with much more personalised attention and care to your child(ren)
</p>

</div>

<div class="feature_one">
<div class="icon_outer">
<span><img src="<?php echo Configure::read('SITE_URL') ?>css/images/learning-icon.png" alt=""></span>
</div>
<h3>Great Learning Environment</h3>
<p>Family child care usually offers a mixed age-group class making it more like a family than a classroom which is a great learning environment for children of all ages
</p>

</div>
</div>
</div>
</div>

 


<div class="children_img">
<img src="<?php echo Configure::read('SITE_URL') ?>/images/children_banner.jpg" alt="">
<div class="children_img_inner"
<div class="wrapper">
<h1>Become a Provider</h1>
<p>Listing with us is absolutely Free!
</p>
<div class="provider_banner_button afclr"><a href="<?php echo Configure::read('SITE_URL') ?>users/provider">Get Started Now</a></div>

</div>
</div>
</div>
<div class="children_quality">
<!--<div class="wrapper">
<div class="why_family_child_care_block afclr">
<div class="why_family_child_care_block_inner afclr">
<h2>Why Family Child Care</h2>
<ul>
<li>Licensed Child care: State licenses Child care homes to give your children home like care and attention.</li>
<li>High quality Care: Personal Attention with least Child:Teacher ratio.</li>
<li>Partnering with your family: Working as a partner with your family in childcare.</li>
<li>Low Fee: Much lesser than commercial daycares <br>
And we can have related pictures to these points, as close as possible.</li>
</ul>

</div>
</div>



<?php /*?><div class="cq_inner afclr">
<div class="cq_one">
<div class="cq_icon"><img src="<?php echo Configure::read('SITE_URL') ?>/images/circle-1.png" alt=""></div>
<h3>High Quality Care</h3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eleifend pretium dui, vel sollicitudin tortor.</p>
</div>
<div class="cq_one">
<div class="cq_icon"><img src="<?php echo Configure::read('SITE_URL') ?>/images/circle-2.png" alt=""></div>
<h3>Helpful Nutrition</h3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eleifend pretium dui, vel sollicitudin tortor.</p>
</div>
<div class="cq_one">
<div class="cq_icon"><img src="<?php echo Configure::read('SITE_URL') ?>/images/circle-3.png" alt=""></div>
<h3>Educational Games</h3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eleifend pretium dui, vel sollicitudin tortor.</p>
</div>
<div class="cq_one">
<div class="cq_icon"><img src="<?php echo Configure::read('SITE_URL') ?>/images/circle-4.png" alt=""></div>
<h3>Good Location</h3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eleifend pretium dui, vel sollicitudin tortor.</p>
</div>
</div><?php */?>
</div>-->
</div>
</div>

 