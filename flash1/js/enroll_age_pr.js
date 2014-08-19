var age_suffix = new Array(6);
age_suffix[1]=new Array("_l5","_5","_6","_7","_8","_9","_g9","_t");
age_suffix[2]=new Array("_l6","_6","_7","_8","_9","_g9","_t");
age_suffix[3]=new Array("_l7","_7","_8","_9","_10","_g10","_t");
age_suffix[4]=new Array("_l8","_8","_9","_10","_11","_g11","_t");
age_suffix[5]=new Array("_l9","_9","_10","_11","_12","_g12","_t");
age_suffix[0]=new Array("_l5","_5_9","_g9","_t");

function handleChange(obj){
	var t=obj.id.replace(/_f_|_m_/,'_t_');
	var f=t.replace(/_t_/,'_f_');
	var m=t.replace(/_t_/,'_m_');

	var d = document.forms[0];
	var prefix=obj.id.substring(0,obj.id.indexOf('_age')+4);
	
	var sum = d[f].value*1 + d[m].value*1;

	d[t].value = sum?sum:'';  // female + male
	
	var n=0;
	for (i=0;i<=5;i++){
		if (obj.id.indexOf('['+i+']')>0){
			n=i; break;
		}
	}
	
	var sumf=0, summ=0, sumt=0;
	for (i=0;i<age_suffix[n].length-1;++i){
		sumf+= d[prefix+'_f'+age_suffix[n][i]+'['+n+']'].value*1;
		summ+= d[prefix+'_m'+age_suffix[n][i]+'['+n+']'].value*1;
		sumt+= d[prefix+'_t'+age_suffix[n][i]+'['+n+']'].value*1;
		
	}
	
	d[prefix+'_f'+age_suffix[n][age_suffix[n].length-1]+'['+n+']'].value = sumf?sumf:'';
	d[prefix+'_m'+age_suffix[n][age_suffix[n].length-1]+'['+n+']'].value = summ?summ:'';
	d[prefix+'_t'+age_suffix[n][age_suffix[n].length-1]+'['+n+']'].value = sumt?sumt:'';
	
	if (validate) validation(obj);

}

function validation(obj){

	blink(obj.id.replace(/total|dalit|janjati/,'dalit'), obj.id.replace(/total|dalit|janjati/,'total'), TD );
	blink(obj.id.replace(/total|dalit|janjati/,'janjati'), obj.id.replace(/total|dalit|janjati/,'total'), TJ );

	var l=obj.id.length;
	var cl=obj.id.substring(l-2,l-1);
	var sx='';
	
	if (obj.id.indexOf("_f_")>=0) sx='f';
	if (obj.id.indexOf("_m_")>=0) sx='m';


	if (obj.id.indexOf('_newenr_')>=0){
	
		blinkEq("total_newenr_age_"+sx+"_t["+cl+"]","total_newenr_"+sx+"["+cl+"]", "Number of students should be equal to total new enrolment");
		blinkEq("dalit_newenr_age_"+sx+"_t["+cl+"]","dalit_newenr_"+sx+"["+cl+"]", "Number of students should be equal to total new enrolment");
		blinkEq("janjati_newenr_age_"+sx+"_t["+cl+"]","janjati_newenr_"+sx+"["+cl+"]", "Number of students should be equal to total new enrolment");
	}
	else{
	
		blinkEq("total_enroll_age_"+sx+"_t["+cl+"]","total_enroll_"+sx+"["+cl+"]", "Number of students should be equal to total new enrolment");
		blinkEq("dalit_enroll_age_"+sx+"_t["+cl+"]","dalit_enroll_"+sx+"["+cl+"]", "Number of students should be equal to total new enrolment");
		blinkEq("janjati_enroll_age_"+sx+"_t["+cl+"]","janjati_enroll_"+sx+"["+cl+"]", "Number of students should be equal to total new enrolment");
	
	/*

		ajaxRequest("flash1backend.php?req=enrollment&schoolcode="+currentSchoolCode+"&class="+cl+"&sex="+sx, function(t){
			var to = "total_enroll_age_"+sx+"_t["+cl+"]";
			blinkEqConst(to, t.responseText*1, "Number of students should be equal to total enrollment ("+t.responseText+")");
		});
		
	*/
	
	
	}

}