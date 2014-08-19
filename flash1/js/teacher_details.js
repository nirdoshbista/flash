function handleChange(obj){
	
	if (obj.id.search(/_f|_m/)>0){
		var t=obj.id.replace(/_f|_m/,'_t');
		var f=obj.id.replace(/_f|_m/,'_f');
		var m=obj.id.replace(/_f|_m/,'_m');
		
		var d = document.forms[0];
		
		d[t].value = d[m].value * 1 + d[f].value * 1;
		
	}
	
	if (obj.id.search(/teachers|grant|private/)>-1){
		var d = document.forms[0];
		n = obj.id.match(/[1-4]/)[0];
		
		var sum = d['total_f_teachers['+n+']'].value*1 + d['grant_f['+n+']'].value*1 + d['private_f['+n+']'].value*1;
		d['total_f['+n+']'].value = sum>0?sum:'';
		
		var sum = d['total_m_teachers['+n+']'].value*1 + d['grant_m['+n+']'].value*1 + d['private_m['+n+']'].value*1;
		d['total_m['+n+']'].value = sum>0?sum:'';
		
		var sum = d['total_t_teachers['+n+']'].value*1 + d['grant_t['+n+']'].value*1 + d['private_t['+n+']'].value*1;
		d['total_t['+n+']'].value = sum>0?sum:'';
		
	}
	
	if (obj.id.search(/dalit|janjati|disabled/)>-1){
		var d = document.forms[0];
		n = obj.id.match(/[1-4]/)[0];
		
		var diff = d['total_f['+n+']'].value*1 - d['dalit_f_teachers['+n+']'].value*1 - d['janjati_f_teachers['+n+']'].value*1;
		d['other_f_teachers['+n+']'].value = diff>0?diff:'';
		
		var diff = d['total_m['+n+']'].value*1 - d['dalit_m_teachers['+n+']'].value*1 - d['janjati_m_teachers['+n+']'].value*1;
		d['other_m_teachers['+n+']'].value = diff>0?diff:'';
		
		var diff = d['total_t['+n+']'].value*1 - d['dalit_t_teachers['+n+']'].value*1 - d['janjati_t_teachers['+n+']'].value*1;
		d['other_t_teachers['+n+']'].value = diff>0?diff:'';
		
	}	
	
	
	if (obj.id.indexOf('_total_t_teachers')>0 || obj.id.indexOf('_total_f_teachers')>0){
		
		var t=obj.id.replace(/_f_|_t_/,'_t_');
		var f=obj.id.replace(/_f_|_t_/,'_f_');
		var m=obj.id.replace(/_f_|_t_/,'_m_');

		var d = document.forms[0];
		
		var diff = d[t].value *1 - d[f].value *1;

		d[m].value = diff>0?diff:'';
	
	}
	
	if (obj.id=='teacher_rahat'){
		document.getElementById('rahat').className=obj.value==1?'':'divhide';
		document.getElementById('teacher_rahat_pri').disabled=obj.value==1?false:true;
		document.getElementById('teacher_rahat_lsec').disabled=obj.value==1?false:true;
		document.getElementById('teacher_rahat_sec').disabled=obj.value==1?false:true;
	
	}
	
	if (obj.name == 'mother_lang_teacher_available'){
		document.getElementById('mother_lang_expand').className=obj.value==1?'':'divhide';
	}
	
	if (obj.name == 'mother_lang_m' || obj.name == 'mother_lang_f'){
		var d = document.forms[0];
		var t = d['mother_lang_m'].value *1 + d['mother_lang_f'].value*1;
		d['mother_lang_t'].value = t>0?t:'';
	}
	
	 
}