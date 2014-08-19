function handleChange(obj){
	
	if (obj.id.indexOf('lang')==0){
		var t=obj.id.replace(/_f\[|_m\[/,'_t[');
		var f=t.replace('_t[','_f[');
		var m=t.replace('_t[','_m[');

		var d = document.forms[0];
		
		var sum = d[f].value *1 + d[m].value *1;

		d[t].value = sum?sum:'';
		

	}
	

	//if (validate) validation(obj);

}

function validation(obj){



}