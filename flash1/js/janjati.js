function handleChange(obj){
	
	var d = document.forms[0];
	
	if (obj.id.indexOf('janjati')==00){
		
		var t=obj.id.replace(/_m|_f|_t/,'_t');
		var f=obj.id.replace(/_m|_f|_t/,'_f');
		var m=obj.id.replace(/_m|_f|_t/,'_m');

		
		
		var sum = d[f].value *1 + d[m].value *1;

		d[t].value = sum>0?sum:'';
	
	}
	
	if (obj.id=='scholarship'){
		d['scholarship_amount'].disabled=d['scholarship'].value=='1'?false:true;
		
		if (obj.value=='1') document.getElementById('scholarship_amount').focus();
		
	}	

	if (obj.id=='block_grant'){
		d['block_grant_amount'].disabled=d['block_grant'].value=='1'?false:true;
		
		if (obj.value=='1') document.getElementById('block_grant_amount').focus();
		
	}		
	
	if (obj.id=='salary_support'){
		d['salary_support_amount'].disabled=d['salary_support'].value=='1'?false:true;
		
		if (obj.value=='1') document.getElementById('salary_support_amount').focus();
		
	}	

	if (obj.id=='other_support'){
		d['other_support_amount'].disabled=d['other_support'].value=='1'?false:true;
		
		if (obj.value=='1') document.getElementById('other_support_amount').focus();
		
	}	

	 
}
