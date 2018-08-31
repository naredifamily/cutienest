<div class="page_title_bar">
<div class="wrapper">
<h1>Reserved User</h1>
</div>
</div>
<div class="message-upper">
<?php
echo $this->Session->flash();

if($data1[0]['users']['provider_req']==1){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Your child care home registration has been completed. Please wait for admin approval. </p>
<?php }
else if($data1[0]['users']['provider_req']==3){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Your child care Profile is Rejected, Please contact to Admin. </p>
<?php } 
else if($data1[0]['users']['provider_req']==4){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Your child care Profile is Deactivated, Please contact to Admin. </p>
<?php } 
?>

</div>


<div class="page_content">
<div class="wrapper afclr">

<div class="login_tab afclr">
<div class="tab_left">
            
<?php echo $this->element('menu-provider'); ?>

</div>
<div class="tab_right reserve_info_request">

<div class="title_heading title_heading_reserrve">
<h3>Enrollment requests</h3>
</div>

<div class="invoice_list">
<?php if(!sizeof($allUserReserved)){?>
<div class="custom_pagination no-recod-found">
No Record Found
</div>
<?php }else{
?>
<div class="allRequest">
	<?php 
	$providerName=array();
	$providerpending=array();
	foreach($allUserReserved as $Reserved)
	{
		?>
       
        <?php
			if(!in_array($Reserved['enrolldetails']['status'],$providerpending))
			{
				$providerName=array();
				array_push($providerpending,$Reserved['enrolldetails']['status']);
				if($Reserved['enrolldetails']['status']==0)
				{?>
                 
					<h2>Pending</h2>
                   
				<?php }
				else if($Reserved['enrolldetails']['status']==1)
				{?>
					<h2>Accepted Requests</h2>
				<?php }
				else 
				{?>
					<h2>Reject Requests</h2>
				<?php }?>
                <hr>
                <?php
			}
		 ?>
         <?php if(!in_array($Reserved['users']['name'],$providerName))
			{
				array_push($providerName,$Reserved['users']['name']);
			?>
        	<h3>
            	<?=$Reserved['users']['name']?>  
            </h3>
        <?php } ?>
        
		<div class="Request">
        
          <?php $startdate=strtotime($Reserved['enrolldetails']['startdate']);
		  $startdate=date('m-d-Y',$startdate);
		  $enddate=strtotime($Reserved['enrolldetails']['enddate']);
		  $enddate=date('m-d-Y',$enddate);
		  ?>
        	<div class="col-md-4">
            <label>Kid's First Name </label>	<input type="text" disabled id="childname_<?php echo $Reserved['enrolldetails']['id']; ?>" name="childname[]" value="<?php echo $Reserved['enrolldetails']['childname']; ?>">
            </div>
            <div class="col-md-4">
            <label>Kid's Last Name </label>	<input type="text" disabled id="lastname_<?php echo $Reserved['enrolldetails']['id']; ?>" name="lastname[]" value="<?php echo $Reserved['enrolldetails']['lastname']; ?>">
            </div>
            <div class="col-md-4">
            <label>Age group </label>	<input type="text" disabled id="age_<?php echo $Reserved['enrolldetails']['id']; ?>" name="age[]" value="<?php echo $Reserved['enrolldetails']['age']; ?>">
            </div>
            <div class="col-md-4">
          <label>Gender </label>   	<input type="text" disabled id="gender_<?php echo $Reserved['enrolldetails']['id']; ?>" name="gender[]" value="<?php if(strcmp($Reserved['enrolldetails']['gender'],'M')==0) { echo "Male";} else { echo "Female";} ?>">
            </div>
            <div class="col-md-4">
            <label>Start date </label>	<input type="text" disabled id="startdate_<?php echo $Reserved['enrolldetails']['id']; ?>" name="startdate[]" value="<?php echo $startdate; ?>">
            </div>
            <div class="col-md-4">
           <label>End date </label> 	<input type="text" disabled id="enddate_<?php echo $Reserved['enrolldetails']['id']; ?>" name="enddate[]" value="<?php if(strcmp('0000-00-00',$Reserved['enrolldetails']['enddate'])==0){ echo "N/A";}else { echo $enddate; } ?>">
            </div>
            <div class="col-md-4">
             <label> Payment </label>	<input type="text" disabled id="paymentType_<?php echo $Reserved['enrolldetails']['id']; ?>" name="paymentType[]" value="<?php if(strcmp($Reserved['enrolldetails']['paymentfrequency'],'M')==0) { echo "Monthly"; }else if(strcmp($Reserved['enrolldetails']['paymentfrequency'],'D')==0)  { echo "Daily";} else { echo "Weekly";} ?>">
            </div>
            <div class="col-md-4">
           <label> Amount  </label> 	<input type="text" class="amount" <?php if($Reserved['enrolldetails']['status']==1 || $Reserved['enrolldetails']['status']==2) { echo "disabled"; } ?> id="amount_<?php echo $Reserved['enrolldetails']['id']; ?>" name="amount[]" placeholder="amount" value="<?php echo $Reserved['enrolldetails']['amount']; ?>">
            </div>
           
             <div class="col-md-4">
             
             
            <?php if($Reserved['enrolldetails']['status']!=0)
			 {
				 echo "<label> Status  </label>";
				 echo "<span class='req_acpt_status'>Request Accepted</span>";
				 if($this->Common->isLoggedIn()&&$this->Common->hasUserProvider($Reserved['enrollachilds']['provider_id'])&&(!$this->Common->isReviewsByProvider($Reserved['enrollachilds']['user_id'],CakeSession::read('Auth.User.id'))))
				 {
				 ?>
             		<a href="<?=Configure::read('SITE_URL')?>providers/detail/<?=$Reserved['enrollachilds']['user_id']?>" title="Active" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
             <?php }
				 
			 }
			 else {?>
             <label> Status  </label><select id="acceptOrReject<?php echo $Reserved['enrolldetails']['id']; ?>" reserve_id="<?php echo $Reserved['enrolldetails']['id']; ?>" class="acceptorreject" name="acceptOrReject[]" action="<?php echo Router::url('/', true); ?>providers/reserveRequestAction">
                	<option value="0">Accept / Reject</option>
                    <option value="1">Accept</option>
                    <option value="2">Reject</option>
                </select>
                <?php } ?>
            </div>
            <div class="clr"></div>
        </div>
      
	<?php }?>
</div>

<?php }?>
</div>

<script>
$(document).ready(function () {
    
    // This will automatically grab the 'title' attribute and replace
    // the regular browser tooltips for all <a> elements with a title attribute!
    $('a[title]').qtip();
    
});
</script>

</div>
</div>
</div>
</div>