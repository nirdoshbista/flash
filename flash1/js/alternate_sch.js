function handleChange(obj){
	
	if (obj.id.indexOf('ecd_after_')>=0){
		var t=obj.id.replace(/_f_|_m_/,'_t_');
		var f=t.replace('_t_','_f_');
		var m=t.replace('_t_','_m_');
	
		var d = document.forms[0];
		
		var sum = d[f].value *1 + d[m].value *1;
	
		d[t].value = sum?sum:'';
		
		return;
		
	}
	
	var t=obj.id.replace(/_f\[|_m\[/,'_t[');
	var f=t.replace('_t\[','_f[');
	var m=t.replace('_t\[','_m[');

	var d = document.forms[0];
	
	var sum = d[f].value *1 + d[m].value *1;

	d[t].value = sum?sum:'';
	
	// calculate others
	
	t=obj.id.replace(/_d|_j|_o/,'_t');
	var da=t.replace(/_t/,'_d');
	var ja=t.replace(/_t/,'_j');
	var ot=t.replace(/_t/,'_o');
	
	sum = d[t].value*1 - d[da].value*1 - d[ja].value*1;
	d[ot].value = sum>0?sum:''
	

	var fo=obj.id.replace(/_f|_m/,'_f');
	var mo=obj.id.replace(/_f|_m/,'_m');
	var to=obj.id.replace(/_f|_m/,'_t');
	
	fo=fo.replace(/_t|_d|_j|_o/,'_o');
	mo=mo.replace(/_t|_d|_j|_o/,'_o');
	to=to.replace(/_t|_d|_j|_o/,'_o');
	
	sum = d[fo].value *1 + d[mo].value *1;
	d[to].value = sum?sum:''
	
	if (validate) validation(obj);
	
}

function validation(obj){
	
	blink(obj.id.replace(/_t_|_d_|_j_|_t_/,'_d_'), obj.id.replace(/_t_|_d_|_j_|_t_/,'_t_'),TD);
	blink(obj.id.replace(/_t_|_d_|_j_|_t_/,'_j_'), obj.id.replace(/_t_|_d_|_j_|_t_/,'_t_'),TJ);
	blink(obj.id.replace(/_t_|_d_|_j_|_t_/,'_o_'), obj.id.replace(/_t_|_d_|_j_|_t_/,'_t_'),TO);
	
	if (obj.id.indexOf('_t_')>0){
		blinkLarge(new Array(0,1,12,13,24,25,36,37,48,49,60,61));
	}
	
	if (obj.id.indexOf('ecd_after')>=0){
		blink(obj.id.replace(/total|dalit|janjati/,'dalit'), obj.id.replace(/total|dalit|janjati/,'total'), TD );
		blink(obj.id.replace(/total|dalit|janjati/,'janjati'), obj.id.replace(/total|dalit|janjati/,'total'), TJ );	
	}	
	




}