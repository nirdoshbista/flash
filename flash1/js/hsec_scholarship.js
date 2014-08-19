function handleChange(obj){
	if (obj.id.search(/enr_|passed_/)==0){
		var t=obj.id.replace(/_female|_male/,'_total');
		var f=t.replace(/_total/,'_female');
		var m=t.replace(/_total/,'_male');

		var d = document.forms[0];
		
		var sum = d[f].value *1 + d[m].value *1;

		d[t].value = sum?sum:'';  // female + male
	
	}
	else{
		var t=obj.id.replace(/_f_|_m_/,'_t_');
		var f=t.replace(/_t_/,'_f_');
		var m=t.replace(/_t_/,'_m_');

		var d = document.forms[0];
		
		var sum = d[f].value *1 + d[m].value *1;

		d[t].value = sum?sum:'';  // female + male
	
	
	}
	
	if (validate) validation(obj);
	
}

function validation(obj){

	if (obj.id.indexOf('hsec_passed')<0){
		blink(obj.id.replace(/total|dalit|janjati/,'dalit'), obj.id.replace(/total|dalit|janjati/,'total'),TD);
		blink(obj.id.replace(/total|dalit|janjati/,'janjati'), obj.id.replace(/total|dalit|janjati/,'total'),TJ);
	
	}
	

}