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
<?php if(!$this->Common->isLoggedIn()){?>
<li class="provider_btn sign_upn">
<a class="sign_in" href="<?php echo Configure::read('SITE_URL') ?>providers/login/">Login</a></li>
<li class="provider_btn sign_upn">
<a class="sign_in" href="<?php echo Configure::read('SITE_URL') ?>providers/signup/">Signup</a></li>
<?php }
else{?>
<li class="provider_btn"><a href="<?php echo Configure::read('SITE_URL') ?>providers/viewMyProfile">My Account</a></li>
<?php /*?><li class="provider_btn"><a href="<?php echo Configure::read('SITE_URL') ?>search/detail/<?=CakeSession::read('Auth.User.id')?>" target="_blank">View My Profile</a></li><?php */?>
<?php }?>
</ul>
<style type="text/css">
	.login_black_btn a i{padding-right: 5px}
</style>


<?php if(!$this->Common->isLoggedIn()){?>
<div class="ghost_black_btn login_black_btn">
<a style="padding-right: 3px !important" href="<?php echo Configure::read('SITE_URL') ?>providers/login"><i class="la la-sign-in"></i>Login</a>
<a href="<?php echo Configure::read('SITE_URL') ?>users/signup"><i class="la la-user"></i>Signup</a></div>

<?php }
else{
		
?>
<div class="user_d"><span><i class="la la-user"></i> Hi, 
<?php
$nameuser = (explode(" ",$this->Common->username())); ?>
<?php echo $nameuser[0]; ?>

</span>
<div class="usermenu">
<ul>
<li><a href="<?php echo Configure::read('SITE_URL') ?>providers/viewMyProfile">My Account</a></li>
<?php /*?><li class="provider_btn"><a href="<?php echo Configure::read('SITE_URL') ?>search/detail/<?=CakeSession::read('Auth.User.id')?>" target="_blank">View My Profile</a></li><?php */?>

<li><a href="<?php echo Configure::read('SITE_URL') ?>providers/logout">Log Out</a></li>
</ul>
</div>
<?php /*?><div class="ghost_black_btn login_black_btn"><a href="<?php echo Configure::read('SITE_URL') ?>users/viewMyProfile">My Account</a></div><?php */?>
		
<?php }?>

   
</div>
</div>
</div>
</div>
</div>