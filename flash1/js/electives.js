function handleChange(obj){

	var t=obj.id.replace(/_f|_m/,'_t');
	var f=t.replace('_t','_f');
	var m=t.replace('_t','_m');

	var d = document.forms[0];
	
	var sum = d[f].value *1 + d[m].value *1;

	d[t].value = sum?sum:'';
	


}

function disen(obj){
	var f=obj.id.replace(/_title/,'_f');
	var m=obj.id.replace(/_title/,'_m');
	
	var d = document.forms[0];

	if (obj.value==''){
		d[f].disabled=true;
		d[m].disabled=true;	
	}
	else{
		d[f].disabled=false;
		d[m].disabled=false;
		
	}
}