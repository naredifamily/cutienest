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
<h3><?php
$nameuser = (explode(" ",$this->Common->username())); ?>
<?php echo $nameuser[0]; ?></h3>
<?php
 if(strlen($this->Common->username())>0){
	 if($this->Common->role() == 1){
	 ?>
 
<h4>In Bussiness </h4>
<?php }?>
<?php }?>
<h5><?php echo $this->Common->stateName($this->Common->userState());?></h5>

</div>
<div class="lo_right">
<a href="<?=Configure::read('SITE_URL')?>users/logout">Logout</a>
</div>
</div>
</div>

<ul>
<?php
    $link =  $this->here;
    $link_array = explode('/',$link);
    $page =  end($link_array);
?>
<li><a <?php if($page=='viewMyProfile'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>users/viewMyProfile"><i class="fa fa-file-text-o" aria-hidden="true"></i>View Profile</a></li>
 <?php if ($this->Common->role() == 1){ ?>
<!--<li><a <?php if($page=='policy'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>users/policy"><i class="la la-pencil-square"></i>Policies</a></li>-->
<!--<li><a <?php if($page=='programme_circulam'){?> class="active" <?php }?>  href="#">Programs and Curriculum</a></li>-->

       <li><a <?php if($page=='updateProviderProfile'){?> class="active" <?php }?>  href="<?php echo Configure::read('SITE_URL') ?>users/updateProviderProfile"><i class="la la-user"></i>Update Profile</a></li>

<li><a <?php if($page=='invoice'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>users/invoice"><i class="fa fa-file-text-o" aria-hidden="true"></i>Invoices</a></li>
<li><a <?php if($page=='pricelist'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>users/pricelist"><i class="la la-money"></i>Price Sheet</a></li>
<li><a <?php if($page=='schedule'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>users/schedule"><i class="la la-calendar-check-o"></i>Schedule</a></li>
<li><a <?php if($page=='availability'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>users/availability"><i class="la la-calendar-check-o"></i>Availability</a></li>
<li><a <?php if($page=='image'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>users/image"><i class="la la-upload"></i>Upload photos</a></li>
<li><a <?php if($page=='profilePicture'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>users/profilePicture"><i class="la la-upload"></i>Profile Picture</a></li>
<li><a <?php if($page=='admissionpack'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>users/admissionpack"><i class="la la-upload"></i>Admission Pack</a></li>
<li><a <?php if($page=='about'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>users/about"><i class="la la-edit"></i>Update About Us</a></li>
<li><a <?php if($page=='reserveRequest'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>users/reserveRequest"><i class="la la-user"></i>Users</a></li>
  <li><a <?php if($page=='reviewsRating'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>users/reviewsRating"><i class="fa fa-star" aria-hidden="true"></i>My Review</a></li>
<li><a <?php if($page=='changePassword'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>users/changePassword"><i class="la la-unlock"></i>Change Password</a></li>


<?php }?>
 <?php if ($this->Common->role() == 2){
	 
	  ?>
       <li><a <?php if($page=='updateUserProfile'){?> class="active" <?php }?>  href="<?php echo Configure::read('SITE_URL') ?>users/updateUserProfile"><i class="fa fa-user" aria-hidden="true"></i>Update Profile</a></li>
	   
<li><a <?php if($page=='reserveProvider'){?> class="active" <?php }?>  href="<?php echo Configure::read('SITE_URL') ?>users/reserveProvider"><i class="fa fa-user" aria-hidden="true"></i>Reserved Providers</a></li>

 <li><a <?php if($page=='userInvoice'){?> class="active" <?php }?>  href="<?php echo Configure::read('SITE_URL') ?>users/userInvoice"><i class="fa fa-file-text-o" aria-hidden="true"></i>Invoices</a></li>
  <li><a <?php if($page=='reviewsRating'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>users/reviewsRating"><i class="fa fa-star" aria-hidden="true"></i>My Review</a></li>
 <li><a <?php if($page=='profilePicture'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>users/profilePicture"><i class="la la-upload"></i>Profile Picture</a></li>
 <li><a <?php if($page=='changePassword'){?> class="active" <?php }?> href="<?php echo Configure::read('SITE_URL') ?>users/changePassword"><i class="fa fa-lock" aria-hidden="true"></i>Change Password</a></li>

<?php }?>
</ul>