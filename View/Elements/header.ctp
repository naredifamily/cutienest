<script>

$(document).ready(function() {
      $(".nav-menu").prepend("<div class='cross_button afclr'><a><i class='fa fa-times' aria-hidden='true'></i></a></div>");
      $(".cross_button").click(function() {
        $(this).parent(".nav-menu").removeClass("state-active");
        $(".overlay").removeClass("active");
        $(this).closest(".body_shift").parent().removeClass("no_overflow");
      });
    });


</script>

<script>
$=jQuery;
$(function() {
	$('.banner_bottom_block h3').matchHeight();
});
</script>


<input type="hidden" id="current_lati" value="">
<input type="hidden" id="current_long" value="">
<div id="loading">
    <img id="loading-image" src="<?php echo Configure::read('SITE_URL') ?>images/loading.gif" alt="Loading..."/>
</div>
<div class="se-pre-con"></div>
<div class="f_header <?php if($this->here=='/cutienest/'){?>upper_head<?php }?>">
<div class="wrapper afclr">
<div class="logo"><a href="<?php echo Configure::read('SITE_URL') ?>"><img src="<?php echo Configure::read('SITE_URL') ?>/images/logo.png" alt=""></a></div>
<div class="sitemenu">
<div class="site-menu">
<a href="javascript:void(1)" class="menu_expand afclr">
<i></i>
<i></i>
<i></i>
</a>

</div>





<div class="ghost-btn-group"><ul class="nav-menu afclr">
<li><a href="<?php echo Configure::read('SITE_URL') ?>"><i class="la la-home"></i> Home</a></li>
<!--<li class="menu-item-has-children"><a href="<?php echo Configure::read('SITE_URL') ?>pages/what-we-offer">What We Offer</a>

</li>
<li><a href="<?php echo Configure::read('SITE_URL') ?>pages/how-it-work">How It Works</a></li>-->
<?php if(!$this->Common->isLoggedIn()){?>
<li class="provider_btn sign_upn">
<a class="sign_in" href="<?php echo Configure::read('SITE_URL') ?>users/login/">Login</a></li>
<li class="provider_btn sign_upn">
<a class="sign_in" href="<?php echo Configure::read('SITE_URL') ?>users/signup/">Signup</a></li>
<?php }
else{
	if($this->Common->role() == 1){
?>
<li class="provider_btn"><a href="<?php echo Configure::read('SITE_URL') ?>users/viewMyProfile">My Account</a></li>
<?php /*?><li class="provider_btn"><a href="<?php echo Configure::read('SITE_URL') ?>search/detail/<?=CakeSession::read('Auth.User.id')?>" target="_blank">View My Profile</a></li><?php */?>
	<?php }else{?>
    <li class="provider_btn"><a href="<?php echo Configure::read('SITE_URL') ?>users/viewMyProfile">My Account</a></li>

	<?php }?>
<?php }?>

<?php if($this->Common->role() == 2 &&$this->Common->isProviderRequestSent()==0){?>
<li class="provider_btn"><a href="<?php echo Configure::read('SITE_URL') ?>users/provider">Become a Provider</a></li>
<?php }else if($this->Common->role() == 1){?>
<?php		  
}
else{
?>
<li class="provider_btn"><a href="<?php echo Configure::read('SITE_URL') ?>users/provider">Become a Provider</a></li>
<?php }?>
</ul>
<?php


 if($this->Common->role() == 2){
	 if($this->Common->isProviderRequestSent()==0){
	 ?>
<div class="ghost_black_btn"><a href="<?php echo Configure::read('SITE_URL') ?>users/provider">Become a Provider</a></div>
<?php }?>
<?php }else if($this->Common->role() == 1){?>
<?php }
else{?>
<div class="ghost_black_btn"><a href="<?php echo Configure::read('SITE_URL') ?>users/provider">Become a Provider</a></div>
 <?php }
?>

<style type="text/css">
	.login_black_btn a i{padding-right: 5px}
</style>


<?php if(!$this->Common->isLoggedIn()){?>
<div class="ghost_black_btn login_black_btn">
<a style="padding-right: 3px !important" href="<?php echo Configure::read('SITE_URL') ?>users/login"><i class="la la-sign-in"></i>Login</a>
<a href="<?php echo Configure::read('SITE_URL') ?>users/signup"><i class="la la-user"></i>Signup</a></div>

<?php }
else{
		if($this->Common->role() == 1){
?>
<div class="user_d"><span><i class="la la-user"></i> Hi, 
<?php
$nameuser = (explode(" ",$this->Common->username())); ?>
<?php echo $nameuser[0]; ?>

</span>
<div class="usermenu">
<ul>
<li><a href="<?php echo Configure::read('SITE_URL') ?>users/viewMyProfile">My Account</a></li>
 <?php /*?><li class="provider_btn"><a href="<?php echo Configure::read('SITE_URL') ?>search/detail/<?=CakeSession::read('Auth.User.id')?>" target="_blank">View My Profile</a></li><?php */?> 

<li><a href="<?php echo Configure::read('SITE_URL') ?>users/logout">Log Out</a></li>
</ul>
</div>
<?php /*?><div class="ghost_black_btn login_black_btn"><a href="<?php echo Configure::read('SITE_URL') ?>users/viewMyProfile">My Account</a></div><?php */?>
		<?php }else{?>
      <?php /*?>  <div class="ghost_black_btn login_black_btn"><a href="<?php echo Configure::read('SITE_URL') ?>users/userInvoice">My Account</a></div><?php */?>
<div class="user_d"><span><i class="la la-user"></i> Hi, 
<?php
$nameuser = (explode(" ",$this->Common->username())); ?>
<?php echo $nameuser[0]; ?></span>
<div class="usermenu">
<ul>
<li><a href="<?php echo Configure::read('SITE_URL') ?>users/viewMyProfile">My Account</a></li>
<li><a href="<?php echo Configure::read('SITE_URL') ?>users/logout">Log Out</a></li>
</ul>
</div>
</div>
        <?php }?>
<?php }?>

   
</div>
</div>
</div>
</div>
</div>