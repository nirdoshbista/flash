function handleChange(obj){
	var t=obj.id.replace(/_f\[|_m\[/,'_t[');
	var f=t.replace(/_t\[/,'_f[');
	var m=t.replace(/_t\[/,'_m[');

	var d = document.forms[0];
	
	var sum = d[f].value *1 + d[m].value *1;

	d[t].value = sum?sum:'';  // female + male
	
	if (obj.id.indexOf('_total_')>0) return; // recursion end
	
	var da=obj.id.replace(/dalit|janjati|others/,'dalit');
	var ja=obj.id.replace(/dalit|janjati|others/,'janjati');
	var ot=obj.id.replace(/dalit|janjati|others/,'others');
	var tt=obj.id.replace(/dalit|janjati|others/,'total');
	
	sum = d[da].value*1 + d[ja].value*1 + d[ot].value*1;
	d[tt].value = sum?sum:''; // class total
	

	handleChange(d[tt]);
	
	//all total
	
	if (obj.id.indexOf('[0]')>0) return; // recursion end
	
	sum=0;
	var n='';
	for (i=6;i<=8;i++){
		n=obj.id.replace(/[678]/,i);
		sum += d[n].value*1;
	}
	
	n=obj.id.replace(/[678]/,'0');
	d[n].value = sum?sum:'';
	
	handleChange(d[n]);
	
	
	if (validate) validation(obj);
	
}

function validation(obj){
	
	blink(obj.id.replace(/_enroll_|_appeared_exam_|_passed_exam_/,'_appeared_exam_'), obj.id.replace(/_enroll_|_appeared_exam_|_passed_exam_/,'_enroll_'));
	blink(obj.id.replace(/_enroll_|_appeared_exam_|_passed_exam_/,'_passed_exam_'), obj.id.replace(/_enroll_|_appeared_exam_|_passed_exam_/,'_enroll_'));

		
	if (obj.id.indexOf('_enroll_')>=0){
		blinkLarge(new Array(27,28, 63,64, 99,100));
	}
}