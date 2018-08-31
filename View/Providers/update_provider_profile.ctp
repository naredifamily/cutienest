<?php if(isset($user['User']['stage'])&&$user['User']['stage']!='0'){?>
<style>
.licnoout, .helplic{display:block;}
</style>
<?php }?>
<?php ?>
    <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyAIO1XW64S8s6KwynRkZYdgNZeVYIwdqgA'></script>
    <script src="<?=Configure::read('SITE_URL')?>js/locationpicker.jquery.js"></script>
<?php $states=$this->Common->getState();?>
<div class="page_title_bar">
<div class="wrapper">
<h1>Update Profile</h1>
</div>
</div>
<div class="message-upper">
<?php
echo $this->Session->flash();
if($user['User']['provider_req']==1){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Your child care home registration has been completed. Please wait for admin approval. </p>
<?php }
else if($user['User']['provider_req']==3){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Your child care Profile is Rejected, Please contact to Admin. </p>
<?php } 
else if($user['User']['provider_req']==4){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Your child care Profile is Deactivated, Please contact to Admin. </p>
<?php } 
?>
</div>
<div class="page_content">
<div class="wrapper afclr"><div class="create_invoice_btn" style="padding-left:27px;">
<a href="<?=Configure::read('SITE_URL')?>providers/viewMyProfile" ><i class="fa fa-reply" aria-hidden="true"></i>Return To Dashboard</a>
</div>
<div class="register_form">
<h2>Update Profile</h2>
<div class="register_form_inner">
<?php $states=$this->Common->getState();?>
 <?php echo $this->Form->create('User'); ?>
 <p><?php echo $this->Form->input('id', ['type' => 'hidden','value'=>$this->Common->loginUserId(),'label' => false]); ?></p>

<label class='label-class'>Full Name<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('name', ['required' => true,'placeholder' => 'Name','value'=>@$user['User']['name'], 'label' => false,'class'=>'input-class']); ?>

<label class='label-class'>Phone<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('phone', ['required' => true, 'placeholder' => 'Phone','value'=>@$user['User']['phone'], 'label' => false,'class'=>'input-class']); ?>

<label class='label-class'>Email<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('email', ['readonly'=>true,'required' => true,'value'=>@$user['User']['email'], 'placeholder' => 'Email', 'label' => false,'class'=>'input-class']); ?>

<label class='label-class'>Address<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('address', ['type'=>'text','required' => true,'placeholder' => 'Address','value'=>@$user['User']['address'],'id'=>'searchTextField' ,'label' => false,'class'=>'input-class']); ?>

<label class='label-class'>State<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->select('state',$states, ['empty' => 'Select State', 'class' => '','default'=>@$user['User']['state'], 'required' => true,'class'=>'select-class']); ?>

<label class='label-class'>Zipcode<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('zip', ['required' => true, 'placeholder' => 'Zipcode','value'=>@$user['User']['zip'], 'label' => false,'class'=>'input-class']); ?>

<?php echo $this->Form->select('yard', array('Yes' => 'Yes','No' => 'No'), ['style' => 'display:none;','empty' => '--Yard--', 'default' => @$user['User']['yard']]); ?>
<?php echo $this->Form->input('lat', ['style' => 'display:none;','placeholder' => 'Latitude','value'=>@$user['User']['lat'], 'class' => 'MapLat', 'label' => false]); ?>
<?php echo $this->Form->input('long', ['style' => 'display:none;', 'placeholder' => 'Longitude','value'=>@$user['User']['long'], 'class' => 'MapLon', 'label' => false]); ?>

<label class='label-class'>Stage<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->select('stage', array('Working for license','Have license','In business'), ['empty' => 'Select Stage','required' => true, 'default' => @$user['User']['stage'],'class' => 'select-class', 'required' => true]); ?>

<div class="licnoout">
<label class='label-class'>Licence Number</label>
<?php echo $this->Form->input('licenceno', ['required' => false,'placeholder' => 'Licence Number','value' => @$user['User']['licenceno'] ,'class' => 'licno', 'label' => false]); ?>
</div>


<p <?php if($user['User']['stage']=='0'){?> style="display:block;" <?php } else{?> style="display:none;" <?php }?> class="helplic"><?php echo $this->Form->select('helplicence', array('Yes','No'), ['empty' => 'Need Help For Licence','value' => @$user['User']['helplicence']]); ?></p>

<label class='label-class'>EIN.</label>
<?php echo $this->Form->input('ein', ['required' => true, 'placeholder' => 'EIN','value'=>@$user['User']['ein'], 'label' => false,'class'=>'input-class']); ?>

<?php echo $this->Form->input('SUBMIT', ['type' => 'submit','label' => false]); ?>
                           
<?php echo $this->Form->end(); ?>
</div>
</div>
<div class="register_with_section maparea">
<h3>Select Latitude and longitude form map or insert manually</h3>
<div class="rwith">
   <div id="us5" style="width: 573px; height: 500px;"></div>
</div>
</div>
</div>
</div>
 
  <script>
                        function updateControls(addressComponents) {
                                                     
                           
                           
                           
                        }
                        $('#us5').locationpicker({
                            location: {
                                latitude: <?=!empty($user['User']['lat'])?$user['User']['lat']:'42.13954232554'?>,
                                longitude: <?=!empty($user['User']['long'])?$user['User']['long']:'-73.82480799999996'?>
                            },
                            radius: 0,
							inputBinding: {
                                latitudeInput: $('#UserLat'),
                                longitudeInput: $('#UserLong'),
                                locationNameInput: $('#searchTextField')
                               
                            },
                             enableAutocomplete: true,
                            onchanged: function (currentLocation, radius, isMarkerDropped) {
                                var addressComponents = $(this).locationpicker('map').location.addressComponents;
                                updateControls(addressComponents);
                            },
                            oninitialized: function (component) {
                                var addressComponents = $(component).locationpicker('map').location.addressComponents;
                                updateControls(addressComponents);
                            }
                        });
                    </script>
                    <script>
$=jQuery;
$("#UserStage").change(function() {
    if ($(this).val() == 0) {
    $(".helplic").slideDown(200);
	$(".licnoout").hide();
    } 
	else if ($(this).val() == 1 || $(this).val() == 2)  {
    $(".licnoout").slideDown(200);
	$(".helplic").hide();
    } else if($(this).val()===""){
	
	$(".helplic").hide();	
	$(".licnoout").hide();
	}
});
</script>