<?php 

foreach($providers as $data){?>

<?php
//$miles = $this->Common->distance($data['User']['lat'],$data['User']['long'],@$this->request->query['lati'],@$this->request->query['long'],"N");



$miles1= sqrt(pow(69.1 * ( $data['users']['lat']-$this->request->query['lati']), 2) +pow(69.1 * ($this->request->query['long'] -$data['users']['long']) * cos($data['users']['lat'] / 57.3), 2)) ;
$img=$this->Common->featuredImages($data['users']['id']);

?>
<div class="search_cont_outer">

<div class="search_content search_content_home">
<a href="<?php echo Configure::read('SITE_URL') ?>search/detail/<?=$data['users']['id']?>" class="afclr">
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
<div class="search_address afclr"><div class="icon_search_d"><i class="la la-map-marker"></i></div><div class="text_search_d"> 
  <div class="pv_name"><b><?=$data['users']['name']?></b></div>
  <div class="pv_addr">
  <?=$data['users']['address']?>, <?=$this->Common->stateName($data['users']['state'])?>-<?=$data['users']['zip']?>
  </div>
  </div>
  </div>
<div class="search_time afclr">

<?php if($data['users']['fullday']=='1'){?>
<div class="afclr">
<div class="icon_search_d"><i class="la la-calendar-check-o"></i></div><div class="text_search_d">Monday – Friday</div></div><div class="afclr"><div class="icon_search_d"><i class="la la-clock-o"></i></div><div class="text_search_d"><?php echo date("g:i a", strtotime($data['users']['fulldaytime_from'])); ?> – <?php echo date("g:i a", strtotime($data['users']['fulldaytime_to'])); ?></div></div>
<?php }
else{	?>
	<div class="afclr"><div class="icon_search_d"><i class="la la-calendar-check-o"></i></div><div class="text_search_d">Monday – Friday</div></div><div class="afclr"><div class="icon_search_d"><i class="la la-clock-o"></i></div><div class="text_search_d"><?php echo date("g:i a", strtotime($data['users']['halfdaytime_from'])); ?> – <?php echo date("g:i a", strtotime($data['users']['halfdaytime_from'])); ?></div></div>


	<?php
	}
?>
</div>
<?php if(!empty($this->request->query['lati']) && !empty($this->request->query['long'])) { ?>

<div class="search_distance afclr"><div class="icon_search_d"><i class="la la-globe"></i></div><div class="text_search_d"><?=number_format($miles1,2)?> Miles</div></div> 
<?php } ?>
<div class="search_rating afclr">
<div class="icon_search_d"><i class="la la-thumbs-o-up"></i></div><div class="text_search_d">
<div class="ratings">
<div class="empty-stars"></div>
  <?php $per=($data['users']['rating']*100)/5?>
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

<?php /*
<script src="<?php echo Configure::read('SITE_URL') ?>js/jquery.images-rotation.js"></script> 

<script>
      $('.images-rotation').imagesRotation();
   </script> 
*/ ?>