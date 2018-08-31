$(document).ready(function(){
	
	$("#file").change(function(e){
		var img = e.target.files[0];
		
		if(!iEdit.open(img, true, function(res){
			$("#result").attr("src", res);		
			$("#image_encode").val(res);
			$("#file").val('');
			$('#ProfileimageProfilePictureForm').submit();			
		})){
			
			alert("Whoops! That is not an image!");
		}
	});
	var countofchild=1;
	$(".addchildbtn").click(function (e)
	{
		e.preventDefault();
		var childname=$("#UserChildname").val();
		var age=$("#UserAge").val();
		var gender=$("#UserGender").val();
		var startdate=$("#UserStartdate").val();
		var enddate=$("#UserEnddate").val();
		var lastname=$("#UserLastname").val();
		var Paymentfrequency=$("#UserPaymentfrequency").val();
		var check=1;
		if(childname==='')
		{
			check=0;
			$("#UserChildname").css("border","1px solid red");
		}
		if(lastname==='')
		{
			check=0;
			$("#UserLastname").css("border","1px solid red");
		}
		if(age==='s')
		{
			check=0;
			$("#UserAge").css("border","1px solid red");
		}
		if(startdate==='')
		{
			check=0;
			$("#UserStartdate").css("border","1px solid red");
		}
		if(check===1)
		{
		var htmlmsg='';
		htmlmsg+='<tr><td><div class="input text"><input name="data[User][childname][]" class="txt_input_text" value="'+childname+'" placeholder="Child name" type="text"  required id="UserChildname_'+countofchild+'"></div></td><td><div class="input text"><input name="data[User][lastname][]" class="txt_input_text" value="'+lastname+'" placeholder="Child Last name" type="text"  required id="UserLastname_'+countofchild+'"></div></td><td><div class="input select"><select name="data[User][age][]" class="genderClass" id="UserAge_'+countofchild+'">';
		if(age==='0-2')
		{
			htmlmsg+='<option value="s">Age</option><option value="0-2" selected="selected">0-2</option><option value="2-4">2-4</option><option value="4-5">4-5</option><option value="afterschool">Afterschool</option>';
		}
		else if(age==='2-4')
		{
			htmlmsg+='<option value="s">Age</option><option value="0-2">0-2</option><option value="2-4" selected="selected">2-4</option><option value="4-5">4-5</option><option value="afterschool">Afterschool</option>';
		}
		else if(age==='4-5')
		{
			htmlmsg+='<option value="s">Age</option><option value="0-2">0-2</option><option value="2-4">2-4</option><option value="4-5" selected="selected">4-5</option><option value="afterschool">Afterschool</option>';
		}
		else if(age==='afterschool')
		{
			htmlmsg+='<option value="s">Age</option><option value="0-2">0-2</option><option value="2-4">2-4</option><option value="4-5">4-5</option><option value="afterschool" selected="selected">Afterschool</option>';
		}
		htmlmsg+='</select></div></td><td><div class="input select"><select name="data[User][gender][]" class="genderClass" id="UserGender_'+countofchild+'">';
		if(gender==='M')
		{
			htmlmsg+='<option value="M" selected="selected">Male</option><option value="F">Female</option>';
		}
		else 
		{
			htmlmsg+='<option value="M">Male</option><option value="F" selected="selected">Female</option>';
		}
		htmlmsg+='</select></div></td><td><div class="input text"><input name="data[User][startdate][]" autocomplete="OFF" value="'+startdate+'" class="txt_input_text date hasDatepicker" placeholder="Start Date" type="text" id="UserStartdate_'+countofchild+'"></div></td><td><div class="input text"><input name="data[User][enddate][]" autocomplete="OFF" value="'+enddate+'" class="txt_input_text date hasDatepicker" placeholder="End Date" type="text" id="UserEnddate_'+countofchild+'"></div></td><td><div class="input select"><select name="data[User][paymentfrequency][]" class="genderClass" id="UserPaymentfrequency_'+countofchild+'">';
		if(Paymentfrequency==='M')
		{
			htmlmsg+='<option value="M" selected="selected">Monthly</option><option value="D">Daily</option><option value="W">Weekly</option>';
		}
		else if(Paymentfrequency==='D')
		{
			htmlmsg+='<option value="M">Monthly</option><option value="D" selected="selected">Daily</option><option value="W">Weekly</option>';
		}
		else 
		{
			htmlmsg+='<option value="M">Monthly</option><option value="D">Daily</option><option value="W" selected="selected">Weekly</option>';
		}
		htmlmsg+='</select></div></td><td><input type="button" value="- Child" class="saveprice removechildbtn"></td></tr>';
		$("tbody#customField").append(htmlmsg);
		$( function() {
		$('#UserStartdate_'+countofchild).datepicker({ dateFormat: 'mm-dd-yy' });
		$('#UserEnddate_'+countofchild).datepicker({ dateFormat: 'mm-dd-yy' });
		});
		$(".removechildbtn").click(function(e) {
		e.preventDefault();
        $(this).parent().parent('tr').remove();
    });
	$("#UserChildname").val('');
	$("#UserAge option[value='s']").prop("selected",true);
	$("#UserGender option[value='M']").prop("selected",true);
	$("#UserPaymentfrequency option[value='M']").prop("selected",true);
	$("#UserStartdate").val('');
	$("#UserEnddate").val('');
	$("#UserLastname").val('');
	
	
	 	
	
	countofchild++;
	
		}
		
	});
	
	$(".acceptorreject").change(function(e) {
		e.preventDefault();
		var amount = parseFloat($(this).parent().parent().children('.col-md-4').children('.amount').val());
		var SelectId=$(this).attr("id");
		if(amount>1)
		{
        $.ajax({
			url:$(this).attr("action"),
			data:"reserved_id="+$(this).attr("reserve_id")+"&type="+$(this).val()+"&amount="+$(this).parent().parent().children('.col-md-4').children('.amount').val(),
			type:"GET",
			success: function(data)
			{
				
				$("#"+SelectId).parent().parent().children('.col-md-4').children(".amount").prop("disabled",true);
				$("#"+SelectId).parent().html('Request Accepted');
				
				
			},
			error: function(error)
			{
				alert(error);
			}
		});
		}
		else
		{
			alert("Please Enter Amount");
			$('#'+SelectId+' option[value="0"]').prop('selected',true);
			
		}
    });
	var transform=0;
	$("#btn_rotate").click(function(e) {
        e.preventDefault();
		transform=parseFloat($("#saveImage").attr("rotate"));
		if(parseInt(transform) > 270)
			{
				transform=0;
			}
		transform=transform+90;
		$("#saveImage").attr("rotate",transform);
		$('#rotateImage').css("transform","rotate("+transform+"deg)");
    });
	$("#saveImage").click(function(e) {
        e.preventDefault();
		transform=$(this).attr("rotate");
		 $.ajax({
			 url:$(this).attr("action"),
			 type:"GET",
			 data:"filename="+$(this).attr("filename")+"&rotate="+transform+"&profileId="+$(this).attr("profileId"),
			 success: function()
			 {
				window.location.reload();
			 }
		 });
    });
});