<div class="page_title_bar">
<div class="wrapper">
<h1>Reserved User</h1>
</div>
</div>
<div class="message-upper">
<?php
echo $this->Session->flash();

if($data1[0]['users']['provider_req']==1 && $data1[0]['users']['role']==1){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Your child care home registration has been completed. Please wait for admin approval. </p>
<?php }
else if($data1[0]['users']['provider_req']==3 && $data1[0]['users']['role']==1){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Your child care Profile is Rejected, Please contact to Admin. </p>
<?php } 
else if($data1[0]['users']['provider_req']==4 && $data1[0]['users']['role']==1){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Your child care Profile is Deactivated, Please contact to Admin. </p>
<?php } 
?>

</div>


<div class="page_content">
<div class="wrapper afclr">

<div class="login_tab afclr">
<div class="tab_left">
            
<?php echo $this->element('menu'); ?>

</div>
<div class="tab_right">

<div class="title_heading">
<h3>Reserved Users</h3>
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
	
	
	foreach($allUserReserved as $Reserved)
	{?>
		<div class="Request">
        	<div class="col-md-4">
            	<input type="text" disabled id="childname_<?php echo $Reserved['enrolldetails']['id']; ?>" name="childname[]" value="<?php echo $Reserved['enrolldetails']['childname']; ?>">
            </div>
            <div class="col-md-4">
            	<input type="text" disabled id="age_<?php echo $Reserved['enrolldetails']['id']; ?>" name="age[]" value="<?php echo $Reserved['enrolldetails']['age']; ?>">
            </div>
            <div class="col-md-4">
            	<input type="text" disabled id="gender_<?php echo $Reserved['enrolldetails']['id']; ?>" name="gender[]" value="<?php if(strcmp($Reserved['enrolldetails']['gender'],'M')==0) { echo "Male";} else { echo "Female";} ?>">
            </div>
            <div class="col-md-4">
            	<input type="text" disabled id="startdate_<?php echo $Reserved['enrolldetails']['id']; ?>" name="startdate[]" value="<?php echo $Reserved['enrolldetails']['startdate']; ?>">
            </div>
            <div class="col-md-4">
            	<input type="text" disabled id="paymentType_<?php echo $Reserved['enrolldetails']['id']; ?>" name="paymentType[]" value="<?php if(strcmp($Reserved['enrolldetails']['paymentfrequency'],'M')==0) { echo "Monthly"; }else { echo "Daily";} ?>">
            </div>
            <div class="col-md-4">
            	<input type="text" class="amount" <?php if($Reserved['enrolldetails']['status']==1 || $Reserved['enrolldetails']['status']==2) { echo "disabled"; } ?> id="amount_<?php echo $Reserved['enrolldetails']['id']; ?>" name="amount[]" placeholder="amount" value="<?php echo $Reserved['enrolldetails']['amount']; ?>">
            </div>
           
             <div class="col-md-4">
             
             
             <?php if($Reserved['enrolldetails']['status']==1 || $Reserved['enrolldetails']['status']==2)
			 {
				 echo "Request Accepted";
			 }
			 else {?>
            	<select id="acceptOrReject<?php echo $Reserved['enrolldetails']['id']; ?>" reserve_id="<?php echo $Reserved['enrolldetails']['id']; ?>" class="acceptorreject" name="acceptOrReject[]" action="<?php echo Router::url('/', true); ?>users/reserveRequestAction">
                	<option value="">Accept / Reject</option>
                    <option value="1">Accept</option>
                    <option value="2">Reject</option>
                </select>
                <?php } ?>
            </div>
            
        </div>
        <div class="clr">
            </div>
	<?php }?>
</div>

<?php 	
	
	/*?>

<table style="width:100%;">
<tr>
<td>#</td>
<td>Customer Name</td>
<td>Avg. Rating</td>
<td>Status</td>
<td>Seats</td>
<td>Action</td>
</tr>

<?php $i1=1;  foreach($data as $users){ ?>
<tr>
<td data-th="S.No."><?=$i1;?></td>
<td data-th="Customer Name"><?=$this->Common->getUserName($users['reserve']['user']); ?></td>
<td data-th="Avg Rating"> <?php $per=($this->Common->getUserRating($users['reserve']['user'])*100)/5?>
<div class="ratings">
  <div class="empty-stars"></div>
  <div class="full-stars" style="width:<?=$per?>%"></div>
</div>
</td>

<td data-th="Status"><?php if($users['reserve']['status']=='1')echo '<span class="pay_btn">Active</span>';else echo '<span class="due_btn">Inactive</span>';?></td>

<td data-th="Seats">  <a class="fancybox" href="#pop<?=$i1;?>"><i class="fa fa-users"></i></a></td>

<td data-th="Action">
<?php if($users['reserve']['status']=='0'){?><a href="<?=Configure::read('SITE_URL')?>users/reserveChangestatus/<?=$users['reserve']['user']?>" title="Active"><i class="fa fa-check" aria-hidden="true"></i></a><span>/<?php }?></span>
					<a href="<?=Configure::read('SITE_URL')?>users/reserveDelete/<?=$users['reserve']['user']?>" title="Edit"><i class="fa fa-trash" aria-hidden="true"></i></a><span></span><a target="_blank" href="<?=Configure::read('SITE_URL')?>users/detail/<?=$users['reserve']['user']?>" title="View">
                   <i class="fa fa-eye"></i></a> 
                   
                   
                 

                   
  <div id="pop<?=$i1;?>" style="width:230px;display: none;" class="">
<table id="customFields" class="reserve_table seat_details" >
<tbody>
<tr>
<td style="font-size: 18px;
    font-weight: 600;
    border-bottom: 1px solid #ccc;">Age Group</td>
<td style="font-size: 18px;
    font-weight: 600;
    border-bottom: 1px solid #ccc;">Seat</td>
</tr>
<?php $array_seat=explode(',',$users['reserve']['seatname']);
$array_seatval=explode(',',$users['reserve']['seatvalue']);
for($j=0;$j<sizeof($array_seatval);$j++){
	if($array_seatval[$j]>0){
?>


<tr><td data-th="Day" style="font-size: 18px;
    font-weight: 600;
    border-bottom: 1px solid #ccc;">
<?=$array_seat[$j]?></td>

<td style="font-size: 18px;
    font-weight: 600;
    border-bottom: 1px solid #ccc;"><?=$array_seatval[$j]?></td></tr>
<?php } }?>

</tbody></table>


</div>         </td>      
                   
                   
                   
</tr>
<?php $i1++; } ?>
</table>
<?php */}?>
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