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
if($data1[0]['users']['state_id']=='' && $data1[0]['users']['role']==2){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Please provide your DL/ State-issued ID.Click <a href="<?php echo Configure::read('SITE_URL').'users/updateUserProfile'; ?>" style="color:blue; font-style: italic;text-decoration: underline;">here </a> </p>
<?php } ?>

</div>


<div class="page_content">
<div class="wrapper afclr">

<div class="login_tab afclr">
<div class="tab_left">
            
<?php echo $this->element('menu'); ?>

</div>
<div class="tab_right">

<div class="title_heading">
<h3>Reserved Providers</h3>
</div>

<div class="invoice_list">
<?php if(!sizeof($enrollachilds)){?>
<div class="custom_pagination no-recod-found">
No Record Found
</div>
<?php }else{
	?>
	<table style="width:100%">
    
	<?php
	$providerName=array();
foreach($enrollachilds as $child)
{?>
	<?php if(!in_array($child['users']['name'],$providerName))
	{
		array_push($providerName,$child['users']['name']);
		?>
		<tr>
        	<td colspan="2"><strong>Provider Name : </strong></td>
        	<td colspan="6"><strong><?php echo $child['users']['name']; ?></strong></td>
        </tr>
	<?php }?>
	<tr>
    	<td><?php echo $child['enrolldetails']['childname']; ?></td>
        <td><?php echo $child['enrolldetails']['age']; ?></td>
        <td><?php if(strcmp($child['enrolldetails']['gender'],'M')==0)
			echo "Male";
		else 
			echo "Female";
		?></td>
        <td><?php echo $child['enrolldetails']['startdate']; ?></td>
        <td><?php if(strcmp($child['enrolldetails']['enddate'],'0000-00-00')==0)
			echo "N/A";
		else 
			echo $child['enrolldetails']['enddate'];
		?></td>
        <td><?php if(strcmp($child['enrolldetails']['paymentfrequency'],'M')==0)
		 		echo "Monthly";
		 else if(strcmp($child['enrolldetails']['paymentfrequency'],'W')==0)
		 		echo "Weekly";
		 else 
		 		echo "Daily"; ?></td>
        <td><?php if($child['enrolldetails']['status']==0)
				echo "Pending";
			else  if($child['enrolldetails']['status']==1)
				echo "Accepted";
			else 
				echo "Rejected";
				 ?></td>
        <td><?php echo $child['enrolldetails']['amount']; ?></td>
    </tr>
<?php }?>
	</table>
<?php	
	}?>
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