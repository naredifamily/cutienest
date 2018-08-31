<div class="page_title_bar">
<div class="wrapper">
<h1>Schedule</h1>
</div>
</div>
<div class="message-upper">
<?php
echo $this->Session->flash();
if($user['User']['provider_req']==1 && $user['User']['role']==1){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Your child care home registration has been completed. Please wait for admin approval. </p>
<?php }
else if($user['User']['provider_req']==3 && $user['User']['role']==1){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Your child care Profile is Rejected, Please contact to Admin. </p>
<?php } 
else if($user['User']['provider_req']==4 && $user['User']['role']==1){
?><p class="un_approved"><i class="fa fa-exclamation-circle"></i> Your child care Profile is Deactivated, Please contact to Admin. </p>
<?php } 
?>
</div>
<div class="page_content">
<div class="wrapper afclr">
<?php echo $this->element('usersection'); ?>
<div class="login_tab afclr">
<div class="tab_left">
<?php echo $this->element('menu'); ?>
</div>
<div class="tab_right">

<div class="title_heading">
<h3>Schedule</h3>
</div> <?php echo $this->Form->create('User'); ?>

<div class="schedule_list">
<table style="width:100%;">
<tr>
<td></td>
<td>Day</td>
<td>Time ( from )</td>
<td>Time ( to )</td>
<td></td>
</tr>

<tr>
<td data-th=""><input type="checkbox" name="fullday" id="fullday" <?php if($data[0]['User']['fullday']=='1'){?> checked="checked" <?php }?> value="1">Fullday</td>
<td data-th="Day">Monday to Friday</td>
<td data-th="Time ( from )"><input type="time"  name="fulldaytime_from" id="fulldaytime_from"  <?php if($data[0]['User']['fullday']=='0'){?> disabled="disabled" <?php }?> value="<?=$data[0]['User']['fulldaytime_from']?>"></td>
<td data-th="Time ( to )"><input type="time" name="fulldaytime_to"  id="fulldaytime_to" <?php if($data[0]['User']['fullday']=='0'){?> disabled="disabled" <?php }?>  value="<?=$data[0]['User']['fulldaytime_to']?>"></td>

</tr>
<tr>
<td colspan="4"><p><?php //echo $this->Form->textarea('fullday_text', ['placeholder' => 'About Full Day','value'=>$data[0]['User']['fullday_text'],'class'=>'tinymce' ,'label' => false]); ?></p>
</td>
</tr>
<tr>
<td data-th=""><input type="checkbox" name="halfday" id="halfday" value="1"  <?php if($data[0]['User']['halfday']=='1'){?> checked="checked" <?php }?> >Halfday</td>
<td data-th="Day">Monday to Friday</td>
<td data-th="Time ( from )"><input type="time" name="halfdaytime_from" id="halfdaytime_from" <?php if($data[0]['User']['halfday']=='0'){?> disabled="disabled" <?php }?>  value="<?=$data[0]['User']['halfdaytime_from']?>"></td>
<td data-th="Time ( to )"><input type="time" name="halfdaytime_to"  id="halfdaytime_to" <?php if($data[0]['User']['halfday']=='0'){?> disabled="disabled" <?php }?>  value="<?=$data[0]['User']['halfdaytime_to']?>"></td>

</tr>
<tr><td colspan="4" style="padding: 0;"><p class="editor-help"><a id="riverroad" href="#" title="" ><i class="fa fa-question-circle"></i></a></p>
<p id="large"></p>
</td></tr>
<tr>
<td colspan="4"><p><?php echo $this->Form->textarea('halfday_text', ['placeholder' => '','value'=>empty($data[0]['User']['halfday_text'])?'Enter your daily schedule here':$data[0]['User']['halfday_text'],'class'=>'tinymce' ,'label' => false]); ?></p>
</td>
</tr>




</table>
<div class="create_invoice_btn">
 <?php echo $this->Form->input('Save Schedule', ['type' => 'submit','class'=>'saveprice','label' => false]); ?></div>
</div>

<?php echo $this->Form->end(); ?>


</div>
</div>
</div>
</div>

<script type="text/javascript" language="javascript">
	$(document).ready(function() {		
		$("#riverroad").hover(function(e){
			$("#large").html("<img src='<?php echo Configure::read('SITE_URL') ?>/images/help.png' alt='Large Image' /><br/>")
							 .fadeIn("slow");
		}, function(){
			$("#large").fadeOut("fast");
		});		
		
	});
$(document).ready(function(e) {
    document.getElementById('fullday').onchange = function() {
    document.getElementById('fulldaytime_from').disabled = !this.checked;
	 document.getElementById('fulldaytime_to').disabled = !this.checked;
};

document.getElementById('halfday').onchange = function() {
    document.getElementById('halfdaytime_from').disabled = !this.checked;
	    document.getElementById('halfdaytime_to').disabled = !this.checked;

};
});

</script>
<script type="text/javascript">
        tinymce.PluginManager.add('placeholder', function (editor) {
            editor.on('init', function () {
                var label = new Label;
                onBlur();
                tinymce.DOM.bind(label.el, 'click', onFocus);
                editor.on('focus', onFocus);
                editor.on('blur', onBlur);
                editor.on('change', onBlur);
                editor.on('setContent', onBlur);
                function onFocus() { if (!editor.settings.readonly === true) { label.hide(); } editor.execCommand('mceFocus', false); }
                function onBlur() { if (editor.getContent() == '') { label.show(); } else { label.hide(); } }
            });
            var Label = function () {
                var placeholder_text = editor.getElement().getAttribute("placeholder") || editor.settings.placeholder;
                var placeholder_attrs = editor.settings.placeholder_attrs || { style: { position: 'absolute', top: '2px', left: 0, color: '#aaaaaa', padding: '.25%', margin: '5px', width: '80%', 'font-size': '17px !important;', overflow: 'hidden', 'white-space': 'pre-wrap' } };
                var contentAreaContainer = editor.getContentAreaContainer();
                tinymce.DOM.setStyle(contentAreaContainer, 'position', 'relative');
                this.el = tinymce.DOM.add(contentAreaContainer, "label", placeholder_attrs, placeholder_text);
            }
            Label.prototype.hide = function () { tinymce.DOM.setStyle(this.el, 'display', 'none'); }
            Label.prototype.show = function () { tinymce.DOM.setStyle(this.el, 'display', ''); }
        });

        tinymce.init({selector: ".tinymce",plugins: ["placeholder"]});

    </script>