/* Variable Declarations */


/* 
 * == Dont edit beyond this unless you know what you are doing == 
 */

/**
* Displays notification
**/
function notify(msg, error){
	$("#notify").hide().html(msg).removeClass().addClass((error?"notify-error":"notify-info")).show()
	setTimeout(function(){ 
		$("#notify").fadeOut("slow")
	},5000);
}

function notifyStatic(msg, error){
	$("#notify").hide().html(msg).removeClass().addClass((error?"notify-error":"notify-info")).show()
}


function handleChange(obj){
	
	var tobeautify="first_name last_name father_name mother_name subject ";
	var tofixyear = "dob_en_y dob_np_y ";
	
	// beautify 
	if (tobeautify.indexOf(obj.id+" ")>=0) beautify(obj);
	if (tofixyear.indexOf(obj.id+" ")>=0) fixYear(obj);
	
	if (obj.id=='dob_np_y') blinkConst(obj.id, currentyear, "Invalid year");
	if (obj.id=='dob_en_y') blinkConst(obj.id, currentyear-57, "Invalid year");

	if (obj.id=='dob_np_m') blinkConst(obj.id, 12, "Invalid year");
	if (obj.id=='dob_en_m') blinkConst(obj.id, 12, "Invalid year");
	
	if (obj.id=='dob_np_d') blinkConst(obj.id, 32, "Invalid year");
	if (obj.id=='dob_en_d') blinkConst(obj.id, 31, "Invalid year");


	// get sums
	if (obj.id.indexOf("_theory")>0 || obj.id.indexOf("_grace")>0 || obj.id.indexOf("_practical")>0){
		var std_num = obj.id.substring(0,obj.id.indexOf("_"));
	    n=$('#'+std_num+'_theory').val()*1+$('#'+std_num+'_practical').val()*1+$('#'+std_num+'_grace').val()*1;
		if (n>0) $('#'+std_num).val(n);
	}
	
	// validate
	if (obj.id.indexOf("_th")>0) {
		var sn = obj.id.substring(1,obj.id.indexOf("_"));
		blinkConst(obj.id,fm_th[sn],"Mark should be less or equal to "+fm_th[sn])
	}
	
	if (obj.id.indexOf("_gr")>0) {
		var sn = obj.id.substring(1,obj.id.indexOf("_"));
		blinkConst(obj.id,fm_th[sn],"Mark should be less or equal to "+fm_th[sn])
	}
	
	if (obj.id.indexOf("_pr")>0) {
		var sn = obj.id.substring(1,obj.id.indexOf("_"));
		blinkConst(obj.id,fm_pr[sn],"Mark should be less or equal to "+fm_pr[sn])	
	}
	
	if (obj.id=='dob_np_y' || obj.id=='dob_np_m' || obj.id=='dob_np_d'){
		
		var year = $('#dob_np_y').val();
		var month = $('#dob_np_m').val();
		var day = $('#dob_np_d').val();
		
		$.get('nepcal.php',{r:'n2e',y:year,m:month,d:day},function(data){
			var d = data.split(':');
			$('#dob_en_y').val(d[0]);
			$('#dob_en_m').val(d[1]);
			$('#dob_en_d').val(d[2]);
		});
		
	}
	
	if (obj.id=='dob_en_y' || obj.id=='dob_en_m' || obj.id=='dob_en_d'){
		
		var year = $('#dob_en_y').val();
		var month = $('#dob_en_m').val();
		var day = $('#dob_en_d').val();
		
		$.get('nepcal.php',{r:'e2n',y:year,m:month,d:day},function(data){
			var d = data.split(':');
			$('#dob_np_y').val(d[0]);
			$('#dob_np_m').val(d[1]);
			$('#dob_np_d').val(d[2]);
		});
		
	}	
	
	if (obj.id=='reg_id'){
		// check if reg_id is duplicate
		var regid=$('#reg_id').val();
		if (regid!=$('#org_reg_id').val()){
		
			$.get('entrybe.php',{r:'regid',q:regid},function(data){
				if (data=='1') {
					$('#reg_id').addClass('blinkbg');
					$('#reg_id').attr('title','Duplicate Registration ID.');
					
				}
				else {
					$('#reg_id').removeClass('blinkbg');
					$('#reg_id').attr('title','Reg.ID');
				}
			});	
		}
		else{
			$('#reg_id').removeClass('blinkbg');
			$('#reg_id').attr('title','Reg.ID');			
		}
	}
	
	if (obj.id=='income'){
		if ($('#income').val()=='1') $('#income_hrs').attr('disabled',false);
		else $('#income_hrs').attr('disabled',true);
		
	}

}

function addNewValueModal(obj){
	
	var htm = "<label>Add " + obj.title + "</label><input type='text' onchange='beautify(this);' id='modalBoxText' title='"+obj.id+"' /><input type='button' id='modalBoxButton' value='Add' onclick='$(\"#"+obj.id+"\").attr(\"value\",$(\"#modalBoxText\").attr(\"value\")); jQuery(document).trigger(\"close.facebox\"); focusNext(\""+obj.id+"\");' />";
	jQuery.facebox(htm);
	document.getElementById('modalBoxText').focus();
}

function removeAllOptions(selectbox){
	var i;
	for(i=selectbox.options.length-1;i>=0;i--){
		selectbox.remove(i);
	}
}

function addOption(selectbox,text,value){
	var optn = document.createElement("OPTION");
	optn.text = text;
	optn.value = value;
	selectbox.options.add(optn);
}

function validate(){
	var compulsory="first_name last_name ";
	
	//if ($('#reg_id').val().length!=10) {alert('Registration ID Invalid'); $('#reg_id').focus(); return false;}
	
	if ($('#reg_id').val()=='') {alert('Registration ID Invalid'); $('#reg_id').focus(); return false;}
	
	if ($('#reg_id').hasClass('blinkbg')) {alert('Duplicate Registration ID'); $('#reg_id').focus(); return false;}
	
	if ($('#first_name').val()=='') {alert('Enter first name.'); $('#first_name').focus(); return false;}
	if ($('#last_name').val()=='') {alert('Enter last name.'); $('#last_name').focus(); return false;}
	if ($('#sex').val()=='') {alert('Enter sex.'); $('#sex').focus(); return false;}
	if ($('#caste_ethnicity').val()=='') {alert('Enter caste.'); $('#caste_ethnicity').focus(); return false;}
	
	
	if ($('#withheld').attr('checked')==false){
	
		if ($('#father_name').val()=='' && $('#mother_name').val()=='') {
			alert('Enter either father/mother name or check Withheld option.'); 
			
			if ($('#father_name').val()=='') $('#father_name').focus();
			else $('#mother_name').focus();
			
			return false;
		}
		
		if ($('#dob_np_y').val()=='' || $('#dob_np_m').val()=='' || $('#dob_np_d').val()==''){
			alert("Enter proper date of birth or check Withheld option.");
			return false;
		}
	}
	
	if ($('#withheld').attr('checked') 
		&& ($('#father_name').val()!='' || $('#mother_name').val()!='') 
		&& ($('#dob_np_y').val()!='' && $('#dob_np_m').val()!='' && $('#dob_np_d').val()!=''))
		
		if (!confirm("Withheld is checked although all information is filled. Continue?")) return false;
	
	
	for (i=1;i<=12;i++){
		if ($('#s'+i+"_theory").hasClass('blinkbg')) {alert('Correct invalid mark(s).'); return false;}
		if ($('#s'+i+"_grace").hasClass('blinkbg')) {alert('Correct invalid mark(s).'); return false;}
		if ($('#s'+i+"_practical").hasClass('blinkbg')) {alert('Correct invalid mark(s).'); return false;}
	}
	
	return true;
}


// initialize
$(document).ready(function(){
		
	$('#last_name').autocomplete("entrybe.php",{		
		extraParams: {r:'lastnameautocomplete',s:sch_num},
		delay: 0,
		mustMatch: true,
		highlight: function(value,term){ return value.replace(new RegExp("(" + term + ")", "i"), "<strong>$1</strong>") },
	});

	$('#reg_id').focus(function(){
		document.getElementById('reg_id').value = document.getElementById('reg_id').value;
	});
	
	// validate reg_id as soon as it loses focus
	$('#reg_id').blur(function(){
		handleChange(this);
	});
	
	$('#father_name').focus(function(){
		if ($(this).val()=='') $(this).val(" "+$('#last_name').val());
		setTimeout(function(){
			$('#father_name').attr('selectionEnd',0);
		},100);
	});	
	
	$('#mother_name').focus(function(){
		if ($(this).val()=='') $(this).val(" "+$('#last_name').val());
		setTimeout(function(){
			$('#mother_name').attr('selectionEnd',0);
		},100);
	});	
	
	
	$('#stdlist').tablesorter({widgets: ['zebra']});
	
	$('#reg_id').attr('autocomplete', "off");
	
	$('#reg_id').focus();
	

});



