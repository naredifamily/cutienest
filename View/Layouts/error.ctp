<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Cutienest
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('style');
		echo $this->Html->css('easy-responsive-tabs');
		echo $this->Html->css('font-awesome');
		echo $this->Html->css('jquery.bxslider.min');
		echo $this->Html->css('owl.carousel');
		echo $this->Html->css('swiper.min');
		echo $this->Html->css('developer');
    	echo $this->Html->css('jquery.fancybox-buttons');
		echo $this->Html->css('jquery.fancybox');
		

		?>
        
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript">
		var SITE_URL = "<?php echo Configure::read('SITE_URL') ?>";

		</script>
		<?php
        echo $this->Html->script('browser-detect.js');
        echo $this->Html->script('easy-responsive-tabs.js');
        echo $this->Html->script('jquery.bxslider.min.js');
        echo $this->Html->script('jquery-1.11.1.min.js');
        echo $this->Html->script('owl.carousel.min.js');
	 
        echo $this->Html->script('skrollr.min.js');
        echo $this->Html->script('SmoothScroll.min.js');
        echo $this->Html->script('swiper.min.js');
        echo $this->Html->script('jquery.fancybox.js');
        echo $this->Html->script('jquery.fancybox-buttons.js');
		echo $this->Html->script('tinymce/tinymce.min.js');
		echo $this->Html->script('tinymce/init-tinymce.js');
		echo $this->Html->script('jquery.bxslider.js');
		echo $this->Html->script('common.js');
		echo $this->Html->script('jquery.emojiRatings.js');
		

		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
    <script type="text/javascript">
<!--
function bodyLoad(){
	//var jj = BrowserDetect.browser + ' ' + BrowserDetect.version + ' ' + BrowserDetect.OS ;
	//alert( jj);
	document.getElementsByTagName('body')[0].className+= ' ' + BrowserDetect.OS + ' ' + BrowserDetect.browser + ' v' + BrowserDetect.version;
	}
	window.onload = bodyLoad;
// -->
</script>
</head>

<body  id="skrollr-body">
<div class="overlay"></div>
			
            
            
<?php echo $this->element('header'); ?>

<div class="page_title_bar">
<div class="wrapper">
<h1>404 Page</h1>
</div>
</div>
<div class="page_content">
<div class="wrapper afclr">

<div class="error_page">
<h2>4 0 4</h2>
<h3>Oops! This Page Could Not Be Found!</h3>
<p>Sorry but the page you are looking for does not exist, have been removed or name changed.</p>

<div class="error_page_btn">
<a href="<?php echo Configure::read('SITE_URL') ?>">Go to Homepage</a>
</div>


</div>



</div>
</div>

<?php echo $this->element('footer'); ?>
<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
