<script>

$(document).ready(function(){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showLocation);
    } else { 
        $('#location').html('Geolocation is not supported by this browser.');
    }
});

function showLocation(position) {
	
    var latitude = position.coords.latitude;
	var longitude = position.coords.longitude;
    
	$("#lati").val(latitude);
	$("#long").val(longitude);
	          $.ajax({
                    type:'POST',
                    url:'https://maps.googleapis.com/maps/api/geocode/json?latlng='+latitude+','+longitude+'&sensor=false&key=AIzaSyAIO1XW64S8s6KwynRkZYdgNZeVYIwdqgA',
                    data:{},
                    success:function(address){
                        if(address){
                          processJSON(address);
                        }else{
                           
                        }
                    }
                });
	

  function processJSON(json) {
   //$("#postal_code").val(json.results[0].address_components[8].long_name);
 
  }
}
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  
  <script src="<?php echo Configure::read('SITE_URL') ?>js/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker();
  } );
  
  
  </script>
  
 <?php if(!empty($this->request->query['zip'])){
$coordinates=getLatLong($this->request->query['zip']);
$lati=$coordinates['Latitude'];
$long=$coordinates['Longitude'];
} 
else{
$coordinates=getLatLong('94583');
$lati=$coordinates['Latitude'];
$long=$coordinates['Longitude'];
}

function getLatLong($code){
	$mapsApiKey = 'AIzaSyDIPQrevDYVkTIYt88K-MRBjxSQO7ftcEY';
	$query = "https://maps.googleapis.com/maps/api/geocode/json?address='.$code.'&sensor=false&key=".$mapsApiKey;
	$coordinates = file_get_contents($query);
	$coordinates = json_decode($coordinates);
	if($coordinates->status == 'OK'){
	$lat = $coordinates->results[0]->geometry->location->lat;
	$long = $coordinates->results[0]->geometry->location->lng;
	return array('Latitude'=>$lat,'Longitude'=>$long);
	}
	else{
	return false;
	}
}

?> 
<div class="wrapper">

<div class="_refine_icon"><a href="javascript:void(0)"><i class="fa fa-filter"></i> Refine Search</a></div>
</div>
<div class="page_title_bar _refine_search">
<div class="wrapper">
<div class="search_form afclr">
<form class="afclr">
<?php //pr($this->request->query);?>
<div class="field_one"><input type="text" name="zip" placeholder="Zip" value="<?=@$this->request->query['zip']?>"></div>
<input type="hidden" name="lati" id="lati" value="">
<input type="hidden" name="long" id="long" value="">
<div class="field_one"><select name="agegroup"  >
<option <?php if(empty($this->request->query['agegroup'])){?> selected <?php }?> value="">Select Age Group</option>

<option <?php if(@$this->request->query['agegroup']=='0-2'){?> selected <?php }?> value="0-2">0-2</option>
<option <?php if(@$this->request->query['agegroup']=='2-4'){?> selected <?php }?> value="2-4">2-4</option>
<option <?php if(@$this->request->query['agegroup']=='4-5'){?> selected <?php }?> value="4-5">4-5</option>
<option <?php if(@$this->request->query['agegroup']=='Afterschool'){?> selected <?php }?> value="Afterschool">Afterschool</option>
</select></div>
<div class="field_one">

<!--<select name="daytype"  >
<option <?php if(empty($this->request->query['daytype'])){?> selected <?php }?> value="">Full day/Half Day</option>

<option <?php if(@$this->request->query['daytype']=='F'){?> selected <?php }?> value="F">Full Day</option>
<option <?php if(@$this->request->query['daytype']=='H'){?> selected <?php }?> value="H">Half day</option>
</select>-->
<input type="text" name="from" placeholder="From"  value="<?=@$this->request->query['from']?>" class="datepicker">


</div>

<div class="field_one">
<input type="text" name="to" placeholder="To" value="<?=@$this->request->query['to']?>" class="datepicker">

</div>
<div class="field_one"><button type="submit" name="search"><i class="fa fa-search" aria-hidden="true"></i>Search</button></div>
</form>
</div>
</div>
</div>
<script>
  $('._refine_icon a').click(function(){
    var _refine_search = $('._refine_search');
    _refine_search.slideToggle(140, function(){_refine_search.removeAttr('style');_refine_search.toggleClass('_active')});
  })

</script>
<div class="message-upper">
<?php
echo $this->Session->flash();
?>
</div>
<div class="page_content">
<div class="wrapper afclr">
<div class="search_bottom_form">
<div style="display: none;" class="form_in afclr">
<form class="afclr">

<div class="field_s_one miles_sort"><label><img src="<?php echo Configure::read('SITE_URL') ?>images/distance_icon.png" alt=""></label>




<select onchange="window.location = jQuery('#sorDistance option:selected').val();" id="sorDistance" name="distance">
<option>Miles Away</option>
<option <?php if((@$this->request->query['dir']=='asc')&&(@$this->request->query['sort']=='distance')){?> selected="selected" <?php }?>
 value="<?php echo Configure::read('SITE_URL').'search' ?>?&<?=isset($this->request->query['agegroup'])?'&agegroup='.$this->request->query['agegroup'].'':''?>
<?=isset($this->request->query['zip'])?'&zip='.$this->request->query['zip'].'':''?><?=isset($this->request->query['lati'])?'&lati='.$this->request->query['lati'].'':''?><?=isset($this->request->query['long'])?'&long='.$this->request->query['long'].'':''?>
<?=isset($this->request->query['from'])?'&from='.$this->request->query['from'].'':''?><?=isset($this->request->query['to'])?'&to='.$this->request->query['to'].'':''?>&dir=asc&sort=distance">Nearest First</option>

<option <?php if((@$this->request->query['dir']=='desc')&&(@$this->request->query['sort']=='distance')){?> selected="selected" <?php }?>

value="<?php echo Configure::read('SITE_URL').'search' ?>?&<?=isset($this->request->query['agegroup'])?'&agegroup='.$this->request->query['agegroup'].'':''?>
<?=isset($this->request->query['zip'])?'&zip='.$this->request->query['zip'].'':''?><?=isset($this->request->query['lati'])?'&lati='.$this->request->query['lati'].'':''?><?=isset($this->request->query['long'])?'&long='.$this->request->query['long'].'':''?>
<?=isset($this->request->query['from'])?'&from='.$this->request->query['from'].'':''?><?=isset($this->request->query['to'])?'&to='.$this->request->query['to'].'':''?>&dir=desc&sort=distance"

>Away First</option>
</select>






</div>
<div class="field_s_one rating_sort"><label><img src="<?php echo Configure::read('SITE_URL') ?>images/rating_icon.png" alt=""></label>


<select onchange="window.location = jQuery('#sorRating option:selected').val();" id="sorRating" name="availability">
<option>Rating</option>
<option<?php if((@$this->request->query['dir']=='asc')&&(@$this->request->query['sort']=='rating')){?> selected="selected" <?php }?>
 value="<?php echo Configure::read('SITE_URL').'search' ?>?&<?=isset($this->request->query['agegroup'])?'&agegroup='.$this->request->query['agegroup'].'':''?>
<?=isset($this->request->query['zip'])?'&zip='.$this->request->query['zip'].'':''?><?=isset($this->request->query['lati'])?'&lati='.$this->request->query['lati'].'':''?><?=isset($this->request->query['long'])?'&long='.$this->request->query['long'].'':''?>
<?=isset($this->request->query['from'])?'&from='.$this->request->query['from'].'':''?><?=isset($this->request->query['to'])?'&to='.$this->request->query['to'].'':''?>&dir=asc&sort=rating">Rating: Low to High</option>

<option <?php if((@$this->request->query['dir']=='desc')&&(@$this->request->query['sort']=='rating')){?> selected="selected" <?php }?>

value="<?php echo Configure::read('SITE_URL').'search' ?>?&<?=isset($this->request->query['agegroup'])?'&agegroup='.$this->request->query['agegroup'].'':''?>
<?=isset($this->request->query['zip'])?'&zip='.$this->request->query['zip'].'':''?><?=isset($this->request->query['lati'])?'&lati='.$this->request->query['lati'].'':''?><?=isset($this->request->query['long'])?'&long='.$this->request->query['long'].'':''?>
<?=isset($this->request->query['from'])?'&from='.$this->request->query['from'].'':''?><?=isset($this->request->query['to'])?'&to='.$this->request->query['to'].'':''?>&dir=desc&sort=rating"

>Rating: High to Low</option>
</select> </div>
</form>
</div>
</div>
<div class="search_margin afclr">
<?php 
if(sizeof($providers)>0){
	
foreach($providers as $data){?>

<?php
//$miles = $this->Common->distance($data['User']['lat'],$data['User']['long'],@$this->request->query['lati'],@$this->request->query['long'],"N");



$miles1= sqrt(pow(69.1 * ( $data['User']['lat']-$lati), 2) +pow(69.1 * ($long -$data['User']['long']) * cos($data['User']['lat'] / 57.3), 2)) ;

//$miles1= sqrt(pow(69.1 * ( $data['User']['lat']-@$this->request->query['lati']), 2) +pow(69.1 * (@$this->request->query['long'] -$data['User']['long']) * cos($data['User']['lat'] / 57.3), 2)) ;


$img=$this->Common->featuredImages($data['User']['id']);

?>
<div class="search_cont_outer">

<div class="search_content">
<a href="<?php echo Configure::read('SITE_URL') ?>search/detail/<?=$data['User']['id']?>" class="afclr">
<div class="search_logo">
<?php if(empty($img)){?>
<div class="x_img_c">
<img src="<?php echo Configure::read('SITE_URL') ?>images/no-img.jpg" alt="">
</div>
<?php }else{
	?>
    <div class="images-rotation" data-images='[<?php if(!empty($img[0]['Image']['path'])){?>"<?=Configure::read('SITE_URL').'uploads/gallery/'.$img[0]['Image']['path']?>" <?php }?><?php if(!empty($img[1]['Image']['path'])){?> ,"<?=Configure::read('SITE_URL').'uploads/gallery/'.$img[1]['Image']['path']?>" <?php }?><?php if(!empty($img[2]['Image']['path'])){?>,"<?=Configure::read('SITE_URL').'uploads/gallery/'.$img[2]['Image']['path']?>" <?php }?>]'> 
    
	<div class="x_img_c">    
    <img src="<?=Configure::read('SITE_URL').'uploads/gallery/'.@$img[0]['Image']['path']?>" class="logoimg" alt=""> 
	</div>
</div>

<?php }?>
</div>
<div class="search_o_detail">
<div class="search_address afclr"><div class="icon_search_d"><i class="la la-map-marker"></i></div>
<div class="text_search_d">
	<div class="pv_name">
	<b><?=$data['User']['name']?></b>
	</div>
	<div class="pv_addr">
	<?=$data['User']['address']?>, <?=$this->Common->stateName($data['User']['state'])?>-<?=$data['User']['zip']?>
	</div>

</div></div> 
<div class="search_time afclr">

<?php   if($data['User']['fullday']=='1'){?>
<div class="afclr">
<div class="icon_search_d"><i class="la la-calendar-check-o"></i></div><div class="text_search_d">Monday – Friday</div></div><div class="afclr"><div class="icon_search_d"><i class="la la-clock-o"></i></div><div class="text_search_d"><?php echo date("g:i a", strtotime($data['User']['fulldaytime_from'])); ?> – <?php echo date("g:i a", strtotime($data['User']['fulldaytime_to'])); ?></div></div>
<?php }
else{	?>
	<div class="afclr"><div class="icon_search_d"><i class="la la-calendar-check-o"></i></div><div class="text_search_d">Monday – Friday</div></div><div class="afclr"><div class="icon_search_d"><i class="la la-clock-o"></i></div><div class="text_search_d"><?php echo date("g:i a", strtotime($data['User']['halfdaytime_from'])); ?> – <?php echo date("g:i a", strtotime($data['User']['halfdaytime_from'])); ?></div></div>
	<?php
	 }
?>
</div>
<div class="search_time afclr">
	<div class="icon_search_d"><i class="fa fa-certificate" aria-hidden="true"></i></div><div class="text_search_d"><?php echo $data['User']['licenceno']; ?></div>
</div>
<?php /*
<div class="search_distance afclr"><div class="icon_search_d"><i class="la la-globe"></i></div>
<div class="text_search_d"><?=number_format($miles1,2)?> Miles</div>
</div>*/ ?>
<div class="search_rating afclr">
<div class="icon_search_d"><i class="la la-thumbs-o-up"></i></div><div class="text_search_d">
<div class="ratings">
<div class="empty-stars"></div>
<?php $per=($data['User']['rating']*100)/5?>
<div class="full-stars" style="width:<?=$per?>%"></div>
</div>
</div>
</div>
</div>
</a>

</div>
</div>
<?php }?>
</div>
<div class="clr"></div>

<div class="custom_pagination">
<?php 
	
	
	

	?>
    
 <div class="pagination">
 <?php if($this->Paginator->hasPrev()){?>
                    <?php echo $this->Paginator->prev('«'); ?>
                    <?php }?>
                    <?php echo $this->Paginator->numbers(array('separator' => '')); ?>
                     <?php if($this->Paginator->hasNext()){?>

                    <?php echo $this->Paginator->next('»'); ?>
                    <?php }?>
                </div>
                <?php  ?>
</div>
<?php }
else{
?>
<div class="custom_pagination no-recod-found">

<div class="no_rec_cstm">
<h3>Oops!</h3> 
<p>We are not in your area yet.</p>
<p>Never mind!</p>
<p>Please give some details <a class="xpn_frm" id="xpn_frm" href="javascript:void(0)">here</a> and let us get back to you.</p> 


<div class="cptr_form" style="display: none">

<form name="searchform" id="searchform" action="/pages/searcharea" method="post" class="form_searcharea"> 
		
			<label class='label-class-search'>Name<spam class='spam-class'>*</spam></label>
			<?php echo $this->Form->input('username', ['required' => true,'value'=>@$user['User']['name'], 'label' => false ,'class'=>'input-class-search']); ?>

			<label class='label-class-search'>Email<spam class='spam-class'>*</spam></label>
			<?php echo $this->Form->input('useremail', ['required' => true,'value'=>@$user['User']['email'], 'label' => false,'class'=>'input-class-search']); ?>

			<label class='label-class-search'>Street Address<spam class='spam-class'>*</spam></label>
			<?php echo $this->Form->textarea('useraddress', ['required' => true,'value'=>@$user['User']['address'], 'label' => false,'class'=>'input-class-search']); ?>
			
			<label class='label-class-search'>City<spam class='spam-class'>*</spam></label>
			<?php echo $this->Form->textarea('usercity', ['required' => true,'value'=>@$user['User']['address'], 'label' => false,'class'=>'input-class-search']); ?>
			
			<label class='label-class-search'>Zip<spam class='spam-class'>*</spam></label>
			<?php echo $this->Form->input('userzip', ['required' => true, 'label' => false,'class'=>'input-class-search','onblur'=>'myFunction1()','maxlength'=>"5",'onkeypress'=>'return isNumberKey1(event)']); ?>

			
			<label class='label-class-search'>Phone</label>
			<?php echo $this->Form->input('userphone', ['label' => false,'class'=>'input-class-search','onblur'=>'myFunction1()','maxlength'=>"10",'onkeypress'=>'return isNumberKey1(event)']); ?>
			<div id="ageschildren">
			<label class='label-class-search'>Ages of children</label>
			<span><input type="text" name="userages[]" class="input-class-search" style="float:  left;width: 95%;margin-right: 5px;">
			<a href="javascript:void(0);" class="remCF1"><i class="fa fa-minus-circle" aria-hidden="true" style="float:left;margin-top:8px;"></i></a></span>
			</div>
			
			
			<div class="add_row_btn1" style="padding-left:  434px;margin-left: -10px;margin-right: 10px;">
				<a href="javascript:void(0);" class="addCF1">Add Row</a>
			</div>
			
			<label class='label-class-search'>Start Date</label>
			<input type="text" name="start_date"  value="" class="datepicker input-class-search">

			
			<label class='label-class-search'>Any other requirement that you want us to know<spam class='spam-class'>*</spam></label>
			<?php echo $this->Form->textarea('usermessage', ['required' => true,'value'=>@$user['User']['message'], 'label' => false,'class'=>'input-class-search']); ?>
			
			
			<div class="submit_feedback">
			<?php echo $this->Form->input('SUBMIT', ['type' => 'submit','label' => false]); ?>
			</div>
				</form>





</div>
<script type="text/javascript">
  $('#xpn_frm').click(function(){
      $('.cptr_form').slideDown(200);
  })

  $('.btn-n').click(function(e){
    e.preventDefault();
  })
  
  function myFunction() {
    var phone_val = $("#UserPhone").val();

var new_phone = phone_val.replace(/[^\d]+/g, '')
     .replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
$("#UserPhone").val(new_phone);

}
</script>

<script>
$(document).ready(function(){
	$(".addCF1").click(function(){
		$("#ageschildren").append('<span><input type="text" name="userages[]" class="input-class-search" style="float:left;width:95%;margin-right:5px;"><a href="javascript:void(0);" class="remCF1"><i class="fa fa-minus-circle" aria-hidden="true" style="float:left;margin-top:8px;"></i></a></span>');	});
    $("#ageschildren").on('click','.remCF1',function(){
        $(this).parent("span").remove();
    });
});</script>

</div>
</div>
<?php }?>

</div>
</div>
<?php /*
<script src="<?php echo Configure::read('SITE_URL') ?>js/jquery.images-rotation.js"></script> 

<script>
      $('.images-rotation').imagesRotation();
   </script>  
*/ ?>



   </div>