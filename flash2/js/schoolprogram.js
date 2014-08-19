function handleChange(obj){
	// div show on y/n
	if (document.getElementById(obj.id+"_f")){
		if (obj.value=='1'){
			document.getElementById(obj.id+"_f").className = 'divshow';
			focusNext(obj.id);
		}
		else document.getElementById(obj.id+"_f").className = 'divhide';
	}
	
	
	if (obj.id.indexOf('_year')>0 || obj.id.indexOf('_date')>0) fixYear(obj);
	
	if (obj.id.indexOf('_planned')>0){
		var actualid = obj.id.replace('_planned','_actual');
		if (document.getElementById(actualid).value==''){
			document.getElementById(actualid).value = obj.value;
		}
		
	}
	
}
