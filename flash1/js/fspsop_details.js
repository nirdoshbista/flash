function handleChange(obj){
		
	if (obj.name=='alternate_school') document.getElementById('alternate_entry_form').className = (obj.value >= 1)?'':'divhide';

	
	if (obj.name.indexOf('alternate_total')==0 || obj.name.indexOf('alternate_dalit')==0 || obj.name.indexOf('alternate_janjati')==0 || obj.name.indexOf('alternate_dropout')==0){
		var t=obj.id.replace(/_f$|_m$/,'_t');
		var f=t.replace(/_t$/,'_f');
		var m=t.replace(/_t$/,'_m');
		
		//alert(obj.id + ' ' + f + m + t);
	
		var d = document.forms[0];
		
		var sum = d[f].value *1 + d[m].value *1;
		
		//alert(t);
	
		d[t].value = sum?sum:'';	
		
		
		blink(obj.id.replace(/total|dalit|janjati/,'dalit'), obj.id.replace(/total|dalit|janjati/,'total'), TD );
		blink(obj.id.replace(/total|dalit|janjati/,'janjati'), obj.id.replace(/total|dalit|janjati/,'total'), TJ );
		
		
		blinkLtConst('alternate_total_f',getValue(d['alternate_dalit_f'].value)+getValue(d['alternate_janjati_f'].value),'Sum of Dalit and Janjati should be less or equal to total.')
		blinkLtConst('alternate_total_m',getValue(d['alternate_dalit_m'].value)+getValue(d['alternate_janjati_m'].value),'Sum of Dalit and Janjati should be less or equal to total.')

			
	}
	
	if (obj.name.indexOf('alt_')==0){

		// find sum
		
		var sm, sf, st;
		sm=sf=st=0;
		
		sf+=(document.forms[0]['alt_age_d_l5'].value*1);
		sm+=(document.forms[0]['alt_age_j_l5'].value*1);
		st+=(document.forms[0]['alt_age_t_l5'].value*1);		
		
		for (i=5;i<=14;i++){
			sf+=(document.forms[0]['alt_age_d_'+i].value*1);
			sm+=(document.forms[0]['alt_age_j_'+i].value*1);
			st+=(document.forms[0]['alt_age_t_'+i].value*1);
		}
		
		sf+=(document.forms[0]['alt_age_d_g14'].value*1);
		sm+=(document.forms[0]['alt_age_j_g14'].value*1);
		st+=(document.forms[0]['alt_age_t_g14'].value*1);
		
		
		document.forms[0]['alt_age_d_t'].value=(sf>0)?sf:'';
		document.forms[0]['alt_age_j_t'].value=(sm>0)?sm:'';
		document.forms[0]['alt_age_t_t'].value=(st>0)?st:'';
		
		//blinkEq('alt_age_t_t','alternate_total_t');
		//blinkEq('alt_age_d_t','alternate_dalit_t');
		//blinkEq('alt_age_j_t','alternate_janjati_t');
			
	}	
	
	
}

function newsopfsp(n){
	nextPageExtraOption = '&n=' + n;
	nextPage = currentPage;
	savePage();
}

function deletesopfsp(){
	
	document.forms[0]['alternate_total_t'].value = '';

	nextPage = currentPage;
	savePage();
	
}
