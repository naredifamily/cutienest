<?php ?>


<div class="page_title_bar">
<div class="wrapper">
<h1>REGISTER FOR CHILD CARE HOME</h1>
</div>
</div>
<div class="message-upper">
<?php
echo $this->Session->flash();
?>
</div>
<div class="page_content">
<div class="wrapper afclr">
<div class="register_form">
<h2>Sign-up as a provider</h2>
<div class="register_form_inner">
<?php $states=$this->Common->getState();?>
 <?php echo $this->Form->create('User',array('enctype'=>'multipart/form-data')); ?>
 <?php if(!empty($this->Common->loginUserId())){?>
 <p><?php echo $this->Form->input('id', ['type' => 'hidden','value'=>$this->Common->loginUserId(),'label' => false]); ?></p>
<?php }?>

<label class='label-class'>Full Name<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('name', ['required' => true,'value'=>@$user['User']['name'], 'label' => false ,'class'=>'input-class','autocomplete' => 'off']); ?>

<label class='label-class'>Phone<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('phone', ['required' => true, 'label' => false,'class'=>'input-class','onblur'=>'myFunction()','maxlength'=>"10",'onkeypress'=>'return isNumberKey(event)','autocomplete' => 'off']); ?>

<?php if(!empty($this->Common->loginUserId())){?>

<label class='label-class'>Email<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('email', ['readonly'=>true,'required' => true,'value'=>@$user['User']['email'], 'label' => false,'class'=>'input-class','autocomplete' => 'off']); ?>

 <?php }else{?>
<label class='label-class'>Email<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('email', ['required' => true,'value'=>@$user['User']['email'], 'label' => false,'class'=>'input-class','autocomplete' => 'off']); ?>
 
 <?php }?>
 <?php if(empty($this->Common->loginUserId())){?>
 
<label class='label-class'>Password<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('password', ['required' => true, 'label' => false,'class'=>'input-class']); ?>

<label class='label-class'>Confirm Password<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('password_confirm', ['required' => true,'type'=>'password', 'label' => false,'class'=>'input-class','autocomplete' => 'off']); ?>
<?php }?>

<label class='label-class'>Address<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('address', ['type'=>'text','autocomplete'=>'off','required' => true,'label' => false,'class'=>'input-class']); ?>


<label class='label-class'>State<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->select('state',$states, ['empty' => 'Select State...', 'class' => '', 'required' => true,'class'=>'select-class']); ?>

<label class='label-class'>Zipcode<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('zip', ['required' => true,'id'=>'postal_code' ,'label' => false,'class'=>'input-class','maxlength'=>"5",'onkeypress'=>'return isNumberKey(event)','autocomplete' => 'off']); ?>


<?php /*<p><?php echo $this->Form->select('yard', array('Yes' => 'Yes','No' => 'No'), ['empty' => '--Yard--']); ?></p> */ ?>
<label class='label-class'  style="display:none;">Latitude</label>
<?php echo $this->Form->input('lat', ['style' => 'display:none;', 'class' => 'MapLat input-class', 'label' => false]); ?>

<label class='label-class'  style="display:none;">Longitude</label>
<?php echo $this->Form->input('long', ['style' => 'display:none;', 'class' => 'MapLon input-class', 'label' => false]); ?>

<label class='label-class' >Select Stage<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->select('stage', array('Need help to get license?','Just got license','Already in business'), ['empty' => 'Select Stage...','required' => true, 'required' => true,'class'=>'select-class']); ?>

<div class="licnooutIn">
    <div class="input text">
	<label class='label-class' >Years in Business<spam class='spam-class'>*</spam></label>
        <?php echo $this->Form->input('howmanyyears', ['type'=>'text', 'class' => 'licno', 'label' => false,'onkeypress'=>'return isNumberKey(event)','maxlength'=>"3"]); ?>
    </div>
    </div>
<div class="licnoout" >
<label class='label-class' >Licence Number<spam class='spam-class'>*</spam></label>
<?php echo $this->Form->input('licenceno', [ 'class' => 'licno', 'label' => false,'onkeypress'=>'return isNumberKey(event)','maxlength'=>"9"]); ?></div>
<div class="licnoout" >
    <div class="input text">
        <p style="margin-bottom: 2px">Upload your license<spam class='spam-class'>*</spam></p>
        <?php echo $this->Form->file('image', ['class'=>'licno','id'=>'fileField1','placeholder' => 'License picture', 'label' => 'none','accept'=>'image/*']); ?>
    </div>
</div>



<label class='label-class' style="display:none;">Yes/No</label>

<?php echo $this->Form->select('helplicence', array('Yes','No'), ['empty' => 'Select...','style' =>'display:  none;','class'=>'input-class']); ?>


<?php echo $this->Form->input('SUBMIT', ['type' => 'submit','label' => false]); ?>
                           
<?php echo $this->Form->end(); ?>
</div>
</div>
<div class="register_with_section maparea">
<h3>Select location on map or insert manually.</h3>
<div class="rwith">
 <div id="us5" style="height: 350px;width: 100%;margin: 0.6em;"></div>
</div>
</div>
</div>
</div>
<script src="https://maps.google.com/maps/api/js?libraries=places&region=uk&language=en&sensor=false&key=AIzaSyAIO1XW64S8s6KwynRkZYdgNZeVYIwdqgA"></script>
    <script src="<?=Configure::read('SITE_URL')?>js/locationpicker.jquery.js"></script>

 <script>


  function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }





                        function updateControls(addressComponents) {
                                                     
                           
                            $('#UserZip').val(addressComponents.postalCode);
                           
                        }
                        $('#us5').locationpicker({
                            location: {
                                     latitude: $("#current_lati").val(),
                                longitude: $("#current_long").val()
                            },
                            radius: 0,
							zoom: 10,
							inputBinding: {
                                latitudeInput: $('#UserLat'),
                                longitudeInput: $('#UserLong'),
                                locationNameInput: $('#UserAddress')
                            },
                            enableAutocomplete: true,
                            onchanged: function (currentLocation, radius, isMarkerDropped) {
                                var addressComponents = $(this).locationpicker('map').location.addressComponents;
								//alert(addressComponents.postalCode);
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
    $(".helplic").slideUp(200);
    $(".licnooutIn").slideUp(200);
	$(".licnoout").slideUp();
    $("#fileField1").prop('required',false);
    $("#UserLicenceno").prop('required',false);
    $("#howmanyyears").prop('required',false);
    } 
	else if ($(this).val() == 1 || $(this).val() == 2)  {
    $(".licnoout").slideDown(200);
    if($(this).val()==2)
    {
        $(".licnooutIn").slideDown(200);
    }
    else
    {
        $(".licnooutIn").slideUp(200);
    }
	$(".helplic").slideUp();
    $("#fileField1").prop('required',true);
  $("#UserLicenceno").prop('required',true);
   $("#howmanyyears").prop('required',true);

    } else if($(this).val()===""){
	
	$(".helplic").slideUp();	
	$(".licnoout").slideUp();
	}
});


function myFunction() {
    var phone_val = $("#UserPhone").val();

var new_phone = phone_val.replace(/[^\d]+/g, '')
     .replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
$("#UserPhone").val(new_phone);

}


</script>


