function handleChange(obj){
	var t=obj.id.replace(/_f|_m/,'_t');
	var f=t.replace(/_t/,'_f');
	var m=t.replace(/_t/,'_m');

	var d = document.forms[0];
	
	var sum = d[f].value *1 + d[m].value *1;

	d[t].value = sum?sum:'';  // female + male
	
	if (obj.id.indexOf('other_')>=0) return; // recursion end
	
	var da=obj.id.replace(/tot|dalit|janjati|other/,'dalit');
	var ja=obj.id.replace(/tot|dalit|janjati|other/,'janjati');
	var ot=obj.id.replace(/tot|dalit|janjati|other/,'other');
	var tt=obj.id.replace(/tot|dalit|janjati|other/,'tot');
	
	sum = d[tt].value*1 - d[da].value*1 - d[ja].value*1;
	d[ot].value = sum>0?sum:''; // class total
	
	handleChange(d[ot]);
	
	if (validate) validation(obj);
	
}

function validation(obj){
	
	blink(obj.id.replace(/tot|dalit|janjati/,'dalit'), obj.id.replace(/tot|dalit|janjati/,'tot'),TD);
	blink(obj.id.replace(/tot|dalit|janjati/,'janjati'), obj.id.replace(/tot|dalit|janjati/,'tot'),TJ);
	blink(obj.id.replace(/tot|dalit|janjati/,'other'), obj.id.replace(/tot|dalit|janjati/,'tot'),TO);
	
	if (obj.id.indexOf('tot')>=0){

		blinkLarge(new Array(1,2,13,14,25,26,37,38,50,51,63,64 ,75,76,87,88,99,100,111,112,124,125,137,138));
	}



}