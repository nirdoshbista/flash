function handleChange(obj){
	       
	if (obj.id.indexOf('hsec_')==0){
		
		var t=obj.id.replace(/[fm]$/,'t');
		var f=obj.id.replace(/[fm]$/,'f');
		var m=obj.id.replace(/[fm]$/,'m');
	
		var d = document.forms[0];
		
		var sum = d[f].value *1 + d[m].value *1;
	
		d[t].value = sum?sum:'';		
		
		var m1 = obj.id.match(/total|dalit|janjati/)[0]
		var m2 = obj.id.match(/_[fm]$/)[0]
		
		
		var d = document.forms[0];
		
		sum = d['hsec_fully_trained_'+m1+m2].value * 1 + d['hsec_untrained_'+m1+m2].value * 1;
		d['hsec_'+m1+m2].value = sum>0?sum:'';
		
		sum = d['hsec_fully_trained_'+m1+'_t'].value * 1 + d['hsec_untrained_'+m1+'_t'].value * 1;
		d['hsec_'+m1+'_t'].value = sum>0?sum:'';
		
	
	}
	else{
		
		var t=obj.id.replace(/[fm]$/,'t');
		var f=obj.id.replace(/[fm]$/,'f');
		var m=obj.id.replace(/[fm]$/,'m');
	
		var d = document.forms[0];
		
		var sum = d[f].value *1 + d[m].value *1;
	
		d[t].value = sum?sum:'';
		
		if (obj.disabled==true) return; // recursion end
		
		var suffix;
		
		if (obj.id.indexOf('pri_')==0) suffix=new Array("fully_trained","tpd1_trained","tpd2_trained","tpd3_trained","untrained");
		if (obj.id.indexOf('lsec_')==0) suffix=new Array("fully_trained","tpd1_trained","tpd2_trained","tpd3_trained","untrained");
		if (obj.id.indexOf('sec_')==0) suffix=new Array("fully_trained","tpd1_trained","tpd2_trained","tpd3_trained","untrained");
		
		
		sum=0;
		for (i=0;i<suffix.length;++i){
			t=obj.id.replace(/fully_trained|tpd1_trained|tpd2_trained|tpd3_trained|untrained/,suffix[i]);
			sum+=d[t].value*1;
		}
		
		t=obj.id.replace(/fully_trained_|tpd1_trained|tpd2_trained|tpd3_trained|untrained_/,'');
	
		d[t].value=sum?sum:'';
		
		handleChange(d[t]);
	
		if (validate) validation(obj);		
	}



}

function validation(obj){

	var d = document.forms[0];

	blink(obj.id.replace(/total|dalit|janjati/,'dalit'), obj.id.replace(/total|dalit|janjati/,'total'), TD );
	blink(obj.id.replace(/total|dalit|janjati/,'janjati'), obj.id.replace(/total|dalit|janjati/,'total'), TJ );
	
	if (classes[1]>0){
		blinkConst('pri_total_f',pri_total_f,"Should be equal to total female primary level teachers in the school ("+pri_total_f+")");
		blinkConst('pri_total_m',pri_total_m,"Should be equal to total male primary level teachers in the school ("+pri_total_m+")");
	}

	if (classes[6]>0){
		blinkConst('lsec_total_f',lsec_total_f,"Should be equal to total female L.Sec. Level teachers in the school ("+lsec_total_f+")");
		blinkConst('lsec_total_m',lsec_total_m,"Should be equal to total male L.Sec. Level teachers in the school ("+lsec_total_m+")");
	}

	if (classes[9]>0){
		blinkConst('sec_total_f',sec_total_f,"Should be equal to total female Secondary Level teachers in the school ("+sec_total_f+")");
		blinkConst('sec_total_m',sec_total_m,"Should be equal to total male Secondary Level teachers in the school ("+sec_total_m+")");
	}

}


