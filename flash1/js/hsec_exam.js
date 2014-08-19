function handleChange(obj){
	var t=obj.id.replace(/_f|_m/,'_t');
	var f=t.replace(/_t/,'_f');
	var m=t.replace(/_t/,'_m');

	var d = document.forms[0];
	
	var sum = d[f].value *1 + d[m].value *1;

	d[t].value = sum?sum:'';  // female + male
	
	if (validate) validation(obj);
	
}

function validation(obj){

	blink(obj.id.replace(/tot|dalit|janjati/,'dalit'), obj.id.replace(/tot|dalit|janjati/,'tot'),TD);
	blink(obj.id.replace(/tot|dalit|janjati/,'janjati'), obj.id.replace(/tot|dalit|janjati/,'tot'),TJ);
	
	blink(obj.id.replace(/_app_|_pass_/,'_pass_'),obj.id.replace(/_app_|_pass_/,'_app_'),"Passed Students should be less or equal to appeared");
	
}