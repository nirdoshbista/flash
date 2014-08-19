function handleChange(obj){
	
	// without sex, disable caste, qualification and training
	if (obj.name=='helper_sex'){
		if (obj.value=='0') {
			var d = document.forms[0];
			d['helper_caste'].disabled = true;
			d['helper_qual'].disabled = true;
			d['helper_training'].disabled = true;
		}
		else{
			var d = document.forms[0];
			d['helper_caste'].disabled = false;
			d['helper_qual'].disabled = false;
			d['helper_training'].disabled = false;			
		}
	}
	
	if (obj.name=='alternate_school') document.getElementById('alternate_entry_form').className = (obj.value >= 1)?'':'divhide';

	if (obj.name=='starts_y') {
		fixYear(obj);
		blinkConstRange('starts_y',currentYear-maxYearMinus, currentYear, "Year should be in the range of "+(currentYear-maxYearMinus)+" to "+(currentYear))
	}
	if (obj.name=='startr_y') {
		fixYear(obj);
		blinkConstRange('startr_y',currentYear-maxYearMinus, currentYear, "Year should be in the range of "+(currentYear-maxYearMinus)+" to "+(currentYear))
	}
	if (obj.name=='mc_y') {
		fixYear(obj);
		blinkConstRange('mc_y',currentYear-maxYearMinus, currentYear, "Year should be in the range of "+(currentYear-maxYearMinus)+" to "+(currentYear))
	}
	
	if (obj.name=='starts_m') blinkConst('starts_m',12,"Month cant be greater than 12");
	if (obj.name=='starts_d') blinkConst('starts_d',32,"Number of days should be less or equal to 32");
	
	if (obj.name=='startr_m') blinkConst('startr_m',12,"Month cant be greater than 12");
	if (obj.name=='startr_d') blinkConst('startr_d',32,"Number of days should be less or equal to 32");	
	
	if (obj.name=='mc_m') blinkConst('mc_m',12,"Month cant be greater than 12");
	if (obj.name=='mc_d') blinkConst('mc_d',32,"Number of days should be less or equal to 32");	
	
	if (obj.name.indexOf('alternate_total')==0 || obj.name.indexOf('alternate_dalit')==0 || obj.name.indexOf('alternate_janjati')==0 || obj.name.indexOf('alternate_dropout')==0){
		var t=obj.id.replace(/_f$|_m$/,'_t');
		var f=t.replace(/_t$/,'_f');
		var m=t.replace(/_t$/,'_m');
		
		//alert(obj.id + ' ' + f + m + t);
	
		var d = document.forms[0];
		
		var sum = d[f].value *1 + d[m].value *1;
		
		//alert(t);
	
		d[t].value = sum?sum:'';	
		
		
		blink(obj.id.replace(/total|dalit|janjati|dropout/,'dalit'), obj.id.replace(/total|dalit|janjati|dropout/,'total'), TD );
		blink(obj.id.replace(/total|dalit|janjati|dropout/,'janjati'), obj.id.replace(/total|dalit|janjati|dropout/,'total'), TJ );
		blink(obj.id.replace(/total|dalit|janjati|dropout/,'dropout'), obj.id.replace(/total|dalit|janjati|dropout/,'total'), "Dropouts should be less or equal to total" );
		
		
		blinkLtConst('alternate_total_f',getValue(d['alternate_dalit_f'].value)+getValue(d['alternate_janjati_f'].value),'Sum of Dalit and Janjati should be less or equal to total.')
		blinkLtConst('alternate_total_m',getValue(d['alternate_dalit_m'].value)+getValue(d['alternate_janjati_m'].value),'Sum of Dalit and Janjati should be less or equal to total.')

			
	}
	
	if (obj.name.indexOf('alt_')==0){
		var t=obj.id.replace(/_f_|_m_/,'_t_');
		var f=t.replace(/_t_/,'_f_');
		var m=t.replace(/_t_/,'_m_');
		
		//alert(obj.id + ' ' + f + m + t);
	
		var d = document.forms[0];
		
		var sum = d[f].value *1 + d[m].value *1;
		
		//alert(t);
	
		d[t].value = sum?sum:'';

		// find sum
		
		var sm, sf, st;
		sm=sf=st=0;
		
		sf+=(document.forms[0]['alt_age_f_l6'].value*1);
		sm+=(document.forms[0]['alt_age_m_l6'].value*1);
		st+=(document.forms[0]['alt_age_t_l6'].value*1);		
		
		for (i=6;i<=14;i++){
			sf+=(document.forms[0]['alt_age_f_'+i].value*1);
			sm+=(document.forms[0]['alt_age_m_'+i].value*1);
			st+=(document.forms[0]['alt_age_t_'+i].value*1);
		}
		
		sf+=(document.forms[0]['alt_age_f_g14'].value*1);
		sm+=(document.forms[0]['alt_age_m_g14'].value*1);
		st+=(document.forms[0]['alt_age_t_g14'].value*1);
		
		
		document.forms[0]['alt_age_f_t'].value=(sf>0)?sf:'';
		document.forms[0]['alt_age_m_t'].value=(sm>0)?sm:'';
		document.forms[0]['alt_age_t_t'].value=(st>0)?st:'';
		
		blinkEq('alt_age_f_t','alternate_total_f');
		blinkEq('alt_age_m_t','alternate_total_m');
			
	}	
	
	
}

function newsopfsp(n){
	nextPageExtraOption = '&n=' + n;
	nextPage = currentPage;
	savePage();
}

function deletesopfsp(){
	
	document.forms[0]['vdclist'].value = '';
	
	document.forms[0]['alternate_total_t'].value = '';

	nextPage = currentPage;
	savePage();
	
}
