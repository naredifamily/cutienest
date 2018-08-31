<div class="log_outer">
<div class="logout_section afclr">
<div class="lo_left">
<div class="profileImage">
<?php if(!isset($Profileimage['Profileimage']['path'])){?>
<img src="<?php echo Configure::read('SITE_URL') ?>images/no-img.jpg" height="100" width="100" alt="">
<?php }else{
	?>
  <img src="<?=Configure::read('SITE_URL').'uploads/gallery/'.@$Profileimage['Profileimage']['path']?>" class="logoimg" height="100" width="100" alt="">
<?php }?>
</div>

<div class="profile_sub_detail">
<h3><?php
$nameuser = (explode(" ",$this->Common->username())); ?>
<?php echo $nameuser[0]; ?></h3>
<?php
 if(strlen($this->Common->username())>0){
?>
<h4>In Bussiness </h4>
<?php }?>
<h5><?php echo $this->Common->stateName($this->Common->userState());?></h5>

<div class="lo_right">
<a href="<?=Configure::read('SITE_URL')?>providers/logout">Logout</a>
</div>
</div>
</div>
 
</div>
</div>

<ul>
<?php
    $link =  $this->here;
    $link_array = explode('/',$link);
    $page =  end($link_array);
?>
 <li><a <?php if($page=='viewMyProfile'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>providers/viewMyProfile">
 <i class="fa fa-file-text-o" aria-hidden="true"></i>View Profile</a></li> 
 
 <li><a href="<?php echo Configure::read('SITE_URL') ?>search/detail/<?=CakeSession::read('Auth.User.id')?>" target="_blank"><i class="fa fa-users" aria-hidden="true"></i>Profile Preview</a> </li>
 
<li><a <?php if($page=='updateProviderProfile'){?> class="active" <?php }?>  href="<?php echo Configure::read('SITE_URL') ?>providers/updateProviderProfile"><i class="la la-user"></i>Update Profile</a></li>
<li><a <?php if($page=='profilePicture'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>providers/profilePicture"><i class="la la-upload"></i>Profile Picture</a></li>
<li><a <?php if($page=='about'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>providers/about"><i class="la la-edit"></i>Update About Us</a></li>
<li><a <?php if($page=='bankdetails'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>providers/bankdetails"><i class="la fa-university"></i>Bank Details</a></li>
<li><a <?php if($page=='image'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>providers/image"><i class="la la-upload"></i>Upload Pictures</a></li>
<li><a <?php if($page=='availability'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>providers/availability"><i class="la la-calendar-check-o"></i>Availability</a></li>
<li><a <?php if($page=='pricelist'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>providers/pricelist"><i class="la la-money"></i>Price Sheet</a></li>
<li><a <?php if($page=='schedule'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>providers/schedule"><i class="la la-calendar-check-o"></i>Schedule</a></li>
<li><a <?php if($page=='invoice'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>providers/invoice"><i class="fa fa-file-text-o" aria-hidden="true"></i>Invoices</a></li>
<li><a <?php if($page=='reserveRequest'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>providers/reserveRequest"><i class="la la-user"></i>Enrollments</a></li>
  <li><a <?php if($page=='reviewsRating'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>providers/reviewsRating"><i class="fa fa-heart"></i>My Reviews</a></li> 
 <li><a <?php if($page=='changePassword'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>providers/changePassword"><i class="la la-unlock"></i>Change Password</a></li> 
 
 
<?php /*?><li><a <?php if($page=='admissionpack'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>providers/admissionpack"><i class="la la-upload"></i>Admission Pack</a></li><?php */?>
 
</ul>