function handleChange(obj){
	if (obj.id.indexOf('teacher_')==0) return;

	var t=obj.id.replace(/[fm]$/,'t');
	var f=obj.id.replace(/[fm]$/,'f');
	var m=obj.id.replace(/[fm]$/,'m');

	var d = document.forms[0];
	
	var sum = d[f].value *1 + d[m].value *1;

	d[t].value = sum?sum:'';
	
	if (obj.disabled==true) return; // recursion end
	
	var suffix=new Array("fully_trained","untrained");

	
	sum=0;
	for (i=0;i<suffix.length;++i){
		t=obj.id.replace(/fully_trained|untrained/,suffix[i]);
		sum+=d[t].value*1;
	}
	
	t=obj.id.replace(/fully_trained_|untrained_/,'');

	d[t].value=sum?sum:'';
	
	handleChange(d[t]);

	if (validate) validation(obj);
	
}

function validation(obj){

	if (obj.id.indexOf('hsec_')==0){
		blink(obj.id.replace(/total|dalit|janjati/,'dalit'), obj.id.replace(/total|dalit|janjati/,'total'),TD);
		blink(obj.id.replace(/total|dalit|janjati/,'janjati'), obj.id.replace(/total|dalit|janjati/,'total'),TJ);
	
	}
	

}