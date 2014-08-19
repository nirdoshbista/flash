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
	for (i=9;i<=10;i++){
		n=obj.id.replace(/9|10/,i);
		sum += d[n].value*1;
	}
	
	n=obj.id.replace(/9|10/,'0');
	d[n].value = sum?sum:'';
	
	handleChange(d[n]);
	
	if (validate) validation(obj);
	
}

var PR = 'Number of promotion should be less than enrollment';
var ER = 'Number of repeatation should be less than enrollment';
var NR = 'Number of new enrollment should be less than enrollment';
var TR = 'Number of transfers should be less than enrollment';


function validation(obj){
	
	blink(obj.id.replace(/_enroll_|_prom_|_rep_|_new_enroll_|_tran_/,'_prom_'), obj.id.replace(/_enroll_|_prom_|_rep_|_new_enroll_|_tran_/,'_enroll_'),PR);
	blink(obj.id.replace(/_enroll_|_prom_|_rep_|_new_enroll_|_tran_/,'_rep_'), obj.id.replace(/_enroll_|_prom_|_rep_|_new_enroll_|_tran_/,'_enroll_'),ER);
	blink(obj.id.replace(/_enroll_|_prom_|_rep_|_new_enroll_|_tran_/,'_new_enroll_'), obj.id.replace(/_enroll_|_prom_|_rep_|_new_enroll_|_tran_/,'_enroll_'),NR);
	blink(obj.id.replace(/_enroll_|_prom_|_rep_|_new_enroll_|_tran_/,'_tran_'), obj.id.replace(/_enroll_|_prom_|_rep_|_new_enroll_|_tran_/,'_enroll_'),TR);

	if (obj.id.indexOf('_enroll_')>=0){
		blinkLarge(new Array(36,37,84,85));
	}
}
