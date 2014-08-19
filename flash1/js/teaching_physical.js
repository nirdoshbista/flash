function handleChange(obj){
	
	if (obj.id.indexOf('lang')==0){
		var t=obj.id.replace(/_f\[|_m\[/,'_t[');
		var f=t.replace('_t[','_f[');
		var m=t.replace('_t[','_m[');

		var d = document.forms[0];
		
		var sum = d[f].value *1 + d[m].value *1;

		d[t].value = sum?sum:'';
		

	}	
	
	if (obj.id.indexOf('non_teaching')>=0){
		var sum=0;
		sum += document.forms[0].elements['non_teaching_account_f'].value *1;
		sum += document.forms[0].elements['non_teaching_account_m'].value *1;
		
		document.forms[0].elements['non_teaching_account_t'].value = sum?sum:'';

		var sum=0;
		sum += document.forms[0].elements['non_teaching_admin_f'].value *1;
		sum += document.forms[0].elements['non_teaching_admin_m'].value *1;
		
		document.forms[0].elements['non_teaching_admin_t'].value = sum?sum:'';

		var sum=0;
		sum += document.forms[0].elements['non_teaching_other_f'].value *1;
		sum += document.forms[0].elements['non_teaching_other_m'].value *1;
		
		document.forms[0].elements['non_teaching_other_t'].value = sum?sum:'';			
		
	}
	
	if (obj.id.indexOf('full_students_no')>=0){
		var sum=0;
		var d= document.forms[0].elements;
		sum += d['full_students_no_1'].value * 1;
		sum += d['full_students_no_2'].value * 1;
		sum += d['full_students_no_3'].value * 1;
		sum += d['full_students_no_4'].value * 1;
		sum += d['full_students_no_5'].value * 1;
		sum += d['full_students_no_6'].value * 1;
		sum += d['full_students_no_7'].value * 1;
		sum += d['full_students_no_8'].value * 1;
		sum += d['full_students_no_9'].value * 1;
		sum += d['full_students_no_10'].value * 1;		
		d['full_students_no_t'].value = sum?sum:'';
		
	}

	if (obj.id.indexOf('partial_students_no')>=0){
		var sum=0;
		var d= document.forms[0].elements;
		sum += d['partial_students_no_1'].value * 1;
		sum += d['partial_students_no_2'].value * 1;
		sum += d['partial_students_no_3'].value * 1;
		sum += d['partial_students_no_4'].value * 1;
		sum += d['partial_students_no_5'].value * 1;
		sum += d['partial_students_no_6'].value * 1;
		sum += d['partial_students_no_7'].value * 1;
		sum += d['partial_students_no_8'].value * 1;
		sum += d['partial_students_no_9'].value * 1;
		sum += d['partial_students_no_10'].value * 1;
		
		d['partial_students_no_t'].value = sum?sum:'';
		
	}

	if (obj.id.indexOf('none_students_no')>=0){
		var sum=0;
		var d= document.forms[0].elements;
		sum += d['none_students_no_1'].value * 1;
		sum += d['none_students_no_2'].value * 1;
		sum += d['none_students_no_3'].value * 1;
		sum += d['none_students_no_4'].value * 1;
		sum += d['none_students_no_5'].value * 1;
		sum += d['none_students_no_6'].value * 1;
		sum += d['none_students_no_7'].value * 1;
		sum += d['none_students_no_8'].value * 1;
		sum += d['none_students_no_9'].value * 1;
		sum += d['none_students_no_10'].value * 1;		
		d['none_students_no_t'].value = sum?sum:'';
		
	}
	
	if (obj.id.indexOf('reuse_students_no')>=0){
		var sum=0;
		var d= document.forms[0].elements;
		sum += d['reuse_students_no_1'].value * 1;
		sum += d['reuse_students_no_2'].value * 1;
		sum += d['reuse_students_no_3'].value * 1;
		sum += d['reuse_students_no_4'].value * 1;
		sum += d['reuse_students_no_5'].value * 1;
		sum += d['reuse_students_no_6'].value * 1;
		sum += d['reuse_students_no_7'].value * 1;
		sum += d['reuse_students_no_8'].value * 1;
		sum += d['reuse_students_no_9'].value * 1;
		sum += d['reuse_students_no_10'].value * 1;		
		d['reuse_students_no_t'].value = sum?sum:'';
		
	}	
	
	if (obj.id.indexOf('sections')>=0){
		var sum=0;
		var d= document.forms[0].elements;
		
		for (i=0;i<=10;i++){
			sum += d['sections_'+i].value * 1;
		}
		
		d['sections_t'].value = sum?sum:'';
		
	}	
	
	if (obj.id.indexOf('classrooms')>=0){
		var sum=0;
		var d= document.forms[0].elements;
		
		for (i=0;i<=10;i++){
			sum += d['classrooms_'+i].value * 1;
		}
		
		d['classrooms_t'].value = sum?sum:'';
		
	}	
	
	if (validate) validation(obj);


}

function validation(obj){

	/*
	if (obj.id.indexOf('_students_')>=0){
			var l=obj.id.length;
			var cl=obj.id.substring(l-1,l);
			
			ajaxRequest("flash1backend.php?req=enrollment&schoolcode="+currentSchoolCode+"&class="+cl+"&sex=t", function(t){
				blinkConst(obj.id, t.responseText*1, "Numbers of students getting textbook should be less total enrollment ("+t.responseText+")");
			});
	}
	*/

}


