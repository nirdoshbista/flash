var age_suffix = new Array(6);
age_suffix[11]=new Array("_l15","_15","_15_16","_g16","_t");
age_suffix[12]=new Array("_l16","_16","_g16","_t");
age_suffix[0]=new Array("_l15","_15_16","_g16","_t");

function handleChange(obj){
	var t=obj.id.replace(/_f_|_m_/,'_t_');
	var f=t.replace(/_t_/,'_f_');
	var m=t.replace(/_t_/,'_m_');

	var d = document.forms[0];
	var prefix=obj.id.substring(0,obj.id.indexOf('_age')+4);
	
	var sum = d[f].value*1 + d[m].value*1;

	d[t].value = sum?sum:'';  // female + male
	
	var n=0;
	for (i=0;i<=12;i++){
		if (i==1) i=11;
		if (obj.id.indexOf('['+i+']')>0){
			n=i; break;
		}
	}
	
	var sumf=0, summ=0, sumt=0;
	for (i=0;i<age_suffix[n].length-1;++i){
		sumf+= d[prefix+'_f'+age_suffix[n][i]+'['+n+']'].value*1;
		summ+= d[prefix+'_m'+age_suffix[n][i]+'['+n+']'].value*1;
		sumt+= d[prefix+'_t'+age_suffix[n][i]+'['+n+']'].value*1;
		
	}
	
	d[prefix+'_f'+age_suffix[n][age_suffix[n].length-1]+'['+n+']'].value = sumf?sumf:'';
	d[prefix+'_m'+age_suffix[n][age_suffix[n].length-1]+'['+n+']'].value = summ?summ:'';
	d[prefix+'_t'+age_suffix[n][age_suffix[n].length-1]+'['+n+']'].value = sumt?sumt:'';
	
	if (validate) validation(obj);
	
}

function validation(obj){

	blink(obj.id.replace(/total|dalit|janjati/,'dalit'), obj.id.replace(/total|dalit|janjati/,'total'),TD);
	blink(obj.id.replace(/total|dalit|janjati/,'janjati'), obj.id.replace(/total|dalit|janjati/,'total'),TJ);
	

}