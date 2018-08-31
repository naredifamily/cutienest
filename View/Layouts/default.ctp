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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?php if(isset($title)) { 
			echo $title;
		}
		else
			{ ?>
		Cutienest Familty Child Care
		<?php } ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('style');
		echo $this->Html->css('style_ankit');
		echo $this->Html->css('easy-responsive-tabs');
		echo $this->Html->css('font-awesome');
		echo $this->Html->css('jquery.bxslider.min');
		echo $this->Html->css('owl.carousel');
		echo $this->Html->css('swiper.min');
		//echo $this->Html->css('developer');
    	echo $this->Html->css('jquery.fancybox-buttons');
		echo $this->Html->css('jquery.fancybox');
		echo $this->Html->css('line-awesome.min.css');
		
		
				echo $this->Html->css('iEdit.css');
				
		//do not use bootstrap.min.css - it's creating a lot of layout issues on all parts of website
		//echo $this->Html->css('bootstrap.css');
		?>
        
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript">
		var SITE_URL = "<?php echo Configure::read('SITE_URL') ?>";

		</script>
		<?php
        echo $this->Html->script('browser-detect.js');
        echo $this->Html->script('easy-responsive-tabs.js');
        echo $this->Html->script('jquery.bxslider.min.js');
       
        echo $this->Html->script('owl.carousel.min.js');
	 echo $this->Html->script('jquery.matchHeight-min.js');
        echo $this->Html->script('skrollr.min.js');
        //echo $this->Html->script('SmoothScroll.min.js');
        echo $this->Html->script('swiper.min.js');
        echo $this->Html->script('jquery.fancybox.js');
        echo $this->Html->script('jquery.fancybox-buttons.js');
		echo $this->Html->script('tinymce/tinymce.min.js');
		echo $this->Html->script('tinymce/init-tinymce.js');
		echo $this->Html->script('jquery.bxslider.js');
		echo $this->Html->script('common.js');
		echo $this->Html->script('jquery.emojiRatings.js');
		

		echo $this->Html->script('script.js');
		echo $this->Html->script('iEdit.js');
		
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
    <script type="text/javascript">
	$=jQuery;
<!--
function bodyLoad(){
	//var jj = BrowserDetect.browser + ' ' + BrowserDetect.version + ' ' + BrowserDetect.OS ;
	//alert( jj);
	document.getElementsByTagName('body')[0].className+= ' ' + BrowserDetect.OS + ' ' + BrowserDetect.browser + ' v' + BrowserDetect.version;
	}
	window.onload = bodyLoad;
// -->
jQuery(function() {
	// jQuery(".search_content").matchHeight();
});
$(document).ready(function() {
$('.fancybox').fancybox();
});
</script>


<script>

$(document).ready(function(){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showLocation, positionError, {timeout:10000});
		//alert();
    } else { 
        $('#location').html('Geolocation is not supported by this browser.');
    }
});

 function positionError(error) {
      var errorCode = error.code;
      var message = error.message;

      //alert(message);
  }

function showLocation(position) {
	//alert();
    var latitude = position.coords.latitude;
	var longitude = position.coords.longitude;
   //alert(latitude);
   //alert(longitude);
   
	$("#lati").val(latitude);
	$("#long").val(longitude);
	$("#current_lati").val(latitude);
	$("#current_long").val(longitude);
	          $.ajax({
                    type:'POST',
                    url:'https://maps.googleapis.com/maps/api/geocode/json?latlng='+latitude+','+longitude+'&sensor=false&key=AIzaSyDIPQrevDYVkTIYt88K-MRBjxSQO7ftcEY',
                    data:{},
                    success:function(address){
						
                        if(address){
                          processJSON(address);
                        }else{
                           
                        }
                    }
                });
	

  function processJSON(json) { 
  var address_length=json.results[0].address_components.length;
	  for (i = 0; i < address_length; i++) { 
	  if(json.results[0].address_components[i].types=='postal_code')
      {
      $("#postal_code").val( json.results[0].address_components[i].long_name);
	  	var zip=json.results[0].address_components[i].long_name;
	
	var lati =$("#current_lati").val();
	var long=$("#current_long").val();
     jQuery.ajax({url: "<?php echo Configure::read('SITE_URL') ?>/search/latest/"+zip+"?lati="+lati+"&long="+long, success: function(result){

									//jQuery("#spinner").hide();



jQuery("#latest").html(result);

    }});
	       break;
      }
   
}
}
	


}

</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-102156243-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-102156243-2');
</script>
</head>

<body  id="skrollr-body">
<div class="overlay"></div>
<?php echo $this->element('header'); ?>
<?php echo $this->fetch('content'); ?>
<?php echo $this->element('footer'); ?>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>
<script>
$(document).ready(function(e) {
	var zip= $("#postal_code").val();
	
	var lati =$("#current_lati").val();
	var long=$("#current_long").val();
     jQuery.ajax({url: "<?php echo Configure::read('SITE_URL') ?>/search/latest/"+zip+"?lati="+lati+"&long="+long, success: function(result){

									//jQuery("#spinner").hide();



jQuery("#latest").html(result);

    }});
});
</script>